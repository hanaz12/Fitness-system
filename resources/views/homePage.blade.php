<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="D:\sw\node_modules\bootstrap\dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="css/icofont.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/homepage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <div class="container">
        <nav class="nav">
            <span class="logo">FITNESS</span>
            <div class="nav_content">
                <ul>
                    <li><a href="#home" class="active">HOME</a></li>
                    <li><a href="#about" class="nav-element">ABOUT</a></li>

                    <li><a href="#testimonial" class="nav-element">TESTIMONIAL</a></li>

                    <li><a href="#contact" class="nav-element">CONTACT</a></li>




                </ul>
            </div>
        </nav>
        <div class="header_content" id="home">
            <h5>welcome to our website </h5>
            <h1>get fitness with us</h1>
            <h4>your journey to healthier you</h4>

            <form method="GET" action="{{ route('logined') }}">
                @csrf
                <button class="btn" type="submit" >GET STARTED </button>
            </form>




        </div>




        <section class="about-section" id="about">
            <div class="about_container">
                <div class="about-content">
                    <div class="about-text">
                        <h2>About Us</h2>
                        <p>Welcome to <strong>FITNESS</strong>, your ultimate destination for fitness, health, and personal
                            transformation. Our mission is to empower individuals of all levels to achieve their goals
                            through state-of-the-art facilities, personalized coaching, and a supportive community.</p>
                        <p>We provide a variety of workout programs, nutrition plans, and cutting-edge equipment to help
                            you stay on track and reach your peak potential. Whether you're a beginner or a fitness
                            enthusiast, we are here to guide you every step of the way.</p>
                        <a href="#services" class="learn">Learn More</a>
                    </div>
                    <div class="about-image">
                        <img src="images/about.png" alt="About Fitness">
                    </div>
                </div>
            </div>
        </section>


        <section class="testimonial-section" id="testimonial">
            <div class="">
                <h2 class="section-title">What Our Clients Say</h2>
                <div class="testimonials">

                    <!-- Testimonial 1 -->
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p>"FitLife Gym transformed my life! The trainers are exceptional, and the environment keeps
                                me motivated every single day. I've never felt healthier!"</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="images/client3.jpeg" alt="Client Photo">
                            <h4>John Doe</h4>
                            <span>Fitness Enthusiast</span>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p>"The personalized coaching and nutrition advice helped me lose 20 pounds in just 3
                                months. Highly recommend this gym to anyone serious about results!"</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="images/client2.jpeg" alt="Client Photo">
                            <h4>Jane Smith</h4>
                            <span>Weight Loss Achiever</span>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p>"Amazing facility with top-notch equipment. The supportive community here makes working
                                out enjoyable and effective!"</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="images/client1.jpeg"
                                alt="Client Photo">
                            <h4>Michael Johnson</h4>
                            <span>Strength Trainer</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <section class="contact-section" id="contact">
            <div class="">
                <h2 class="section-title">Contact Us</h2>
                <p class="section-description">Have questions or need assistance? Get in touch with us!</p>

                <div class="contact-content">
                    <!-- Contact Form -->
                    <div class="contact-form">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <input type="text" id="name" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="subject" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea id="message" name="message" rows="5" placeholder="Your Message"
                                    required></textarea>
                            </div>
                            <button type="submit" class="send">Send Message</button>
                        </form>
                    </div>


                    <div class="contact-info">
                        <h3>Contact Details</h3>
                        <p><strong>Address:</strong> 123 FitLife Street, Fitness City, FL 12345</p>
                        <p><strong>Phone:</strong> +1 123 456 7890</p>
                        <p><strong>Email:</strong> contact@fitlife.com</p>
                        <p><strong>Hours:</strong> Mon - Sat: 6am - 9pm</p>
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


                    <script src="D:\sw\node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>

</body>

</html>
