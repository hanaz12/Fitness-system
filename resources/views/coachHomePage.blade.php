
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/coach.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2><b>Coach Dashboard</b></h2>

          <nav class="nav-bar">
          <ul>
            <li><a class="item" href="#coachHomePage.blade.php">Home</a></li>
            <li><a class="item" href="#">about</a></li>
            <li><a class="item" href="#">help</a></li>
          </ul>
        </nav>
        <div class="nav_right">


            {{-- <a href="{{ route('notifications.index') }}" style="text-decoration: none; display: inline-block;">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="23" fill="#ece4e4" class="alert-icon bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                </svg>
            </a> --}}
            <button id="alert" class="btn btn-primary position-relative" type="submit">
                <a href={{route('notifications.index')}}> <i class="fa-solid fa-bell" id="alert-icon"></i></a>
                <span
                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>


            {{-- <button class="" type="submit">
                <a href={{route('notifications.index')}}> <i class="fa-solid fa-bell"></i></a>
                <span
                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button> --}}
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 13 14">
                        {{-- <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/> --}}
                    </svg><i>{{session('user_name')}}</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('updatePersonalInfoCoachView', ['user_id' => session('user_id')]) }}">View Profile</a></li>
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
    <main>
        <div class="title-icon-search">

        <h4><b>plans Management<b></h4></div>
            <br>
            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <input id="searchInput" placeholder="Search by username" type="search" class="input">

        </div>
        <section class="trainee-section">


            <br>
            <button id="filter-no-plan" class="">Show Trainees Without Plans</button>
            <br>
            <br>

            <table class="trainee-table">

                <thead>
                    <tr>
                        <th>Trainee ID</th>
                        <th>User-Name</th>
                        <th>Package Name</th>
                        <th>Plan Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="trainee-data">
                    @foreach($trainees as $trainee)
                        <tr>
                            <td>{{ $trainee->id }}</td>
                            <td>{{ $trainee->user_name }}</td>
                            <td>{{ $trainee->package->name ?? 'N/A' }}</td>
                            <td>{{ optional($trainee->plan)->plan_name ?? 'Not assigned yet' }}</td>
                            <td><form action="{{route('manage.trainee',$trainee->id)}}" method="GET" style="display: inline;">
                                @csrf
                                @method('GET')
                                <button type="submit" class="action">Manage</button>
                            </form>
                        </td>
                            {{-- <td><a href={{route('manage.trainee',$trainee->id)}}><button class="action">Manage</button></a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for filtering trainees based on username and plan
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector('.input');
            const traineeTableBody = document.querySelector('#trainee-data');
            const filterNoPlanButton = document.querySelector('#filter-no-plan');

            let filterApplied = false; // حالة التصفية (تصفية مفعلة أم لا)

            // وظيفة البحث
            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();
                const rows = traineeTableBody.querySelectorAll('tr');

                rows.forEach(function(row) {
                    const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    if (userName.includes(searchTerm)) {
                        row.style.display = ''; // عرض الصف
                    } else {
                        row.style.display = 'none'; // إخفاء الصف
                    }
                });
            });

            // وظيفة تصفية المتدربين الذين ليس لديهم خطة
            filterNoPlanButton.addEventListener('click', function() {
                const rows = traineeTableBody.querySelectorAll('tr');
                if (!filterApplied) {
                    rows.forEach(function(row) {
                        const planName = row.querySelector('td:nth-child(4)').textContent.trim();
                        if (planName !== 'Not assigned yet') {
                            row.style.display = 'none'; // إخفاء الصف
                        } else {
                            row.style.display = ''; // عرض الصف
                        }
                    });
                    filterNoPlanButton.textContent = 'Reset Filter'; // تغيير النص إلى "Reset"
                } else {
                    rows.forEach(function(row) {
                        row.style.display = ''; // عرض جميع الصفوف
                    });
                    filterNoPlanButton.textContent = 'Show Trainees Without Plans'; // تغيير النص إلى "Show Trainees Without Plans"
                }
                filterApplied = !filterApplied; // تبديل حالة التصفية
            });
        });
    </script>


</body>
</html>
