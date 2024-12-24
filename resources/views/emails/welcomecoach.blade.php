<!DOCTYPE html>
<html>
<head>
    <title>Welcome to FitnessApp</title>
</head>
<body>
    <h1>Welcome, {{ $coach->first_name }}!</h1>
    <p>We are excited to have you as part of our community at FitnessApp.</p>
    <p>Your username is: {{ $coach->user_name }}</p>
</body>
</html>
