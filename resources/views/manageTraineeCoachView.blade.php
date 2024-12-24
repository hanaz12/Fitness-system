<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage-plans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/coach.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <section class="personal-info">
        <div class="personal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <i class="name-trainee"><strong>{{ $trainee->first_name }} {{ $trainee->last_name }}</strong> </i>
        </div>

        <form class="form-personal-info">
            <label for="trainee-id">ID:</label>
            <input type="text" id="trainee-id" value="{{ $trainee->id }}" readonly><br>

            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" value="{{ $trainee->first_name }} {{ $trainee->last_name }}" readonly><br>

            <label for="user-name">User Name:</label>
            <input type="text" id="user-name" value="{{ $trainee->user_name }}" readonly><br>

            <label for="email">Email:</label>
            <input type="email" id="email" value="{{ $trainee->email }}" readonly><br>

            <label for="height">Phone:</label>
            <input type="text" id="phone" value="{{ $trainee->phone }}" readonly><br>

            <label for="height">Height:</label>
            <input type="text" id="height" value="{{ $trainee->height }}" readonly><br>

            <label for="weight">Weight:</label>
            <input type="text" id="weight" value="{{ $trainee->weight }}" readonly><br>

            <label for="gender">Gender:</label>
           <input type="text" id="gender" value="{{ $trainee->gender ?? 'N/A' }}" readonly><br>


            <label for="package-name">Package Name:</label>
            <input type="text" id="package-name" value="{{ $trainee->package->name ?? 'N/A' }}" readonly><br>

            <label for="plan-name">Plan Name:</label>
<input type="text" id="plan-name" value="{{ optional($trainee->plan)->plan_name ?? 'Not assigned yet' }}" readonly><br>


            {{-- <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" cols="3" rows="1">{{ $trainee->feedback }}</textarea><br> --}}

            <label for="medical-history">Medical History:</label>
<textarea id="medical-history" name="medical-history" readonly>{{ $trainee->medical_history }}</textarea><br>

<label for="goal">Goal:</label>
<textarea id="goal" name="goal" readonly>{{ $trainee->goal }}</textarea><br>



<form action="javascript:void(0)" method="post">
    <button type="button" id="contact-trainee-btn" class="contact-trainee">
        Contact Trainee
    </button>
</form>

<script>
    document.getElementById('contact-trainee-btn').addEventListener('click', function() {
        @if ($trainee->phone)
            window.location.href = "https://wa.me/{{ '20' . ltrim($trainee->phone, '0') }}?text=Hello, I would like to talk with you. I am your coach, how are you?";
        @else
            alert('This phone number is not available.');
        @endif
    });
</script>


        </form>
    </section>

    <!-- Plans Section -->
    <section class="plans">
        <div class="div-plans">
            @if ($plan)
                <div class="card">
                    <h3 class="title-plan"><strong>Plan {{ $plan->name }}</strong></h3>
                    <p class="body-plan">{{ $plan->description }}</p>




                    <form action="{{ route('plans.edit', ['traineeId' => $trainee->id, 'planId' => $plan->id]) }}" method="GET">
                        <button type="submit" class="update-plan">Update</button>
                    </form>




                    <form action="{{ route('plans.delete', ['traineeId' => $trainee->id, 'planId' => $trainee->plan_id]) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="delete-plan" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                    </form>

                </div>
            @else
                <div class="card">
                    <p>No plan assigned yet.</p>

                    <form method="GET" action="{{ route('coach.addPlan',$trainee->id) }}">
                        @csrf
                        <button class="btn" type="submit" >Add new paln </button>
                    </form>

                </div>
            @endif
        </div>
    </section>


</body>
</html>
