<!DOCTYPE html>
<html>
<head>
    <title>Welcome to FitnessApp</title>
</head>
<body>
    <h1>Welcome, {{ $admin->first_name }}!</h1>
    <p>We are excited to have you as part of our community at FitnessApp.</p>
    <p>Your username is: {{ $admin->user_name }}</p>
</body>
</html>
