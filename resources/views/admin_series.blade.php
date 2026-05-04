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
</head>
<body>
    <header>
        <div class="logo">StreamHive</div>

        <h2 class="logo">Welcome to the Admin Dashboard</h2>

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
        <h2 class="section-title">Manage all series</h2>
    <div class="admin-container">
        <div class="admin-options">
            <form action="/admin_go" method="POST">
                @csrf
                <button class="admin_buttons" type="submit" name="decision" value="user">Users</button>
            </form>
            <form action="/admin_go" method="POST">
                @csrf
                <button class="admin_buttons" type="submit" name="decision" value="movies">Movies</button>
            </form>
            <form action="/admin_go" method="POST">
                @csrf
                <button class="admin_buttons" type="submit" name="decision" value="series">Series</button>
            </form>
            <form action="/admin_go" method="POST">
                @csrf
                <button class="admin_buttons" type="submit" name="decision" value="watchlist">User Watchlist</button>
            </form>
            <form action="/admin_go" method="POST">
                @csrf
                <button class="admin_buttons" type="submit" name="decision" value="subscription">User Subscription</button>
            </form>
        </div> 
        <div class="table-details">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th class="th1" scope="col">#Serial</th>
                    <th class="th1" scope="col">Series Name</th>
                    <th class="th1" scope="col">Series Description</th>
                    <th class="th1" scope="col">Likes</th>
                    <th class="th1" scope="col">Poster</th>
                    <th class="th1" scope="col">Remove Series</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($records as $records)
                    <tr>
                        <th class="th1" scope="row">{{$records->id}}</th>
                        <td class="td1">{{$records->s_name}}</td>
                        <td class="td1">{{$records->s_description}}</td>
                        <td class="td1">{{$records->liked}}</td>
                        <td class="td1">
                            <img src="{{asset($records->img)}}" alt="Movie Poster" style="width: 150px; height: 150px;">
                        </td>
                        <td class="td1">
                            <form action="{{ url('deleteseries/' . $records->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button style="margin-right:25px" type="submit" class="delete_butt">Remove this</button>
                            </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <h2 class="section-title">Add New Series</h2>
            <form action="/addseries" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input">
                    <input class="input_bar" type="text" id="id" name="id" placeholder="Series Number" required>
                </div>
                <div class="input">
                    <input class="input_bar" type="text" id="s_name" name="s_name" placeholder="Series Name" required>
                </div>
                <div class="input">
                    <input class="input_bar" type="text" id="s_description" name="s_description" placeholder="Series Description" required>
                </div>
                <div class="input">
                    <input class="input_bar" type="text" id="m_link" name="liked" placeholder="Set Popularity likes" required>
                </div>
                <div class="input">
                    <input class="input_bar" type="file" id="img_url" name="img_url" accept="image/*" required>
                </div>
                <button class="sb_plan" type="submit">Add Series</button>
            </form>
        </div>
    </div>
    </main>
</body>
</html>