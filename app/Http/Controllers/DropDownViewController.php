<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\houses;
use App\Models\students;
use App\Models\teachers;

class DropDownViewController extends Controller
{
    private function pointsUpdateGlobal(){
        $house = [
            'meghna' => houses::where('houseID', 1)->first(),
            'teesta' => houses::where('houseID', 3)->first(),
            'jamuna' => houses::where('houseID', 2)->first(),
            'padma'  => houses::where('houseID', 4)->first(),
        ];
        return $house;
    }
    public function showLeaderboard(){
        $houses = $this->pointsUpdateGlobal();
        $student = \App\Http\Controllers\AuthController::currentUser();
    
        // Fetch teachers for each house
        $teachers = [
            'meghna' => teachers::where('houseID', 1)->first(),
            'teesta' => teachers::where('houseID', 3)->first(),
            'jamuna' => teachers::where('houseID', 2)->first(),
            'padma'  => teachers::where('houseID', 4)->first(),
        ];
    
        return view('leaderboard', compact('houses', 'student', 'teachers'));
    }
    public function getPoints(){
        $houses = $this->pointsUpdateGlobal();

        return response()->json([
            'meghna' => ['points' => $houses['meghna']->points],
            'teesta' => ['points' => $houses['teesta']->points],
            'jamuna' => ['points' => $houses['jamuna']->points],
            'padma'  => ['points' => $houses['padma']->points],
        ]);
    }
    public function showMeghnaMagpies(Request $request)
    {
        // Get Meghna Magpies house
        $house = houses::where('houseID', '1')->first();
        
        // Get teacher for this house
        $teacher = null;
        if ($house) {
            $teacher = teachers::where('houseID', $house->houseID)->first();
        }
        
        // Set default grade level to DP-2 if none is selected
        $defaultGrade = 'DP-2';
        $selectedGrade = $request->has('grade_level') && $request->grade_level != '' 
            ? $request->grade_level 
            : $defaultGrade;
        
        // Get students based on selected grade level
        $students = collect();
        
        if ($house) {
            $students = students::where('houseID', $house->houseID)
                ->where('Grade', $selectedGrade)
                ->orderBy('studentLastName')
                ->orderBy('studentFirstName')
                ->get();
        }

        $houses = $this->pointsUpdateGlobal();

        return view('houses.meghna_magpies', compact('house', 'teacher', 'students', 'selectedGrade', 'houses'));
    }

    public function showJamunaJackals(Request $request)
    {
        // Get Meghna Magpies house
        $house = houses::where('houseID', '2')->first();
        
        // Get teacher for this house
        $teacher = null;
        if ($house) {
            $teacher = teachers::where('houseID', $house->houseID)->first();
        }
        
        // Set default grade level to DP-2 if none is selected
        $defaultGrade = 'DP-2';
        $selectedGrade = $request->has('grade_level') && $request->grade_level != '' 
            ? $request->grade_level 
            : $defaultGrade;
        
        // Get students based on selected grade level
        $students = collect();
        
        if ($house) {
            $students = students::where('houseID', $house->houseID)
                ->where('Grade', $selectedGrade)
                ->orderBy('studentLastName')
                ->orderBy('studentFirstName')
                ->get();
        }
        
        return view('houses.jamuna_jackals', compact('house', 'teacher', 'students', 'selectedGrade'));
    }
        public function showTeestaTigers(Request $request)
    {
        // Get Meghna Magpies house
        $house = houses::where('houseID', '3')->first();
        
        // Get teacher for this house
        $teacher = null;
        if ($house) {
            $teacher = teachers::where('houseID', $house->houseID)->first();
        }
        
        // Set default grade level to DP-2 if none is selected
        $defaultGrade = 'DP-2';
        $selectedGrade = $request->has('grade_level') && $request->grade_level != '' 
            ? $request->grade_level 
            : $defaultGrade;
        
        // Get students based on selected grade level
        $students = collect();
        
        if ($house) {
            $students = students::where('houseID', $house->houseID)
                ->where('Grade', $selectedGrade)
                ->orderBy('studentLastName')
                ->orderBy('studentFirstName')
                ->get();
        }
        
        return view('houses.teesta_tigers', compact('house', 'teacher', 'students', 'selectedGrade'));
    }

        public function showPadmaPythons(Request $request)
    {
        // Get Meghna Magpies house
        $house = houses::where('houseID', '4')->first();
        
        // Get teacher for this house
        $teacher = null;
        if ($house) {
            $teacher = teachers::where('houseID', $house->houseID)->first();
        }
        
        // Set default grade level to DP-2 if none is selected
        $defaultGrade = 'DP-2';
        $selectedGrade = $request->has('grade_level') && $request->grade_level != '' 
            ? $request->grade_level 
            : $defaultGrade;
        
        // Get students based on selected grade level
        $students = collect();
        
        if ($house) {
            $students = students::where('houseID', $house->houseID)
                ->where('Grade', $selectedGrade)
                ->orderBy('studentLastName')
                ->orderBy('studentFirstName')
                ->get();
        }
        
        return view('houses.padma_pythons', compact('house', 'teacher', 'students', 'selectedGrade'));
    }
}