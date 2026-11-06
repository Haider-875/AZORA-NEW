<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Show login form.
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('dashboard.login');
    }

    /**
     * Authenticate admin.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');
        $email = strtolower($credentials['email']);

        try {
            // Check if admin user exists; if not and matches configured env fallback, seed dynamically to avoid lockout
            $adminEmail = strtolower(env('ADMIN_EMAIL', 'admin@azorasolution.com'));
            $adminPass  = env('ADMIN_PASSWORD', 'AzoraAdmin2026!');
            if (!User::where('email', $email)->exists() && $email === $adminEmail && $credentials['password'] === $adminPass) {
                User::create([
                    'name' => 'Azora Administrator',
                    'email' => $adminEmail,
                    'password' => Hash::make($adminPass),
                ]);
            }

            if (Auth::attempt(['email' => $email, 'password' => $credentials['password']], $remember)) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.index'));
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Dashboard login error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Database connection unavailable. Please check that MySQL is running.'])->withInput();
        }

        return back()->withErrors(['email' => 'Invalid admin credentials provided.'])->withInput();
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard.login');
    }

    /**
     * Admin Command Center dashboard overview.
     */
    public function index(Request $request)
    {
        // Metrics calculations
        $totalLeads = Lead::count();
        $quotesCount = Lead::where('event_type', 'like', '%quote%')->count();
        $todayCount = Lead::whereDate('created_at', today())->count();
        $last7DaysCount = Lead::where('created_at', '>=', now()->subDays(7))->count();

        // 7-day activity data for the chart
        $dailyActivity = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayName = now()->subDays($i)->format('D');
            $count = Lead::whereDate('created_at', $date)->count();
            $dailyActivity[] = [
                'date' => $date,
                'day'  => $dayName,
                'count' => $count,
            ];
        }

        // Monthly snapshots
        $monthlySnapshots = [];
        for ($m = 0; $m < 4; $m++) {
            $monthObj = now()->subMonths($m);
            $monthKey = $monthObj->format('Y-m');
            $monthLabel = $monthObj->format('M Y');
            $mCount = Lead::where('created_at', 'like', "{$monthKey}%")->count();
            $monthlySnapshots[] = [
                'label' => $monthLabel,
                'count' => $mCount,
            ];
        }

        // Recent leads
        $recentLeads = Lead::latest()->take(50)->get();
        $unreadCount = Lead::unread()->count();

        return view('dashboard.index', compact(
            'totalLeads',
            'quotesCount',
            'todayCount',
            'last7DaysCount',
            'dailyActivity',
            'monthlySnapshots',
            'recentLeads',
            'unreadCount'
        ));
    }

    /**
     * Change password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8',
        ]);

        $user = $request->user();

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return response()->json(['ok' => false, 'error' => 'Current password is incorrect.'], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['ok' => true, 'message' => 'Password updated successfully.']);
    }
}
