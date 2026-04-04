<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
    @vite(['resources/css/leaderboard.css', 'resources/js/leaderboard.js'])
</head>
<body>
    <div class="top_tab">
        <div>
            <img src="{{ asset('images/logo.png') }}" class="logo">
        </div>
        <h1>
            Welcome Back
        </h1>
        <div class="btn">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn" style="border: none; background: none; display: flex; align-items: center; gap: 5px;">
                    <img src="{{ asset('images/image.png') }}" class="logo" alt="Logout">
                    <span>
                        {{ session('studentFirstName') && session('studentLastName') 
                            ? session('studentFirstName') . ' ' . session('studentLastName') 
                            : 'StudentView' 
                        }}
                    </span>
                </button>
            </form>
        </div>
    </div>

    <div class="container" id="houseContainer">
        <a href="{{ route('meghna_magpies')  }}">       
            <div class="house" id="meghna" data-house="meghna" style="--bg: url('{{ asset('images/meghna.png') }}')">
                <img src="{{ asset('images/magpie.png') }}" class="house-logo"> 
                <h1>1st</h1>
                <h1>Meghna Magpies</h1>
                <h2>Points: {{  $houses['meghna']->points  }}</h2>
                <h2>Teacher: {{ $teachers['meghna']->teacherName ?? 'Mr.Uchaas' }}</h2>
            </div>
         </a>

         <a href="{{ route('teesta_tigers')  }}">
            <div class="house" id="teesta" data-house="teesta" style="--bg: url('{{ asset('images/teesta.png') }}')">
                <img src="{{ asset('images/tigers.png') }}" class="house-logo">
                <h1>2nd</h1>
                <h1>Teesta Tigers</h1>
                <h2>Points: {{  $houses['teesta']->points  }}</h2>
                <h2>Teacher: {{ $teachers['teesta']->teacherName ?? 'Mr.Uchaas' }}</h2>
            </div>
         </a>
            
        <a href="{{ route('jamuna_jackals')  }}">
            <div class="house" id="jamuna" data-house="jamuna" style="--bg: url('{{ asset('images/jamuna.png') }}')">
                <img src="{{ asset('images/jackals.png') }}" class="house-logo">
                <h1>3rd</h1>
                <h1>Jamuna Jackals</h1>
                <h2>Points: {{  $houses['jamuna']->points  }}</h2>
                <h2>Teacher: {{ $teachers['jamuna']->teacherName ?? 'Mr.Uchaas' }}</h2>
            </div>
        </a>
            
        <a href="{{ route('padma_pythons')  }}">
            <div class="house" id="padma" data-house="padma" style="--bg: url('{{ asset('images/padma.png') }}')">
                <img src="{{ asset('images/pythons.png') }}" class="house-logo">
                <h1>4th</h1>
                <h1>Padma Pythons</h1>
                <h2>Points: {{  $houses['padma']->points  }}</h2>
                <h2>Teacher: {{ $teachers['padma']->teacherName ?? 'Mr.Uchaas' }}</h2>
            </div>
        </a>
    </div>

    <div class='credit'>
        <span>Made By: Farhan Abdullah & Zabir Noor</span>
    </div>
</body>
</html>