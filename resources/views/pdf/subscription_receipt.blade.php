<!DOCTYPE html>
<html>
<head>
    <title>Subscription Receipt</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            color: #333;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #0896c7;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header h2 {
            color: #555;
            font-size: 18px;
            margin-top: 0;
        }

        .details {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .details p {
            margin: 10px 0;
            font-size: 14px;
            line-height: 1.6;
        }

        .details p strong {
            color: #0896c7;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }

        /* Table Styles (if needed in the future) */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #0896c7;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>StreamHive</h1>
        <h2>Subscription Receipt</h2>
    </div>
    <div class="details">
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Subscription Plan:</strong> {{ $status }}</p>
        <p><strong>Payment Date:</strong> {{ $payment_date }}</p>
        <p><strong>Expiry Date:</strong> {{ $expiry_date }}</p>
        <p><strong>Cost:</strong> {{ $cost }}</p>
    </div>
    <div class="footer">
        <p>Thank you for subscribing to StreamHive!</p>
    </div>
</body>
</html>