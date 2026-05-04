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
        <h2 class="section-title">Watch all user's Watchlist</h2>
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
                    <th class="th1" scope="col">#UserID</th>
                    <th class="th1" scope="col">Name</th>
                    <th class="th1" scope="col">User's Age</th>
                    <th class="th1" scope="col">Movie Name</th>
                    <th class="th1" scope="col">Updated at</th>
                    <th class="th1" scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($records as $records)
                    <tr>
                        <th class="th1" scope="row">{{$records->id}}</th>
                        <td class="td1">{{$records->name}}</td>
                        <td class="td1">{{$records->users_age}}</td>
                        <td class="td1">{{$records->m_name}}</td>
                        <td class="td1">{{$records->updated_at}}</td>
                        <td class="td1">{{$records->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </main>
</body>
</html>