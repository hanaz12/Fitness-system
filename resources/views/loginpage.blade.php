<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> --}}

</head>
<body>


    <div class="body-login">
    <div class="loginpage">
    <div class="div-welcome-tittle">
        <h2 class="welcome-tittle">Fitness Website</h2>
    </div>
        <form action="/loginn" method="POST">
    @csrf
    <divclass="div_form">
    <div >
        <input type="text" class="username-1" placeholder="      Username" name="user_name" required>
    </div><br>
    <div>
        <input type="password" class="pass-1" placeholder="       Password" name="password" required>
    </div>
</div>
    <br>
    <div class="radio-btn">
        <div class="div1"> <input type="radio" value="trainee" id="trainee" name="user" required>
            <label for="trainee">Trainee</label></div>
        <div class="div1">    <input type="radio" value="Admin" id="Admin" name="user" required>
            <label for="Admin">Admin</label></div>
        <div class="div1"><input type="radio" value="Admin-moderator" id="Admin-modirator" name="user" required>
            <label for="Admin-modirator">Admin-moderator</label></div>
        <div class="div1">  <input type="radio" value="Coach" id="Coach" name="user" required>
            <label for="Coach">Coach</label></div>
    </div><br>

    @if(session('error'))
     <div class="alert alert-danger text-center" style="color: red;">
        {{ session('error') }}
    </div>

@endif

    <div class="b1">
        <p>Don't have an account? <a href="{{ route('signup.create') }}">Sign Up</a></p>

    </div>
    <div class="btn1">
        <input class="submit-1" type="submit" value="Sign in">
    </div><br>
</form>
</div>
</div>
</body>
</html>
