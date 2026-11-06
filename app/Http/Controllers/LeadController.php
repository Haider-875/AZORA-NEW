<?php

namespace App\Http\Controllers;

use App\Mail\LeadReceived;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    /**
     * Store incoming lead or quote request.
     */
    public function store(Request $request)
    {
        // Anti-bot honeypot check: humans will leave 'website' empty
        if ($request->filled('website') || $request->filled('fax_number')) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['ok' => true, 'ref' => 'AZ-' . date('ymd') . '-BOT']);
            }
            return redirect()->route('success');
        }

        $validated = $request->validate([
            'business'   => 'nullable|string|max:255',
            'contact'    => 'nullable|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:50',
            'locations'  => 'nullable|string|max:50',
            'message'    => 'nullable|string|max:5000',
            'event_type' => 'nullable|string|max:100',
            'items'      => 'nullable',
            'page_url'   => 'nullable|string|max:500',
            'ref'        => 'nullable|string|max:100',
        ]);

        $stripTags = function ($val) {
            if (!is_string($val)) {
                return $val;
            }
            // Strip full script and style tag blocks including inner contents
            $val = preg_replace('/<(script|style)\b[^>]*>(.*?)<\/\1>/is', '', $val);
            // Strip any remaining HTML tags
            $val = strip_tags($val);
            return trim($val);
        };

        // Normalize items array
        $items = $request->input('items', []);
        if (is_string($items)) {
            $decoded = json_decode($items, true);
            $items = is_array($decoded) ? $decoded : [['name' => $items]];
        }
        if (is_array($items)) {
            $items = array_map(function ($it) use ($stripTags) {
                if (is_array($it)) {
                    return [
                        'id' => isset($it['id']) ? $stripTags($it['id']) : null,
                        'name' => isset($it['name']) ? $stripTags($it['name']) : '',
                    ];
                }
                return ['name' => $stripTags($it)];
            }, $items);
        }

        // Clean text fields
        $business  = $stripTags($request->input('business'));
        $contact   = $stripTags($request->input('contact'));
        $phone     = $stripTags($request->input('phone'));
        $locations = $stripTags($request->input('locations', '1'));
        $message   = $stripTags($request->input('message'));
        $userEmail = $request->input('email');

        // Prevent rapid duplicate submissions within 60 seconds
        if ($userEmail) {
            $recentDuplicate = Lead::where('email', $userEmail)
                ->where('created_at', '>=', now()->subSeconds(60))
                ->where(function ($q) use ($business, $message) {
                    if ($business) {
                        $q->where('business', $business);
                    } elseif ($message) {
                        $q->where('message', $message);
                    }
                })
                ->first();

            if ($recentDuplicate) {
                Log::info("Duplicate lead submission prevented for [{$recentDuplicate->ref}] ({$userEmail})");
                if ($request->wantsJson() || $request->is('api/*') || $request->ajax()) {
                    return response()->json([
                        'ok'        => true,
                        'success'   => true,
                        'ref'       => $recentDuplicate->ref,
                        'lead'      => $recentDuplicate,
                        'duplicate' => true,
                        'message'   => 'Thank you! Your quote request was already received.',
                    ]);
                }
                return redirect()->route('success')->with('lead', $recentDuplicate);
            }
        }

        // Generate unique reference ID
        $ref = $request->input('ref');
        if (empty($ref)) {
            $ref = 'AZ-' . date('ymd') . '-' . strtoupper(Str::random(4));
        } else {
            $ref = $stripTags($ref);
        }

        // Determine event type
        $eventType = $request->input('event_type');
        if (empty($eventType)) {
            if (!empty($items)) {
                $eventType = 'quote_request';
            } elseif (!empty($message)) {
                $eventType = 'contact_request';
            } else {
                $eventType = 'general_inquiry';
            }
        } else {
            $eventType = $stripTags($eventType);
        }

        // Create lead in MySQL inside transaction
        $lead = DB::transaction(function () use ($ref, $eventType, $business, $contact, $userEmail, $phone, $locations, $message, $items, $request) {
            return Lead::create([
                'ref'          => $ref,
                'event_type'   => $eventType,
                'business'     => $business,
                'contact'      => $contact,
                'email'        => $userEmail,
                'phone'        => $phone,
                'locations'    => $locations,
                'message'      => $message,
                'items'        => $items,
                'page_url'     => $request->input('page_url', url()->previous()),
                'user_agent'   => $request->userAgent(),
                'email_status' => 'pending',
                'is_read'      => false,
            ]);
        });

        // Queue asynchronous notification email with resilient error capture
        try {
            $recipient = config('mail.from.address') ?: 'sales@azorasolution.com';
            Mail::to($recipient)->queue(new LeadReceived($lead));
            $lead->update([
                'email_status' => 'queued',
            ]);
        } catch (\Throwable $e) {
            Log::error("Failed to queue lead notification email [{$lead->ref}]: " . $e->getMessage());
            $lead->update([
                'email_status' => 'failed',
                'email_error'  => Str::limit($e->getMessage(), 500),
            ]);
        }

        // Handle JSON / AJAX response
        if ($request->wantsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'ok'      => true,
                'success' => true,
                'ref'     => $lead->ref,
                'lead'    => $lead,
                'message' => 'Thank you! Your quote request has been submitted.',
            ]);
        }

        // Handle standard Form POST
        return redirect()->route('success')->with('lead', $lead);
    }

    /**
     * Mark a lead as read.
     */
    public function markRead($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }

    /**
     * Delete a lead.
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        if (request()->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('status', 'Lead deleted successfully.');
    }

    /**
     * Export leads to CSV for dashboard.
     */
    public function exportCsv(Request $request)
    {
        $month = $request->query('month');
        $query = Lead::query()->latest();

        if ($month) {
            $query->where('created_at', 'like', "{$month}%");
        }

        $leads = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="azora-leads-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($leads) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Ref', 'Date', 'Event Type', 'Business', 'Contact', 'Email', 'Phone', 'Locations', 'Items', 'Message', 'Email Status']);

            foreach ($leads as $lead) {
                $itemsStr = '';
                if (is_array($lead->items)) {
                    $names = array_map(function ($it) {
                        return is_array($it) ? ($it['name'] ?? ($it['id'] ?? '')) : (string)$it;
                    }, $lead->items);
                    $itemsStr = implode(', ', array_filter($names));
                }

                fputcsv($handle, [
                    $lead->ref,
                    $lead->created_at ? $lead->created_at->toDateTimeString() : '',
                    $lead->event_type,
                    $lead->business,
                    $lead->contact,
                    $lead->email,
                    $lead->phone,
                    $lead->locations,
                    $itemsStr,
                    $lead->message,
                    $lead->email_status,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
