<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Jamuna Jackals - Houses</title>
    @vite(['resources/css/house.css', 'resources/js/house.js'])
</head>
<body>
    <div class="background" style="--bg: url('{{ asset('images/jamuna.png') }}')">
        <div class="top_tab">
            <div class="left_icons">
                <form method="POST" action="{{ route('home') }}">
                    @csrf
                    <button type="submit" class="btn" style="border: none; background: none; display: flex; align-items: center; gap: 5px;">
                        <img src="{{ asset('images/back_button.png') }}" class="btn">
                    </button>
                </form>
                <img src="{{ asset('images/aka_but_white.png') }}" class="logo">
            </div>
            <h1 class="top_tab_hi">
                Houses
            </h1>
            <div class="btn">
                <form method="POST" action="{{ route('home') }}">
                    @csrf
                    <button type="submit" class="btn" style="border: none; background: none; display: flex; align-items: center; gap: 5px;">
                        <img src="{{ asset('images/image.png') }}" class="logo" alt="Logout">
                        <span>StudentView</span>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="main_content">
            <div class="info_container">
                <h1 id="rank">
                    1st.
                </h1>
                <h1>
                    Jamuna Jackals
                </h1>
                <h2 class="points_h2" data-house="jamuna">
                    Points: {{  $house->points  }}
                </h2>
                <hr class="hr1">
                <h2 class="teacher_h2">
                    Teacher: {{ $teacher->teacherName ?? 'Mr.Uchaas' }}
                </h2>
                <hr class="hr2">
                
                <div class="members_dropdown">
                    <!-- Custom Dropdown -->
                    <div class="custom-dropdown">
                        <button class="dropdown-btn" id="dropdownBtn">
                            <span id="selectedText">{{ $selectedGrade ?? 'Select Grade Level' }}</span>
                            <span class="dropdown-arrow" id="dropdownArrow">▼</span>
                        </button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#" data-value="DP-2">DP-2</a>
                            <a href="#" data-value="DP-1">DP-1</a>
                            <a href="#" data-value="MYP-5">MYP-5</a>
                            <a href="#" data-value="MYP-4">MYP-4</a>
                            <a href="#" data-value="MYP-3">MYP-3</a>
                            <a href="#" data-value="MYP-2">MYP-2</a>
                            <a href="#" data-value="MYP-1">MYP-1</a>
                        </div>
                    </div>
                    
                    <!-- Hidden form for submission -->
                    <form method="GET" action="{{ route('jamuna_jackals') }}" id="gradeFilterForm">
                        <input type="hidden" name="grade_level" id="grade_level" value="{{ $selectedGrade ?? '' }}">
                    </form>
                </div>
                
                <!-- Students List -->
                <div class="students_container">
                    <div class="students-list">
                        @if($students->count() > 0)
                            <ul>
                                @foreach($students as $student)
                                    <li class="student-item">
                                        <div class="student-info">
                                            <span class="student-name">{{ $student->studentFirstName }} {{ $student->studentLastName }} - {{ $student->Grade }}{{ $student->section }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="no-students">No students found in {{ $selectedGrade }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="layered_bg1" style="--bg: url('{{ asset('images/jackals_bg.png') }}')"></div>
        <div class="layered_bg2" style="--bg: url('{{ asset('images/jackals_bg.png') }}')"></div>
        <div class='credit'>
            <span>Made By: Farhan Abdullah & Zabir Noor</span>
        </div>
    </div>
</body>
</html>