<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <style>
        .payment-container {
            background-color: #282828;
            border-radius: 10px;
            padding: 20px;
            width: 500px;
            height: 600px;
            margin: auto;
            text-align: center;
            color: white;
        }
        .bar{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }

        .coupon {
            background-color: #282828;
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            margin: 20px auto;
            text-align: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid #0896c7;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .coupon:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .coupon h3 {
            color: #0896c7;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .discount-text {
            color: #ffffff;
            margin-top: 15px;
            font-size: 16px;
            padding: 10px;
            background-color: rgba(8, 150, 199, 0.1);
            border-radius: 5px;
            display: inline-block;
            border: 1px dashed #0896c7;
        }

        .coupon-code {
            font-weight: bold;
            color: #0896c7;
            padding: 5px 10px;
            background-color: rgba(8, 150, 199, 0.1);
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">StreamHive</div>

        <form class="search-bar" action="/search" method="GET">
            <input type="text" name="search" value="" placeholder="Search for movies and series" required>
            <button type="submit">Search</button>
        </form>

        <nav>
            <ul class="nav-links">
                <li><a href="{{route('UI')}}">Home</a></li>
                <li><a href="{{route('movies')}}">Movies</a></li>
                <li><a href="{{route('series')}}">Series</a></li>
                <li><a href="{{route('watchlist')}}">Watchlist</a></li>
                <li><a href="{{route('subscription')}}">Subscriptions</a></li>
                <li><a href="{{route('feedback')}}">Feedback</a></li> 
            </ul>
        </nav>

        <details class="user-menu">
            <summary>
                <img src="{{asset('images/user-icon.png')}}" alt="User" class="user-icon">
                <span class="dropdown-icon">&#x25BC;</span>
            </summary>
            <div class="dropdown">
                <form action="/profile" method="GET">
                    @csrf
                    <input type="hidden"> 
                    <button type="submit" class="dropdown-button-item">Profile</button>
                </form>
                <form action="/logout" method="POST">
                    @csrf
                    <input type="hidden"> 
                    <button type="submit" class="dropdown-button-item">Logout</button>
                </form>
            </div>
        </details>
    </header>

    <main>
        <h2>Buy the {{$status}} subscription for BDT {{$cost}} only.</h2>
        <div class="payment-container">
            <h1>Payment Details</h1>
            <p style="color:#0896c7; text-align:left; margin-top:10px;">Enter your VISA/AMEX Card Number</p>
            <input class="bar" type="text" id="card-number" placeholder="Card Number" required pattern="\d{16}" title="Card number must 16 digits">
            <p style="color:#0896c7; text-align:left; margin-top:10px;">Enter your name on Card</p>
            <input class="bar"  type="text" id="card-name" placeholder="Name" required>
            <p style="color:#0896c7; text-align:left; margin-top:10px;">Enter the expiry-date of your card</p>
            <input class="bar" type="text" id="expiry-date" placeholder="MM/YY" required pattern="(0[1-9]|1[0-2])\/\d{2}" title="Expiry date must be in MM/YY format">
            <p style="color:#0896c7; text-align:left; margin-top:10px;">Enter the 4 digit pin on your card</p>
            <input class="bar" type="text" id="cvv" placeholder="CVV" required pattern="\d{4}" title="Card pin must be 4 digits">
            <p style="color:#0896c7; text-align:left; margin-top:10px;">Enter your coupon(optional)</p>
            <form action="/subscription" method="POST">
                @csrf
                @method('PUT')
                <input class="bar" type="text" name="coupon" id="coupon" placeholder="Coupon Code">
                <input type="hidden" name="status" value="{{$status}}">
                <input type="hidden" name="payment_date" value="{{$payment_date}}">
                <input type="hidden" name="expiry_date" value="{{$expiry_date}}">
                <button style="margin-top:5px" type="submit" class="s_plan">Buy Subscription</button>
            </form>
        </div>
        <div class="coupon">
            <h3>Have a Coupon?</h3>
            <p class="discount-text">
                Use code <span class="coupon-code">STREAM50</span> to get 50 TK off!
            </p>
            <p style="margin-top: 10px;">Valid until 24.05.25</p>
            <p style="margin-top: 10px;">Terms and conditions may apply.</p>
        </div>
        <h2 style=" margin-top: 40px">PS: This is a dummy payment method, so don't put your real credentials unless you want me rob you ^_^ (jk these data aren't being stored anywhere :p)</h2>
    </main>


</body>
</html>