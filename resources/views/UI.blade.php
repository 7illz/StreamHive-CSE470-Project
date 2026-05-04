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
                <span style="margin-right:20px" class="user-name">{{ Auth::user()->name }}</span>
                <img src="{{asset('images/user-icon.png')}}" alt="User" class="user-icon">
                <span class="dropdown-icon">&#x25BC;</span>
            </summary>
            <div class="dropdown">
                <a href="{{ route('profile') }}" class="dropdown-button-item">Profile</a>
                <a style="height:65px" href="{{ route('generate.report') }}" class="dropdown-button-item">Download Report</a>
                <form action="/logout" method="POST">
                    @csrf
                    <input type="hidden"> 
                    <button type="submit" class="dropdown-button-item">Logout</button>
                </form>
            </div>
        </details>
    </header>
    <h2 class="section-title">Watch Popular Movies</h2>
        <div class="glider-container" id="homescroll">
            <div class="glider1">
                <div class="slide">
                    <img src="{{ asset('images/inception.jpeg') }}" alt="Image 1">
                    <div class="overlay">
                        <h1>Inception</h1>
                        <p>A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Inception"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Inception">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/thor.jpg') }}" alt="Image 1">
                    <div class="overlay">
                        <h1>Thor</h1>
                        <p>A banished god learns humility on Earth to prove he's worthy of his mighty hammer.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Thor"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Thor">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/avengers.jpg') }}" alt="Image 4">
                    <div class="overlay">
                        <h1>Avengers</h1>
                        <p>Earth's mightiest heroes unite to stop an alien invasion led by Loki.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Avengers"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Avengers">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/guardian_of_the_galaxy.jpg') }}" alt="Image 2">
                    <div class="overlay">
                        <h1>Guardian Of The Galaxy</h1>
                        <p>A band of misfits teams up to protect a powerful orb—and the galaxy—from a ruthless villain.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Guardian Of The Galaxy"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Guardian Of The Galaxy">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/joker.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Joker</h1>
                        <p>A troubled loner descends into madness and becomes the infamous clown-faced symbol of chaos.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Joker"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Joker">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/ironman.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Ironman</h1>
                        <p>A genius billionaire builds a high-tech suit to escape captivity and becomes a heroic armored Avenger.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Ironman"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Ironman">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/ironman2.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Ironman 2</h1>
                        <p>Tony Stark battles a vengeful inventor and government pressure while struggling with his own mortality.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Ironman 2"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Ironman 2">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/ironman3.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Ironman 3</h1>
                        <p>Haunted by past battles, Tony faces a mysterious terrorist and discovers what truly makes him Iron Man.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Ironman 3"> 
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Ironman 3">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/spider-verse.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Spider-man</h1>
                        <p>Spiderman: Into the spider verse featuring miles morales will have another movie following this</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Spider-man"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Spider-man">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
            <button class="glider-prev">«</button>
            <button class="glider-next">»</button>
            <div id="dots"></div>
        </div>
    <h2 class="section-title">Watch Popular Series</h2>
        <div class="glider-container" id="homescroll">
            <div class="glider2">
                <div class="slide">
                    <img src="{{ asset('images/Daredevil-Born_Again.jpg') }}" alt="Image 1">
                    <div class="overlay">
                        <h1>Daredevil-Born Again</h1>
                        <p>A blind lawyer returns to fight crime as Daredevil, facing new enemies and inner demons in a gritty rebirth of his vigilante legacy.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Daredevil-Born Again"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Daredevil-Born Again">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form> 
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/peaky_blinders.webp') }}" alt="Image 1">
                    <div class="overlay">
                        <h1>Peaky Blinders</h1>
                        <p>Peaky Blinders is a stylish British crime drama following the ruthless rise of the Shelby family gang in post-World War I Birmingham.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Peaky Blinders"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Peaky Blinders">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form> 
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/dark.jpg') }}" alt="Image 4">
                    <div class="overlay">
                        <h1>Dark</h1>
                        <p>A mind-bending sci-fi thriller that explores time travel, fate, and family secrets as four interconnected families uncover a mystery spanning multiple generations.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Dark"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Dark">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form> 
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/game_of_thrones.jpg') }}" alt="Image 2">
                    <div class="overlay">
                        <h1>Game of Thrones</h1>
                        <p>An epic fantasy saga of power, betrayal, and war as noble families vie for control of the Iron Throne in the mythical land of Westeros.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Game of Thrones"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Game of Thrones">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form> 
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/mindhunter.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Mindhunter</h1>
                        <p>Mindhunter is a psychological crime thriller that follows FBI agents as they pioneer criminal profiling by interviewing serial killers to understand how they think.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Mindhunter"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Mindhunter">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form> 
                            </div>
                        </details>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/ozark.jpg') }}" alt="Image 3">
                    <div class="overlay">
                        <h1>Ozark</h1>
                        <p>Ozark is a dark crime drama about a financial advisor who is forced to launder money for a drug cartel, dragging his family into a dangerous criminal underworld.</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px, ">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="Ozark"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="Ozark">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form> 
                            </div>
                        </details>
                    </div>
                </div>
        </div>
        <button class="glider-prev">«</button>
        <button class="glider-next">»</button>
        <div id="dots"></div>
    </div>
    <details class="dropdown">
        <summary>Options</summary>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item">Add to Watchlist</a>
        </div>
    </details>

    <h2 class="section-title">Top 10 Movies</h2>
    <div class="glider-container" id="top10movies">
        <div class="glider3">
            @foreach ($topMovies as $movie)
                <div class="slide">
                    <img src="{{ asset($movie->img) }}" alt="{{ $movie->m_name }}">
                    <div class="overlay">
                        <h1>{{ $movie->m_name }}</h1>
                        <p>{{ $movie->m_description }}</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px;">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="{{ $movie->m_name }}"> 
                                    <input type="hidden" name="type" value="movie">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $movie->m_name }}">
                                    <input type="hidden" name="type" value="movie"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="glider-prev glider3-prev">«</button>
        <button class="glider-next glider3-next">»</button>
        <div id="dots3"></div>
    </div>
    
    <h2 class="section-title">Top 10 Series</h2>
    <div class="glider-container" id="top10series">
        <div class="glider4">
            @foreach ($topSeries as $series)
                <div class="slide">
                    <img src="{{ asset($series->img) }}" alt="{{ $series->s_name }}">
                    <div class="overlay">
                        <h1>{{ $series->s_name }}</h1>
                        <p>{{ $series->s_description }}</p>
                        <details class="user-menu">
                            <summary>
                                <button id="visible1" class="option-icon" style="font-size:15px;">Options</button>
                                <span class="dropdown-icon">&#x25BC;</span>
                            </summary>
                            <div class="dropdown">
                                <form action="/addwatchlist" method="POST">
                                    @csrf
                                    <input type="hidden" name="m_name" value="{{ $series->s_name }}"> 
                                    <input type="hidden" name="type" value="series">
                                    <button type="submit" class="dropdown-button-item">Add to Watchlist</button>
                                </form>
                                <form action="/access_content" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $series->s_name }}">
                                    <input type="hidden" name="type" value="series"> 
                                    <button type="submit" class="dropdown-button-item">Watch Now</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="glider-prev glider4-prev">«</button>
        <button class="glider-next glider4-next">»</button>
        <div id="dots4"></div>
    </div>

    <section class="glider-section">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
        <script>
            new Glider(document.querySelector('.glider1'), {
                slidesToShow: 5,
                slidesToScroll: 1,
                dots: '#dots',
                draggable: true,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            new Glider(document.querySelector('.glider2'), {
                slidesToShow: 5,
                slidesToScroll: 1,
                dots: '#dots',
                draggable: true,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            new Glider(document.querySelector('.glider3'), {
                slidesToShow: 5,
                slidesToScroll: 1,
                dots: '#dots',
                draggable: true,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            new Glider(document.querySelector('.glider4'), {
                slidesToShow: 5,
                slidesToScroll: 1,
                dots: '#dots',
                draggable: true,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        </script>
    </section>
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

    @auth
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/681e5d9c5fa91f190c49988f/1iqr9rbtg';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    @endauth

    <footer style="text-align: center; padding: 20px; background-color: #1a1a1a; color: white;margin-top: auto; bottom:0; width: 100%;">
        <p>StreamHive &copy; 2025</p>
        <p>&copy; 2025 StreamHive. All rights reserved.</p>
    </footer>

</body>
</html>

