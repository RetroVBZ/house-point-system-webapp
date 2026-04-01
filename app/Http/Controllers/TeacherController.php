<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\houses;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    /**
     * Show the teacher view with all house points.
     */
    public function showTeacherView(Request $request)
    {
        $houses = [
            'meghna' => houses::where('houseID', 1)->first(),
            'jamuna' => houses::where('houseID', 2)->first(),
            'teesta' => houses::where('houseID', 3)->first(),
            'padma'  => houses::where('houseID', 4)->first(),
        ];

        return view('teacherView.teacher_view', compact('houses'));
    }

    /**
     * Update points for a house.
     * Works with polling system.
     */
    public function updatePoints(Request $request)
    {
        // Validate request
        $request->validate([
            'houseID' => 'required|integer|exists:houses,houseID',
            'points'  => 'required|integer',
            'action'  => 'required|in:add,remove',
        ]);

        $house = houses::where('houseID', $request->houseID)->first();

        // Update points
        if ($request->action === 'add') {
            $house->points += (int) $request->points;
        } else {
            $house->points -= (int) $request->points;
        }

        $house->save();

        Log::info('Points updated', [
            'houseID' => $house->houseID,
            'newPoints' => $house->points
        ]);

        // Return JSON for AJAX request (so frontend can optionally refresh immediately)
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'houseID' => $house->houseID,
                'newPoints' => $house->points,
            ]);
        }

        return back()->with('success', 'Points updated successfully!');
    }
}