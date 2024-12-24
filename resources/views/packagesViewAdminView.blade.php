@extends('adminHomePage')



@section('content')
<main>
    <div class="tittle">
    <h4><b>Available Packages <b></h4></div>
        <br>
    <section class="trainee-section">
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
            <input id="searchInput" placeholder="Search by package name" type="search" class="input">
        </div>

        <br>
        <div class="actions">
            <button id="filterAvailable" class="btn">Show Available packages</button>

            <form action="{{route('package.add')}}" method="GET" style="display: inline;">
                @csrf
                @method('GET')
                <button type="submit" class="action-add" id="action">Add New Package</button>
            </form>
        </div>
        <br>

        <table class="trainee-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>price</th>
                    <th>discount</th>
                    <th>duration</th>
                    <th>description</th>
                    <th> Coach Id </th>
                    <th> Admin Id </th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->id }}</td>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->price }}</td>
                        <td>{{ $package->discount }}</td>
                        <td>{{ $package->duration }}</td>
                        <td>{{ $package->description }}</td>
                        <td>{{ $package->coach_id }}</td>
                        <td>{{ $package->admin_id }}</td>
                        <td>{{ $package->status }}</td>
                        <td>
                            <form action="{{route('package.edit',$package->id)}}" method="GET" style="display: inline;">
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
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('.input'); // عنصر الإدخال الخاص بالبحث
        const packageTableBody = document.querySelector('tbody'); // عنصر جسم جدول الحزم
        const filterAvailableBtn = document.getElementById('filterAvailable'); // زر التصفية
        const addNewPackageBtn = document.getElementById('addNewPackage'); // زر إضافة حزمة جديدة

        // وظيفة البحث
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = packageTableBody.querySelectorAll('tr');

            rows.forEach(function(row) {
                const packageName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (packageName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // وظيفة التصفية
        let isFiltered = false;
        filterAvailableBtn.addEventListener('click', function() {
            const rows = packageTableBody.querySelectorAll('tr');
            if (!isFiltered) {
                rows.forEach(function(row) {
                    const status = row.querySelector('td:nth-child(9)').textContent.toLowerCase();
                    if (status !== 'available') {
                        row.style.display = 'none';
                    }
                });
                filterAvailableBtn.textContent = 'Reset';
                isFiltered = true;
            } else {
                rows.forEach(function(row) {
                    row.style.display = '';
                });
                filterAvailableBtn.textContent = 'Show Available';
                isFiltered = false;
            }
        });


    });
</script>
@endsection
