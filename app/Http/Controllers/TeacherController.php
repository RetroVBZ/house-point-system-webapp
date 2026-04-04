<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\houses;
use App\Models\teachers;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    // Show teacher view
    public function showTeacherView(Request $request)
    {
        $houses = [
            'meghna' => houses::find(1),
            'jamuna' => houses::find(2),
            'teesta' => houses::find(3),
            'padma'  => houses::find(4),
        ];

        // Fetch full point history with house name and teacher name
        $pointsHistory = DB::table('Points')
            ->join('Houses', 'Points.houseID', '=', 'Houses.houseID')
            ->join('teachers', 'Points.teacherID', '=', 'teachers.teacherID')
            ->select(
                'Houses.houseName as houseName',
                'teachers.teacherName',
                'Points.Points',
                'Points.Time'
            )
            ->orderByDesc('Points.created_at')
            ->get();

        return view('teacherView.teacher_view', compact('houses', 'pointsHistory'));
    }
    
    // Allow teachers to update points
    public function updatePoints(Request $request)
    {
        $teacher_id = session('teacher_id');
        if (!$teacher_id || session('role') !== 'teacher') {
            abort(403);
        }

        $request->validate([
            'houseID' => 'required|integer|exists:houses,houseID',
            'points'  => 'required|integer',
            'action'  => 'required|in:add,remove',
        ]);

        $house = houses::findOrFail($request->houseID);

        // Calculate actual point change
        $pointChange = (int) $request->points;
        if ($request->action === 'remove') {
            $pointChange = -$pointChange;
        }

        // Update total points in houses table
        $house->points += $pointChange;
        $house->save();

        // Save record in Points table for history
        \App\Models\HousePoints::create([
            'houseID'   => $house->houseID,
            'teacherID' => $teacher_id,
            'Points'    => $pointChange,
            'Time'      => now()->toDateString(),
        ]);

        return $request->ajax()
            ? response()->json([
                'status' => 'success',
                'houseID' => $house->houseID,
                'newPoints' => $house->points,
            ])
            : back()->with('success', 'Points updated and recorded successfully!');
    }  
}