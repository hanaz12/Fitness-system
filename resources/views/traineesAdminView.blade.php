@extends('adminHomePage')

@section('content')
<main>

    <div class="tittle">
        <h4><b>Trainees <b></h4></div>
    <br>
    <section class="trainee-section">
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
            <input id="searchInput" placeholder="Search by user_name or first_name" type="search" class="input">
        </div>

        <br>
        <button id="filter-subscribed" class="btn">Show Subscribed Trainees</button>
        <button id="filter-active" class="action-add">Filter active coaches</button>



        <br>
        <br>
<div class="table-container">


        <table class="trainee-table">

            <thead>
                <tr>
                    <th>Trainee ID</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Medical History</th>
                    <th>Goal</th>
                    <th>Gender</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Package Name</th>
                    <th>Plan Name</th>
                    <th>Coach ID</th>
                    <th>Status</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="trainee-data">
                @foreach($trainees as $trainee)
                    <tr>
                        <td>{{ $trainee->trainee_id }}</td>
                        <td>{{ $trainee->user_name }}</td>
                        <td>{{ $trainee->first_name }}</td>
                        <td>{{ $trainee->last_name }}</td>
                        <td>{{ $trainee->phone }}</td>
                        <td>{{ $trainee->email }}</td>
                        <td>{{ $trainee->medical_history }}</td>
                        <td>{{ $trainee->goal }}</td>
                        <td>{{ $trainee->gender }}</td>
                        <td>{{ $trainee->height }}</td>
                        <td>{{ $trainee->weight }}</td>
                        <td>{{ $trainee->package_name }}</td>
                        <td>{{ $trainee->plan_name }}</td>
                        <td>{{ $trainee->coach_id }}</td>
                        <td>{{ $trainee->status }}</td>
                        <td>{{ $trainee->registration_date }}</td>
                        <td><form action="{{route('trainee.edit', $trainee->trainee_id)}}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="action">Manage</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </section>

    </main>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('.input'); // عنصر البحث
        const traineeTableBody = document.querySelector('#trainee-data'); // عنصر الجدول
        const filterSubscribedButton = document.querySelector('#filter-subscribed'); // زر الفلترة للباقة
        const filterActiveButton = document.querySelector('#filter-active'); // زر الفلترة للحالة النشطة
        let filterSubscribedApplied = false; // حالة الفلترة للباقة
        let filterActiveApplied = false; // حالة الفلترة للنشاط

        // وظيفة البحث
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = traineeTableBody.querySelectorAll('tr');

            rows.forEach(function(row) {
                const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // جلب user_name
                const firstName = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // جلب first_name

                if (userName.includes(searchTerm) || firstName.includes(searchTerm)) {
                    row.style.display = ''; // عرض الصف إذا تطابق البحث
                } else {
                    row.style.display = 'none'; // إخفاء الصف إذا لم يتطابق
                }
            });
        });

        // وظيفة تصفية المتدربين الذين لديهم اشتراك في باقة
        filterSubscribedButton.addEventListener('click', function() {
            const rows = traineeTableBody.querySelectorAll('tr');
            if (!filterSubscribedApplied) {
                rows.forEach(function(row) {
                    const packageName = row.querySelector('td:nth-child(12)').textContent.trim(); // جلب اسم الباقة من العمود المناسب
                    if (packageName && packageName !== 'NULL') { // تحقق إذا كان هناك package_name وليس null
                        row.style.display = ''; // عرض الصف إذا كان لدى المتدرب باقة
                    } else {
                        row.style.display = 'none'; // إخفاء الصف إذا لم يكن لدى المتدرب باقة
                    }
                });
                filterSubscribedButton.textContent = 'Reset Filter'; // تغيير النص إلى "Reset"
            } else {
                rows.forEach(function(row) {
                    row.style.display = ''; // عرض جميع الصفوف
                });
                filterSubscribedButton.textContent = 'Show Subscribed Trainees'; // تغيير النص إلى "Show Subscribed Trainees"
            }
            filterSubscribedApplied = !filterSubscribedApplied; // تبديل حالة التصفية
        });

        // وظيفة تصفية المدربين النشطين
        filterActiveButton.addEventListener('click', function() {
            const rows = traineeTableBody.querySelectorAll('tr');
            if (!filterActiveApplied) {
                rows.forEach(function(row) {
                    const status = row.querySelector('td:nth-child(15)').textContent.trim(); // جلب حالة النشاط من العمود المناسب
                    if (status === 'active') { // تحقق إذا كانت حالة المدرب "active"
                        row.style.display = ''; // عرض الصف إذا كان المدرب نشطًا
                    } else {
                        row.style.display = 'none'; // إخفاء الصف إذا لم يكن المدرب نشطًا
                    }
                });
                filterActiveButton.textContent = 'Reset Filter'; // تغيير النص إلى "Reset"
            } else {
                rows.forEach(function(row) {
                    row.style.display = ''; // عرض جميع الصفوف
                });
                filterActiveButton.textContent = 'Filter active coaches'; // تغيير النص إلى "Filter active coaches"
            }
            filterActiveApplied = !filterActiveApplied; // تبديل حالة التصفية
        });
    });
</script>

@endsection
