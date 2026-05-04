<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <style>
        .remove-btn{
            background-color: rgb(223, 57, 57);
            color: white;
            border: none;
            border-radius: 5px;   
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            padding: 10px 20px;
        }
        .remove-btn:hover{
            opacity: 0.8;
            cursor: pointer;
        }

        .sb_plan1{
            font-family: 'Montserrat', sans-serif;;
            border: none;
            background-color: #0896c7;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 5px;
        }
        .sb_plan1:hover{
            opacity: 0.8;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">StreamHive</div>

        <form class="search-bar" action="/search" method="GET">
            <input type="text" name="search" value="" placeholder="Search for songs, artists, or albums" required>
            <button type="submit">Search</button>
        </form>
        <nav>
            <ul class="nav-links">
                <li><a href="{{route('UI')}}">Home</a></li>
                <li><a href="{{route('movies')}}">Movies</a></li>
                <li><a href="{{route('series')}}">Series</a></li>
                <li><a href="{{route('watchlist')}}">Watchlist</a></li>
                <li><a href="{{route('subscription')}}">Subscriptions</a></li>
                <li><a href="{{route('feedback')}}">Feedback</a></li>  <!-- Feedback Button sha -->
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

<!-- ...eDIT... -->

    <main>
        <h2>Watchlists</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @foreach ($records as $record)
        <section id="playlists">
            <div class="playlist-container">
                <div class="playlist">
                    <h3>{{$record->m_name}}</h3>
                    <form action="{{ route('watchlist.remove', $record->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                    <form action="/access_content" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $record->m_name }}">
                        <input type="hidden" name="type" value="{{$record->type}}"> 
                        <button type="submit" class="sb_plan1">Watch Now</button>
                    </form>
                </div>
            </div>
        </section>
        @endforeach
    </main>

    <footer style="text-align: center; padding: 20px; background-color: #1a1a1a; color: white;margin-top: 20px;bottom:0; width: 100%;">
        <p>StreamHive &copy; 2025</p>
        <p>&copy; 2025 StreamHive. All rights reserved.</p>
    </footer>
</body>
</html>