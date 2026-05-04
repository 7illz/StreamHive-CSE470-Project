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
        select#status {
            background-color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            border:none;
            border-radius: 5px;
            width: 110px;
            height: 50px;
            cursor: pointer;
            text-align: center;
            text-align-last: center; /* Center text in dropdown */
        }

        select#status:hover {
            background-color: #f0f0f0;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        .assign-button-item{
            background-color: #0896c7;
            color: white;
            border: none;
            font-family: 'Montserrat', sans-serif;
            border-radius: 5px;
            width: 110px;
            height: 50px;
            cursor: pointer;
            text-align: center;
            text-align-last: center; /* Center text in dropdown */
        }
        .assign-button-item:hover {
            background-color: #f0f0f0;
            color:#0896c7;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
    </style>
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
        <h2 class="section-title">Manage user subscriptions</h2>
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
                    <th class="th1" scope="col">User's ID</th>
                    <th class="th1" scope="col">Username</th>
                    <th class="th1" scope="col">Payment Date</th>
                    <th class="th1" scope="col">Expiry Date</th>
                    <th class="th1" scope="col">Subscription Status</th>
                    <th class="th1" scope="col">Change Subscription Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($records as $records)
                    <tr>
                        <th class="th1" scope="row">{{$records->id}}</th>
                        <td class="td1">{{$records->users_id}}</td>
                        <td class="td1">{{$records->name}}</td>
                        <td class="td1" style="width: 150px;">{{$records->payment_date}}</td>
                        <td class="td1" style="width: 150px;">{{$records->expiry_date}}</td>
                        <td class="td1">{{$records->status}}</td>
                        <td class="td1" style="width: 300px;">
                            <form action="/admin_change_status" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="payment_date" value="{{ now()->toDateString()}}">
                                <input type="hidden" name="expiry_date" value="{{ now()->addMonth()->toDateString()}}">
                                <input type="hidden" name="users_id" value="{{$records->users_id}}"> 
                                <select name="status" id="status">
                                    <option value="free">Free</option>
                                    <option value="individual">Individual</option>
                                    <option value="family">Family</option>
                                </select>
                                <button type="submit" class="assign-button-item">Change Status</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </main>
</body>
</html>