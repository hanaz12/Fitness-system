<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/planTrainee.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <header>
        <div class="logo">FitLife</div>
        <nav>
            <ul>
                <li><a href="{{route('traineeHomePage')}}">Home</a></li>
                <li><a href="#" class="active">My Plans</a></li>
                 {{-- <li><a href="#">Contact coach</a></li> --}}


                <form action="javascript:void(0)" method="post">
                   <button type="button" id="contact-coach-btn" class="plan-contact-trainee">
                        <li><a href="javascript:void(0)" class="">Contact_Coach</a></li>
                     </button>
                </form>

                <script>
                    document.getElementById('contact-coach-btn').addEventListener('click', function() {
                        @if ($coachPhone)
                            window.location.href = "https://wa.me/{{ '20' . ltrim($coachPhone, '0') }}?text=Hello, I would like to talk with you. iam trainee ";
                        @else
                            alert('You are not subscribed to any package currently, so you cannot contact a coach. However, you can reach out to system support for assistance.');
                        @endif
                    });
                </script>


            </ul>
        </nav>
    </header>
    <main>
        <section class="plans-container">
            <h1>Your Current Plans</h1>
            @if($message)
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @else
            <p>Below are the details of your active plans.</p>
            <div class="plans">

                <div class="plan">
                    <h2>Plans</h2>
                    <p><strong>Status:</strong> Active</p>
                    <p><strong>Start Date:</strong> {{$plan->created_at}}</p>
                    <p><strong>Last Update:</strong> {{$plan->updated_at}}</p>
                    <p><strong>Your package</strong> {{$packageName}}</p>
                    <p><strong>Plan Name</strong> {{$plan->plan_name}}</p>
                    <p><strong>PLan Description</strong> {{$plan->description}}</p>
                </div>

            </div>
            @endif
        </section>
    </main>

</body>
</html>

