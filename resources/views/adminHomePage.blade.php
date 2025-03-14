
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2><b>Admin Dashboard</b></h2>

          <nav class="nav-bar">
          <ul>
            <li><a class="item" href="{{route('adminHomePage')}}">Home</a></li>
            <li><a class="item" href="{{route('coaches.admin')}}">Coaches</a></li>
            <li><a class="item" href="{{route('packages.admin')}}">Packages</a></li>
            <li><a class="item" href="{{ route('payments.admin') }}">Payments</a></li>
            <li><a class="item" href="{{ route('trainees.admin') }}">Trainees</a></li>
            <li><a class="item" href="{{ route('plans.admin') }}">Plans</a></li>
          </ul>
        </nav>
        <div class="nav_right">
            <button id="alert" class="btn btn-primary position-relative" type="submit">
                <a href={{route('notifications.index')}}> <i class="fa-solid fa-bell" id="alert-icon"></i></a>
                <span
                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>

            {{-- <a href="{{ route('notifications.index') }}" style="text-decoration: none; display: inline-block;">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="23" fill="#ece4e4" class="alert-icon bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                </svg>
            </a> --}}



            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 13 14">

                    </svg><i>{{session('user_name')}}</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a href="{{ route('updatePersonalInfo', session('user_id')) }}" class="dropdown-item" href="">View Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                    <li><a class="dropdown-item" href={{ route('help') }}>help!</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="main-content">
        @yield('content') <!-- هذا المكان سيتغير حسب القسم الذي يتم اختياره -->
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
