@extends('adminHomePage')

@section('title', 'Home')

@section('content')

<div class="card-container">


<div class="card">
    <div class="card-header"><h2>Coaches</h2></div>
    <div class="card-body"><h4>6 Active</h4></div>
</div>
<div class="card">
    <div class="card-header"><h2>Registered trainees</h2></div>
    <div class="card-body"><h4>{{$totalTrainees}} Enrolled</h4></div>
</div>

<div class="card">
    <div class="card-header"><h2>Trainees with subscription</h2></div>
    <div class="card-body"><h4>{{$traineesWithSubscriptions}}Enrolled</h4></div>
</div>

<div class="card">
    <div class="card-header"><h2>Total Packages</h2></div>
    <div class="card-body"><h4> {{$totalPackages}} Package</h4></div>
</div>

<div class="card">
    <div class="card-header"><h2>Total Revenue</h2></div>
    <div class="card-body"><h4>{{$totalRevenue}}$</h4></div>
</div>

<div class="card">
    <div class="card-header"><h2>Canceled Subsribtion</h2></div>
    <div class="card-body"><h4>0</h4></div>
</div>
</div>
@endsection
