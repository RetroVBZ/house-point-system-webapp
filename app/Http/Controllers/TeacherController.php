<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\houses;
use App\Events\HousePointsUpdated;
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
            'teesta' => houses::where('houseID', 2)->first(),
            'jamuna' => houses::where('houseID', 3)->first(),
            'padma'  => houses::where('houseID', 4)->first(),
        ];

        return view('teacherView.teacher_view', compact('houses'));
    }

    /**
     * Update points for a house.
     * Broadcasts the change so the leaderboard can update in real-time.
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

        // Broadcast event for real-time updates
        broadcast(new HousePointsUpdated($house))->toOthers();

        Log::info('HousePointsUpdated event fired', [
            'houseID' => $house->houseID,
            'newPoints' => $house->points
        ]);

        // Return JSON if AJAX
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