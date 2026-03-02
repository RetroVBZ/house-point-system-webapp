<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/leaderboard.css'])
</head>
<body>
    <div class = "top_tab">
        <div>
            <img src="{{ asset('images/logo.png') }}" class = "logo">
        </div>
        <h1>
            Welcome Back
        </h1>
        <div class="btn">
            <form method="POST" action="{{ route('home') }}">
            @csrf
                <button type="submit" class="btn" style="border: none; background: none; display: flex; align-items: center; gap: 5px;">
                    <img src="{{ asset('images/image.png') }}" class="logo" alt="Logout">
                    <span>Imaad</span>
                </button>
            </form>
        </div>

    </div>
    <div class = "container">

        <a href="{{ route('meghna_magpies')  }}">       
            <div class = "house" id = "Meghna_Magpies" style="--bg: url('{{ asset('images/meghna.png') }}')">
                <img src="{{ asset('images/magpie.png') }}" class="house-logo"> 
                <h1>1st</h1>
                <h1>Meghna Magpies</h1>
                <h2>Points: 256
                    Tr. Uchhaas
                </h2>
            </div>
         </a>

         <a href="{{ route('teesta_tigers')  }}">
            <div class = "house" id = "Teesta_Tigers" style="--bg: url('{{ asset('images/teesta.png') }}')">
                <img src="{{ asset('images/tigers.png') }}" class="house-logo">
                <h1>2nd</h1>
                <h1>Teesta Tigers</h1>
                <h2>Points: 246
                    Tr. Salsabil
                </h2>
            </div>
         </a>
            
        <a href="{{ route('jamuna_jackals')  }}">
            <div class = "house" id = "Jamuna_Jackals" style="--bg: url('{{ asset('images/jamuna.png') }}')">
                <img src="{{ asset('images/jackals.png') }}" class="house-logo">
                <h1>3rd</h1>
                <h1>Jamuna Jackals</h1>
                <h2>Points: 236
                    Tr. Tanvir
                </h2>
            </div>
        </a>
            
        <a href="{{ route('padma_pythons')  }}">
            <div class = "house" id = "Padma_Pythons" style="--bg: url('{{ asset('images/padma.png') }}')">
                <img src="{{ asset('images/pythons.png') }}" class="house-logo">
                <h1>4th</h1>
                <h1>Padma Pythons</h1>
                <h2>Points: 226
                    Tr. Isat
                </h2>
            </div>
        </a>
            
    </div>
</body>
</html>