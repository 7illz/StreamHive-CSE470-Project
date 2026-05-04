<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link rel="stylesheet" href="{{asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
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
        <div class="chat-container">
            <div class="chat-sidebar">
                <div class="chat-sidebar-header">
                    <h3>Conversations</h3>
                </div>
                <div class="chat-users-list">
                    @foreach($users as $user)
                        <a href="{{ route('chat', ['user' => $user->id]) }}" class="chat-user-item {{ $selectedUser && $selectedUser->id == $user->id ? 'active' : '' }}">
                            <div class="chat-user-avatar">
                                <img src="{{ asset('images/user-icon.png') }}" alt="{{ $user->name }}">
                            </div>
                            <div class="chat-user-info">
                                <h4>{{ $user->name }}</h4>
                                <span class="unread-badge" id="unread-{{ $user->id }}"></span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="chat-main">
                @if($selectedUser)
                    <div class="chat-header">
                        <div class="chat-header-user">
                            <img src="{{ asset('images/user-icon.png') }}" alt="{{ $selectedUser->name }}">
                            <h3>{{ $selectedUser->name }}</h3>
                        </div>
                    </div>
                    
                    <div class="chat-messages" id="chat-messages">
                        @foreach($messages as $message)
                            <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                                <div class="message-content">
                                    <p>{{ $message->message }}</p>
                                    <span class="message-time">{{ $message->created_at->format('h:i A') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="chat-input">
                        <form id="message-form">
                            @csrf
                            <input type="hidden" id="receiver-id" value="{{ $selectedUser->id }}">
                            <input type="text" id="message-input" placeholder="Type a message..." autocomplete="off">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="chat-empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        <h3>Select a user to start chatting</h3>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>