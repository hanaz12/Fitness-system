@extends('adminHomePage')



@section('content')
<main>
    <div class="tittle">
    <h4><b>Available plans <b></h4></div>
        <br>
    <section class="trainee-section">
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
            <input id="searchInput" placeholder="Search by plan name" type="search" class="input">
        </div>

        <br>

        <table class="trainee-table">

            <thead>
                <tr>
                    <th>Trainee ID</th>
                    <th>Coach ID</th>
                    <th>Plan ID</th>
                    <th>Plan Name</th>
                    <th>Plan descrription</th>
                    <th> Createion time </th>
                    <th> Last Update </th>
                </tr>
            </thead>
            <tbody id="trainee-data">
                @foreach($plans as $plan)
                    <tr>
                        <td>{{ $plan->trainee_id }}</td>
                        <td>{{ $plan->coach_id}}</td>
                        <td>{{ $plan->id}}</td>
                        <td>{{ $plan->plan_name}}</td>
                        <td>{{ $plan->description }}</td>
                        <td>{{ $plan->created_at }}</td>
                        <td>{{ $plan->updated_at }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</main>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('.input'); // عنصر الإدخال الخاص بالبحث
        const traineeTableBody = document.querySelector('#trainee-data'); // عنصر جدول المتدربين


        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase(); // تحويل النص إلى حروف صغيرة للمقارنة
            const rows = traineeTableBody.querySelectorAll('tr'); // جميع الصفوف في الجدول

            rows.forEach(function(row) {
                const planName = row.querySelector('td:nth-child(4)').textContent.toLowerCase(); // جلب اسم الخطة من العمود الرابع
                if (planName.includes(searchTerm)) {
                    row.style.display = ''; // عرض الصف إذا تطابق البحث
                } else {
                    row.style.display = 'none'; // إخفاء الصف إذا لم يتطابق
                }
            });
        });
    });
</script>

@endsection
