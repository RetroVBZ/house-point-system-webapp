<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Leaderboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/teacher.css', 'resources/js/teacher.js'])
</head>
<body>
    <div class="top_tab">
        <div>
            <img src="{{ asset('images/logo.png') }}" class="logo">
        </div>
        <h1>Welcome Back</h1>
        <div class="btn">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn" style="border: none; background: none; display: flex; align-items: center; gap: 5px;">
                    <img src="{{ asset('images/image.png') }}" class="logo" alt="Logout">

                    @php
                        $teacher = \App\Http\Controllers\AuthController::currentUser();
                    @endphp

                    @if($teacher)
                        <span>{{ $teacher->teacherName }}</span>
                    @else
                        <span>TeacherView</span>
                    @endif
                </button>
            </form>
        </div>
    </div>

    <div class="container">

        <!-- Meghna Magpies -->
        <div class="house" id="Meghna_Magpies" style="--bg: url('{{ asset('images/meghna.png') }}')">
            <img src="{{ asset('images/magpie.png') }}" class="house-logo"> 
            <h1>Meghna Magpies</h1>
            <h2>Points: {{  $houses['meghna']->points  }}
                Tr. Uchhaas
            </h2>
            <div class="controls">
                <button onclick="openModal('1','add')">+</button>
                <button onclick="openModal('1','remove')">−</button>
            </div>
        </div>

        <!-- Teesta Tigers -->
        <div class="house" id="Teesta_Tigers" style="--bg: url('{{ asset('images/teesta.png') }}')">
            <img src="{{ asset('images/tigers.png') }}" class="house-logo">
            <h1>Teesta Tigers</h1>
            <h2>Points: {{  $houses['teesta']->points  }}
                Tr. Salsabil
            </h2>
            <div class="controls">
                <button onclick="openModal('3','add')">+</button>
                <button onclick="openModal('3','remove')">−</button>
            </div>
        </div>

        <!-- Jamuna Jackals -->
        <div class="house" id="Jamuna_Jackals" style="--bg: url('{{ asset('images/jamuna.png') }}')">
            <img src="{{ asset('images/jackals.png') }}" class="house-logo">
            <h1>Jamuna Jackals</h1>
            <h2>Points: {{ $houses['jamuna']->points }}
                Tr. Tanvir
            </h2>
            <div class="controls">
                <button onclick="openModal('2','add')">+</button>
                <button onclick="openModal('2','remove')">−</button>
            </div>
        </div>

        <!-- Padma Pythons -->
        <div class="house" id="Padma_Pythons" style="--bg: url('{{ asset('images/padma.png') }}')">
            <img src="{{ asset('images/pythons.png') }}" class="house-logo">
            <h1>Padma Pythons</h1>
            <h2>Points: {{  $houses['padma']->points  }}
                Tr. Isat
            </h2>
            <div class="controls">
                <button onclick="openModal('4','add')">+</button>
                <button onclick="openModal('4','remove')">−</button>
            </div>
        </div>

        <div class="credit">
            <span>Made By: Farhan Abdullah & Zabir Noor</span>
        </div>
    </div>
    <div class="points-history-container">
        <h2>Points History</h2>
        <table class="points-history">
            <thead>
                <tr>
                    <th>House</th>
                    <th>Teacher</th>
                    <th>Points</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pointsHistory as $record)
                    <tr>
                        <td>{{ $record->houseName }}</td>
                        <td>{{ $record->teacherName }}</td>
                        <td>{{ $record->Points }}</td>
                        <td>{{ $record->Time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Single popout modal -->
    <div id="pointModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>

            <h2 id="modalTitle">Update Points</h2>

            <form method="POST" action="{{ route('update_points') }}">
                @csrf
                <input type="hidden" name="houseID" id="modalHouseID">
                <input type="hidden" name="action" id="modalAction">

                <input type="number" name="points" placeholder="Enter points" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>