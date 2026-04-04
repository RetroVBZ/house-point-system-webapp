<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/register.css'])
    <title>Document</title>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-box">
            <h1 class="register-title">Teacher Registration</h1>
            <form method="POST" action="{{ route('teacher.register.post') }}" class="register-form">
                @csrf
                <input type="text" name="teacherName" placeholder="Name" required>
                <input type="text" name="houseName" placeholder="House Name" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="register-btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>