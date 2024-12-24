@extends('adminHomePage')
@section('content')
<main>
    <div class="tittle">
        <h4><b> Coaches <b></h4></div>
            <br>
        <section class="trainee-section">
            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <input id="searchInput" placeholder="Search by coach username" type="search" class="input">
            </div>

            <br>
            <div class="actions">
                <button id="filterAvailable" class="btn">show active coaches</button>
                {{-- <button id="addNewPackage" class="btn">Add New coach</button> --}}
                <form action="{{route('coach.add')}}" method="GET" style="display: inline;">
                    @csrf
                    @method('GET')
                    <button type="submit" class="action-add" id="action">Add new coach</button>
                </form>
            </div>
            <br>


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
                        <th>coach Admin ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="coach-data">
                    @foreach($coaches as $coach)
                        <tr class="coach-row" data-username="{{ $coach->user_name }}" data-status="{{ $coach->status }}">
                            <td>{{ $coach->id }}</td>
                            <td>{{ $coach->first_name }}</td>
                            <td>{{ $coach->last_name }}</td>
                            <td>{{ $coach->email }}</td>
                            <td>{{ $coach->user_name }}</td>
                            <td>{{ $coach->phone }}</td>
                            <td>{{ $coach->address }}</td>
                            <td>{{ $coach->salary }}</td>
                            <td>{{ $coach->status }}</td>
                            <td>{{ $coach->admin_id }}</td>
                            <td>
                                <form action="{{route('coach.edit',$coach->id)}}" method="GET" style="display: inline;">
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
            const rows = document.querySelectorAll('#coach-data .coach-row');
            const filterActive = document.getElementById('filterAvailable').innerText === 'Reset'; // Check if the filter is active

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

        // Filter active coaches
        document.getElementById('filterAvailable').addEventListener('click', function () {
            const button = document.getElementById('filterAvailable');
            const rows = document.querySelectorAll('#coach-data .coach-row');
            const isActiveFilter = button.innerHTML === 'Show active coaches';

            if (isActiveFilter) {
                button.innerHTML = 'Reset'; // Change button text to Reset
                rows.forEach(row => {
                    const status = row.getAttribute('data-status').toLowerCase();
                    if (status === 'active') {
                        row.style.display = ''; // Show active coaches
                    } else {
                        row.style.display = 'none'; // Hide inactive coaches
                    }
                });
            } else {
                button.innerHTML = 'Show active coaches'; // Reset button text
                rows.forEach(row => {
                    row.style.display = ''; // Show all coaches
                });
            }
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
