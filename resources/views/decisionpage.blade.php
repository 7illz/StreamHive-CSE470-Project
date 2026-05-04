<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive - Music Streaming Site</title>
    <link rel="stylesheet" href="{{asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
    <style>
            body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .decs_container {
            width: 300px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
            background-color: #282828;
        }
        
    </style>
</head>
<body>
    <div class='decs_container'>
        <div class='decs'>
            <h1>Hello admin!</h1>
            <p>How do you like to proceed as?</p>
            <form action="\decision" method="POST">
                @csrf
                <button class="s_plan" type="submit" name="decision" value="admin">Admin</button>
                <button class="s_plan" type ="submit" name="decision" value="user">User</button>
        </div>
</body>
</html>