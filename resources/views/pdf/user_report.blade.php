<!DOCTYPE html>
<html>
<head>
    <title>StreamHive User Report</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0896c7;
            color: #0896c7;
        }

        .section {
            margin-bottom: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .section:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .usage-details, .subscription-details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #0896c7;
        }

        .section-title {
            background: #0896c7;
            color: #ffffff;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px 5px 0 0;
            font-weight: 600;
        }

        .item {
            padding: 10px 15px;
            margin-bottom: 10px;
            background-color: #f4f4f4;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .item:hover {
            background-color: #e9e9e9;
        }

        .item p {
            margin: 5px 0;
            color: #333;
        }

        .item strong {
            color: #0896c7;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #0896c7;
            padding-top: 20px;
        }

        h1, h2, h3 {
            color: #0896c7;
        }

        p {
            margin: 5px 0;
        }

        strong {
            color: #0896c7;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>StreamHive User Report</h1>
        <p>Generated on: {{ $generated_at }}</p>
        <p>User: {{ $user->name }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Usage Statistics</h2>
        <div class="usage-details">
            <p><strong>Total Usage Time:</strong> {{ $total_usage_time ?? '00:00:00' }}</p>
        </div>
    </div>


    <div class="section">
        <h2 class="section-title">Subscription Details</h2>
        <div class="subscription-details">
            <p><strong>Status:</strong> {{ $subscription->status ?? 'Free' }}</p>
            @if($subscription && $subscription->status != 'Free')
                <p><strong>Payment Date:</strong> {{ $subscription->payment_date }}</p>
                <p><strong>Expiry Date:</strong> {{ $subscription->expiry_date }}</p>
                {{-- <p><strong>Cost:</strong> {{ $subscription->status === 'Individual' ? '100 BDT' : '250 BDT' }}</p> --}}
            @endif
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Watchlist Items</h2>
        @if($watchlist->count() > 0)
            @foreach($watchlist as $item)
                <div class="item">
                    <p><strong>Title:</strong> {{ $item->m_name }}</p>
                    <p><strong>Type:</strong> {{ $item->type }}</p>
                </div>
            @endforeach
        @else
            <p>No items in watchlist.</p>
        @endif
    </div>

    <div class="footer">
        <p>Â© {{ date('Y') }} StreamHive - All Rights Reserved</p>
        <p>This report is auto-generated and confidential.</p>
    </div>
</body>
</html>