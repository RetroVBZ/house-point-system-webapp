<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/login.css', 'resources/js/login.js'])
</head>
<body>

    <!-- Top header / top_tab -->
    <div class="top_tab">
        <img src="{{ asset('images/logo.png') }}" class="logo">
        <h1>AKAD HOUSES</h1>
        <div></div> <!-- empty div to balance flex space -->
    </div>

    <!-- Login wrapper -->
    <div class="login-wrapper">
        <div class="login-box">
            <h1 class="login-title">Welcome Back</h1>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="login-form" method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="role-selection">
                    <label>
                        <input type="radio" name="role" value="student" checked> Student
                    </label>
                    <label>
                        <input type="radio" name="role" value="teacher"> Teacher
                    </label>
                </div>

                <div class="role-fields student-fields active">
                    <input type="text" name="studentID" placeholder="Student ID">
                </div>

                <div class="role-fields teacher-fields">
                    <input type="text" name="teacherName" placeholder="Teacher Name">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>

    <div class='credit'>
        <span>Made By: Farhan Abdullah & Zabir Noor</span>
    </div>
    
</body>
</html>