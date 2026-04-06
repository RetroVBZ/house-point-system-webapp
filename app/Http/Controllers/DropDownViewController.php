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
        // $teachers = [
        //     'meghna' => teachers::where('houseID', 1)->first(),
        //     'teesta' => teachers::where('houseID', 3)->first(),
        //     'jamuna' => teachers::where('houseID', 2)->first(),
        //     'padma'  => teachers::where('houseID', 4)->first(),
        // ];
    
        return view('leaderboard', compact('houses', 'student'));
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
    private function showHousePage(Request $request, $houseID, $viewName)
    {
        // Get house
        $house = houses::where('houseID', $houseID)->first();

        // Get ALL teachers (your required change)
        $teachers = collect();
        if ($house) {
            $teachers = teachers::where('houseID', $house->houseID)->get();
        }

        // Grade logic
        $defaultGrade = 'DP-2';
        $selectedGrade = $request->has('grade_level') && $request->grade_level != '' 
            ? $request->grade_level 
            : $defaultGrade;

        // Students
        $students = collect();
        if ($house) {
            $students = students::where('houseID', $house->houseID)
                ->where('Grade', $selectedGrade)
                ->orderBy('studentLastName')
                ->orderBy('studentFirstName')
                ->get();
        }

        $houses = $this->pointsUpdateGlobal();

        return view($viewName, compact(
            'house',
            'teachers',   // plural
            'students',
            'selectedGrade',
            'houses'
        ));
    }
    public function showMeghnaMagpies(Request $request)
    {
        return $this->showHousePage($request, 1, 'houses.meghna_magpies');
    }

    public function showJamunaJackals(Request $request)
    {
        return $this->showHousePage($request, 2, 'houses.jamuna_jackals');
    }

    public function showTeestaTigers(Request $request)
    {
        return $this->showHousePage($request, 3, 'houses.teesta_tigers');
    }

    public function showPadmaPythons(Request $request)
    {
        return $this->showHousePage($request, 4, 'houses.padma_pythons');
    }
}