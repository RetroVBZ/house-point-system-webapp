<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/meghna_magpies.css'])
</head>
<body>
    <div class="background" style="--bg: url('{{ asset('images/meghna_bg.jpg') }}')">
        <div class = "top_tab">
            <div class="left_icons">
                <form method="POST" action="{{ route('home') }}">
                @csrf
                    <button type="submit" class="btn" style="border: none; background: none; display: flex; align-items: center; gap: 5px;">
                        <img src="{{ asset('images/back_button.png') }}" class = "btn">
                    </button>
                </form>
                <img src="{{ asset('images/aka_but_white.png') }}" class = "logo">
            </div>
            <h1 class="top_tab_hi">
                Houses
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
        <div class = "main_content">
            <div class = "info_container">
                <h1>
                    1st. MEGHNA MAGPIES
                </h1>
                <h2 class = "points_h2">
                    Points: 256
                </h2>
                <hr class = "hr1">
                <h2 class = "teacher_h2">
                    Teacher: Mr.Uchaas
                </h2>
                <hr class = "hr2">
                <div class = "members_dropdown">
                    <select name="Grade_Level" id="">
                        
                    </select>
                </div>
            </div>
        </div>
        <div class="layered_bg1" style="--bg: url('{{ asset('images/magpie_bg.png')  }}')">

        </div>
        <div class="layered_bg2" style="--bg: url('{{ asset('images/magpie_bg.png')  }}')">
        </div>
    </div>
</body>
</html>