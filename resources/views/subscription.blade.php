<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
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
        <div class="subscription-page">
            <h2 class="section-title">Choose Your Subscription Plan</h2>
            
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="plans-container">
                <div class="plan-card">
                    <div class="plan-header">
                        <h3>Individual</h3>
                        <div class="plan-price">
                            <span class="price">100 TAKA</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Ad-free Streaming</li>
                            <li><i class="fas fa-check"></i> Add to watchlist option</li>
                            <li><i class="fas fa-check"></i> Offline download</li>
                        </ul>
                    </div>
                    <div class="plan-action">
                        <form action="/payment" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="Individual">
                            <button type="submit" class="primary-button1">Select Individual Plan</button>
                        </form>
                    </div>
                </div>
                
                <div class="plan-card featured">
                    <div class="plan-badge">Popular</div>
                    <div class="plan-header">
                        <h3>Family</h3>
                        <div class="plan-price">
                            <span class="price">250 TAKA</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Ad-free Streaming</li>
                            <li><i class="fas fa-check"></i> Add to watchlist option</li>
                            <li><i class="fas fa-check"></i> Offline download</li>
                            <li><i class="fas fa-check"></i> Family sharing</li>
                        </ul>
                    </div>
                    <div class="plan-action">
                        <form action="/payment" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="Family">
                            <button type="submit" class="primary-button1">Select Family Plan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer style="text-align: center; padding: 20px; background-color: #1a1a1a; color: white;margin-top: 20px;bottom:0; width: 100%;">
        <p>StreamHive &copy; 2025</p>
        <p>&copy; 2025 StreamHive. All rights reserved.</p>
    </footer>
</body>
</html>