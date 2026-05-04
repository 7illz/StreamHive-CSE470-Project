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
    <script>
        $(function(){
            $("#visible1").click(function() {
                $("#invisible1").toggleClass("show");
            });

            $("#visible2").click(function() {
                $("#invisible2").toggleClass("show");
            });
        });
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        .hide {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.5s ease, max-height 0.5s ease;
        }
        .show {
            opacity: 1;
            max-height: 200px;
            transition: opacity 0.5s ease, max-height 0.5s ease;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">StreamHive</div>

        <form class="search-bar" action="/search" method="GET">
            <input type="text" name="search" value="" placeholder="Search for movies or series" required>
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

    <h2 class="section-title">Search result</h2>
    <div class="grid-container">
        @foreach($searchMovies as $record) 
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
        @foreach($searchSeries as $record) 
        <div class="grid-item">
            <img src="{{ asset($record->img) }}" alt="">
            <div class="overlay">
                <h1>{{$record->s_name}}</h1>
                <p>{{$record->s_description}}</p>
                <details class="user-menu">
                    <summary>
                        <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                        <span class="dropdown-icon">&#x25BC;</span>
                    </summary>
                    <div class="dropdown">
                        <form action="/addwatchlist" method="POST">
                            @csrf
                            <input type="hidden" name="m_name" value="{{$record->s_name}}"> 
                            <input type="hidden" name="type" value="series">
                            <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                        </form>
                        <form action="/access_content" method="POST">
                            @csrf
                            <input type="hidden" name="name" value="{{$record->s_name}}">
                            <input type="hidden" name="type" value="series"> 
                            <button type="submit" class="dropdown-button-item">Watch Now</button>
                        </form>
                        <form action="/liked" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="liked" value="{{$record->liked}}"> 
                            <input type="hidden" name="name" value="{{$record->s_name}}">
                            <input type="hidden" name="type" value="series">
                            <button type="submit" class="dropdown-button-item">Like</button>
                        </form>
                    </div>
                </details>
            </div>
        </div>
    @endforeach
    </div>
</body>
</html>