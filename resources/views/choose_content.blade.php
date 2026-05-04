<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link rel="stylesheet" href="{{asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
    <style>
    </style>
</head>
<body>
    <header>
        <div class="logo">StreamHive</div>

        <form class="search-bar" action="{{route('search')}}" method="GET">
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
                    <input type="hidden"> 
                    <button type="submit" class="dropdown-button-item">Logout</button>
                </form>
            </div>
        </details>
    </header>

    <main>
        @if($type=='movie')
            <h2 class="section-title">Watch the movie: {{$name_n}}</h2>
            <div>
                <section id="playlists">
                    <div class="playlist-container">
                            <div class="playlist">
                                <form action="/gowatch" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{$name}}">
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" style="background-color:#282828; color:white; border:none; font-family: 'Montserrat', sans-serif; font-size: 20px; padding: 10px 20px; border-radius: 5px; cursor: pointer; text-align: center;">
                                        {{basename($name)}}
                                    </button>
                                </form>
                            </div>
                    </section>
            </div>

        @elseif($type=='series')
            <h2 class="section-title">Watch the series: {{$name}}</h2>
            <div>
                <section id="playlists">
                    <div class="playlist-container">
                        @foreach($episodes as $episode)
                            <div class="playlist">
                                <form action="/gowatch" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{$episode}}">
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" style="background-color:#282828; color:white; border:none; font-family: 'Montserrat', sans-serif; font-size: 20px; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                        {{basename($episode)}}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        @endif
    </main>

    <footer>
        <p>StreamHive &copy; 2025</p>
    </footer>
</body>
</html>