<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link rel="stylesheet" href="{{asset('css/styles.css') }}">
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
                <a href="{{ route('profile') }}" class="dropdown-button-item">Profile</a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-button-item">Logout</button>
                </form>
            </div>
        </details>
    </header>
    
    <!-- Movies Section -->
    <h2 class="section-title">Movies</h2>
    <div class="grid-container">
        @foreach($records as $record)
            <div class="grid-item">
                <img src="{{ asset($record->img) }}" alt="">
                <div class="overlay">
                    <h1>{{$record->m_name}}</h1>
                    <p>{{$record->m_description}}</p>
                    <details class="user-menu">
                        <summary>
                            <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                            <span class="dropdown-icon">&#x25BC;</span>
                        </summary>
                        <div class="dropdown">
                            <form action="/addwatchlist" method="POST">
                                @csrf
                                <input type="hidden" name="m_name" value="{{$record->m_name}}"> 
                                <input type="hidden" name="type" value="movie">
                                <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                            </form>
                            <form action="/access_content" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{$record->m_name}}">
                                <input type="hidden" name="type" value="movie"> 
                                <button type="submit" class="dropdown-button-item">Watch Now</button>
                            </form>
                            <form action="/liked" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="liked" value="{{$record->liked}}"> 
                                <input type="hidden" name="name" value="{{$record->m_name}}">
                                <input type="hidden" name="type" value="movie">
                                <button type="submit" class="dropdown-button-item">Like</button>
                            </form>
                        </div>
                    </details>
                </div>
            </div>
        @endforeach
    </div>

    @if (session('underage'))
        <script>
            alert('You must be 18 or older to add movies to your watchlist.');
        </script>
    @endif

    @if(session('free'))
    <script>
        alert('You are subscribed to a free plan. Please upgrade to a paid plan to access this feature.');
    </script>
    @endif

    <footer style="text-align: center; padding: 20px; background-color: #1a1a1a; color: white;margin-top: 20px;bottom:0; width: 100%;">
        <p>StreamHive &copy; 2025</p>
        <p>&copy; 2025 StreamHive. All rights reserved.</p>
    </footer>
</body>
</html>