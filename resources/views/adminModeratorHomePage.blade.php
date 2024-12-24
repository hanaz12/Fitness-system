
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Moderator Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/adminModerator.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <header class="header">
        <h3><b> Dashboard</b></h3>
        <nav class="nav-bar">
            <ul>
                <li><a class="item" href="#coachHomePage.blade.php">Home</a></li>
                <li><a class="item" href="#">About</a></li>
                <li><a class="item" href="#">Help</a></li>
            </ul>
        </nav>
        <div class="nav_right">
            {{-- <a href="{{ route('notifications.index') }}">
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
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 13 14">
                    </svg><i>{{session('user_name')}}</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{route('updatePersonalInfoAdminModerator', session('user_id'))}}">View Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                    <li><a class="dropdown-item" href="#">Help!</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main>
        <div class="tittle">
        <h4><b>Admins Management<b></h4></div>
            <br>
        <section class="trainee-section">
            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <input id="searchInput" placeholder="Search by username" type="search" class="input">
            </div>
            <br>

            <div class="filter-buttons">
                <button id="filterButton" onclick="toggleFilter()">Filter Active Admins</button>
                <form action='{{ route('admin.add') }}' method="GET" style="display: inline;">
                    @csrf
                    @method('GET')
                    <button type="submit" class="action-add-admin">Add New Admin</button>
                </form>
            </div>

            <table class="trainee-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>user_name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Admin Moderator ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="admin-data">
                    @foreach($admins as $admin)
                        <tr class="admin-row" data-username="{{ $admin->user_name }}" data-status="{{ $admin->status }}">
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->user_name }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->address }}</td>
                            <td>{{ $admin->salary }}</td>
                            <td>{{ $admin->status }}</td>
                            <td>{{ $admin->admin_moderator_id }}</td>
                            <td>
                                <form action="{{ route('admin.edit', $admin->id) }}" method="GET" style="display: inline;">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="action" id="action">Manage</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </section>
    </main>

    <script>
        // Search by user_name
        document.getElementById('searchInput').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#admin-data .admin-row');
            const filterActive = document.getElementById('filterButton').innerText === 'Reset'; // Check if the filter is active

            rows.forEach(row => {
                const userName = row.getAttribute('data-username').toLowerCase();
                const status = row.getAttribute('data-status').toLowerCase();

                // Check if search matches and, if active filter is on, also check if the status is active
                if (userName.includes(searchValue) && (!filterActive || status === 'active')) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter active admins
        document.getElementById('filterButton').addEventListener('click', function () {
            const button = document.getElementById('filterButton');
            const rows = document.querySelectorAll('#admin-data .admin-row');
            const isActiveFilter = button.innerHTML === 'Filter Active Admins';

            if (isActiveFilter) {
                button.innerHTML = 'Reset'; // Change button text to Reset
                rows.forEach(row => {
                    const status = row.getAttribute('data-status').toLowerCase();
                    if (status === 'active') {
                        row.style.display = ''; // Show active admins
                    } else {
                        row.style.display = 'none'; // Hide inactive admins
                    }
                });
            } else {
                button.innerHTML = 'Filter Active Admins'; // Reset button text
                rows.forEach(row => {
                    row.style.display = ''; // Show all admins
                });
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
