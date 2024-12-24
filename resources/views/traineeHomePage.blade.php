<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/traineeHomePage.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <nav class="nav">
            <span class="logo">Fitness</span>
            <div class="nav_content">
                <ul>
                    <li><a href="#home" class="active">HOME</a></li>
                    <li><a href="#carouselExample" class="nav-element">PACKAGES</a></li>
                    <!-- plan page  -->
                        <form action="" method="GET">

                        <li><a href="{{ route('plans.tainee', session('user_id')) }}" class="nav-element">PLANS</a></li>
                        </form>
                        {{-- <li><a href="{{ route('plans.tainee', session('id')) }}" class="nav-element">PLANS</a></li> --}}

                    <!-- contact coach page  -->

                    {{-- <form action="" method="post"><button type="submit">
                            <li><a href="" class="nav-element">CONTACT</a></li>
                        </button></form> --}}
                        {{-- <form action="" method="post"><button type="submit">
                            <li><a href="" class="nav-element">Contact_coach</a></li>
                        </button></form> --}}
                        <form action="javascript:void(0)" method="post">
                            <button type="button" id="contact-coach-btn" class="">
                                <li><a href="javascript:void(0)" class="nav-element">Contact_Coach</a></li>
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


                        <div class="nav_right">

                            <button class="btn btn-primary position-relative" type="submit">
                                <a href={{route('notifications.index')}}> <i class="fa-solid fa-bell"></i></a>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </button>




                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i><i>{{session('user_name')}}</i>
                                </button>
                                <!-- هنا فيه لكل لينك form and button -->
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    {{-- <li><a class="dropdown-item" href={{ route('updatePersonalInfoTraineeView', session('user_id')) }}>view profile</a></li> --}}
                                    <li><a class="dropdown-item" href="{{ route('updatePersonalInfoTraineeView', ['user_id' => session('user_id')]) }}">View Profile</a></li>

                                    <li><a class="dropdown-item" href={{ route('help') }}>help!</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item" type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>


                                    </ul>

                                </div>
                            </div>

                            <!-- هنا نهايته  -->

                        </ul>
                    </div>
                </nav>
                <div class="header_content" id="home">
                    <h1>Welcome to our fitness community</h2>
                    <h5>Transform Your Body, Transform You Life</h3>
                    <h4>Your path to a stronger, healthier you starts here</h4>
                </div>
            </div>




    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            @foreach($packages as $index => $package)
                <div class="carousel-item {{ $index == 0 && !$trainee->package_id ? 'active' : ($package->id == $trainee->package_id ? 'active' : '') }}">
                    <h2 class="card-title">{{ $package->name }}</h2>
                    <p class="card-text">{{ $package->description }}</p>
                    <p class="price fw-bold">
                        @if ($package->discount > 0)
                            <span class="text-decoration-line-through text-muted">{{ $package->price }} LE</span>
                            <span class="text-danger">{{ $package->price - ($package->price * $package->discount / 100) }} LE</span>
                        @else
                            {{ $package->price }} LE
                        @endif
                        / {{ $package->duration }} months
                    </p>
                    @if ($package->status == 'unavailable')
                    <button class="btn btn-secondary" disabled>This package will be available soon</button>
                    @elseif ($trainee->package_id == $package->id)

                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#unsubscribeModal" data-package-id="{{ $package->id }}">
                        Cancel Subscribtion
                        </button>
                    @elseif ($trainee->package_id)
                        <button class="btn btn-secondary" disabled>Already subscribed to another package</button>
                    @else
                        <button class="btn btn-primary" onclick="window.location='{{ route('subscribe', $package->id) }}'">Subscribe</button>
                    @endif
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Modal for Unsubscribe Confirmation -->
     <div class="modal fade" id="unsubscribeModal" tabindex="-1" aria-labelledby="unsubscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unsubscribeModalLabel">Confirm Unsubscribe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to unsubscribe from this package?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="unsubscribeForm" method="POST" action="" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Unsubscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>

        const unsubscribeButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        unsubscribeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-package-id');
                const form = document.getElementById('unsubscribeForm');
                form.action = '/unsubscribe/' + packageId; // أضف الرابط المناسب لحذف الاشتراك
            });
        });
    </script> --}}
    <script>
        // التعامل مع أزرار إلغاء الاشتراك
        const unsubscribeButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        unsubscribeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-package-id');
                const form = document.getElementById('unsubscribeForm');
                form.action = '/unsubscribe/' + packageId; // أضف الرابط المناسب لحذف الاشتراك
            });
        });

        // التحقق من حالة الـ package
        const packageButtons = document.querySelectorAll('.btn-primary, .btn-secondary, .btn-danger'); // حدد كل الأزرار ذات الصلة
        packageButtons.forEach(button => {
            const packageStatus = button.getAttribute('data-package-status'); // يجب إضافة data-package-status إلى زر الاشتراك أو الإلغاء
            if (packageStatus === 'unavailable') {
                button.classList.add('btn-secondary'); // تغيير التصميم ليظهر كغير متاح
                button.classList.remove('btn-primary', 'btn-danger'); // إزالة أي ألوان أخرى
                button.disabled = true; // جعل الزر غير قابل للنقر
                button.textContent = 'This package will be available soon'; // النص المخصص
            }
        });
    </script>




    <h2 id="feedback">contact with us !</h2>
    <div class="feedback">
        <div class="user-feedback">
            <img src="img/two.jpg" alt="">
            <div class="star">
                <p>
                    <h3>WhatsApp</h3>
                    <h6><i class="fa fa-location-dot"></i> united</h6>
                    Lorem ipsum, dolor sit amet
                    <br>+201091323885
                </p>
                <a href="https://wa.me/+201282911237" class="download-2">chat <i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <div class="form-sec" id="form-sec">
        <!-- Your form or additional content goes here -->
    </div>

    <footer>
        <div class="footer-sec">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-github"> </i>
            <p>Copy Right 2018 © By <span>Theme-fair</span> All Rights Reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
