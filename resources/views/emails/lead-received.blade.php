<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Azora Lead</title>
</head>
<body style="margin:0;padding:0;background-color:#0b1320;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1e293b;">
  <div style="max-width:640px;margin:0 auto;padding:24px 16px;">
    
    <!-- Top Branding Header -->
    <div style="background:#111b2c;border:1px solid #1e293b;border-radius:16px 16px 0 0;padding:28px 24px;text-align:center;">
      <div style="display:inline-block;background:#2469EB;color:#ffffff;font-size:18px;font-weight:900;width:40px;height:40px;line-height:40px;border-radius:10px;text-align:center;margin-bottom:10px;">A</div>
      <div style="color:#ffffff;font-size:22px;font-weight:900;letter-spacing:-0.03em;margin:0;">AZORA SOLUTIONS</div>
      <div style="color:#94a3b8;font-size:11px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;margin-top:4px;">New Customer Enquiry Alert</div>
    </div>

    <!-- Alert Banner -->
    <div style="background:#2469EB;padding:12px 24px;text-align:center;">
      <span style="color:#ffffff;font-size:13px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;">
        🔔 {{ ucwords(str_replace('_', ' ', $lead->event_type)) }} : {{ $lead->business ?: 'New Prospect' }}
      </span>
    </div>

    <!-- Main Card Body -->
    <div style="background:#ffffff;padding:28px 24px;border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;">
      
      <!-- Quick Action Buttons -->
      <div style="margin-bottom:24px;padding:16px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;text-align:center;">
        <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:10px;">Instant Actions</div>
        @if($lead->phone)
        <div style="display:inline-block;margin:0 4px;">
          <a href="tel:{{ $lead->phone }}" style="display:inline-block;background:#0b1320;color:#ffffff;text-decoration:none;padding:8px 14px;border-radius:8px;font-size:12px;font-weight:700;">📞 Call Customer</a>
        </div>
        @endif
        @if($lead->email)
        <div style="display:inline-block;margin:0 4px;">
          <a href="mailto:{{ $lead->email }}?subject=Regarding your Azora Solutions quote ({{ $lead->ref }})" style="display:inline-block;background:#2469EB;color:#ffffff;text-decoration:none;padding:8px 14px;border-radius:8px;font-size:12px;font-weight:700;">✉️ Reply by Email</a>
        </div>
        @endif
        <div style="display:inline-block;margin:0 4px;">
          <a href="{{ url('/dashboard') }}" style="display:inline-block;background:#f1f5f9;color:#0b1320;border:1px solid #cbd5e1;text-decoration:none;padding:8px 14px;border-radius:8px;font-size:12px;font-weight:700;">📊 Open Dashboard</a>
        </div>
      </div>

      <!-- Lead Details Grid -->
      <h3 style="font-size:13px;font-weight:900;color:#0b1320;text-transform:uppercase;letter-spacing:0.12em;margin:0 0 12px;padding-bottom:6px;border-bottom:2px solid #2469EB;">
        Customer Information
      </h3>
      
      <table style="width:100%;border-collapse:collapse;margin-bottom:24px;">
        <tr>
          <td style="padding:8px 0;width:140px;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Customer Name:</td>
          <td style="padding:8px 0;font-size:14px;font-weight:800;color:#0b1320;">{{ $lead->contact ?: 'Not provided' }}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Business Name:</td>
          <td style="padding:8px 0;font-size:14px;font-weight:800;color:#0b1320;">{{ $lead->business ?: 'Not specified' }}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Email Address:</td>
          <td style="padding:8px 0;font-size:14px;font-weight:700;color:#2469EB;">
            @if($lead->email)
              <a href="mailto:{{ $lead->email }}" style="color:#2469EB;text-decoration:none;">{{ $lead->email }}</a>
            @else
              Not provided
            @endif
          </td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Phone Number:</td>
          <td style="padding:8px 0;font-size:14px;font-weight:700;color:#0b1320;">
            @if($lead->phone)
              <a href="tel:{{ $lead->phone }}" style="color:#0b1320;text-decoration:none;">{{ $lead->phone }}</a>
            @else
              Not provided
            @endif
          </td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Locations:</td>
          <td style="padding:8px 0;font-size:14px;font-weight:700;color:#0b1320;">{{ $lead->locations ?: '1' }} location(s)</td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Reference ID:</td>
          <td style="padding:8px 0;font-size:13px;font-family:monospace;font-weight:700;color:#2469EB;">{{ $lead->ref }}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Submitted At:</td>
          <td style="padding:8px 0;font-size:12px;color:#64748b;">{{ $lead->created_at ? $lead->created_at->format('l, F j, Y, g:i A') : now()->format('l, F j, Y, g:i A') }}</td>
        </tr>
      </table>

      <!-- Requested Products / Services -->
      @if(!empty($lead->items) && count($lead->items) > 0)
      <h3 style="font-size:13px;font-weight:900;color:#0b1320;text-transform:uppercase;letter-spacing:0.12em;margin:24px 0 12px;padding-bottom:6px;border-bottom:2px solid #2469EB;">
        Requested Services &amp; Plans
      </h3>
      <table style="width:100%;border-collapse:collapse;margin-top:6px;">
        @foreach($lead->items as $idx => $item)
          @php
            $itemName = is_array($item) ? ($item['name'] ?? ($item['id'] ?? json_encode($item))) : $item;
            $itemCat = is_array($item) && isset($item['category']) ? $item['category'] : '';
            $itemPrice = is_array($item) && isset($item['lease']) ? $item['lease'] : '';
          @endphp
          <tr style="border-bottom:1px solid #edf2f7;background:{{ $idx % 2 === 0 ? '#ffffff' : '#f8fafc' }};">
            <td style="padding:10px 12px;font-size:13px;color:#0b1320;font-weight:600;">
              @if($itemCat)<span style="font-size:10px;text-transform:uppercase;letter-spacing:0.1em;color:#2563eb;font-weight:700;display:block;">{{ $itemCat }}</span>@endif
              <div style="font-size:13.5px;color:#0b1320;font-weight:700;">{{ $itemName }}</div>
            </td>
            <td style="padding:10px 12px;text-align:right;font-size:13px;">
              <span style="font-size:13px;font-weight:800;color:#0b1320;">{{ $itemPrice }}</span>
            </td>
          </tr>
        @endforeach
      </table>
      @endif

      <!-- Notes / Message -->
      @if($lead->message)
      <h3 style="font-size:13px;font-weight:900;color:#0b1320;text-transform:uppercase;letter-spacing:0.12em;margin:24px 0 12px;padding-bottom:6px;border-bottom:2px solid #2469EB;">
        Project Goals / Message
      </h3>
      <div style="padding:14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;line-height:1.6;color:#334155;">
        {!! nl2br(e($lead->message)) !!}
      </div>
      @endif

    </div>

    <!-- Footer Information -->
    <div style="background:#f1f5f9;border:1px solid #e2e8f0;border-top:none;border-radius:0 0 16px 16px;padding:18px 24px;text-align:center;font-size:11px;color:#64748b;">
      <p style="margin:0 0 4px;"><strong>Azora Solutions Direct Notifications</strong></p>
      <p style="margin:0;">1015 GLENDALE CHASE CT, Morrisville, North Carolina, United States, 27560 · (984) 388-8298</p>
    </div>

  </div>
</body>
</html>

