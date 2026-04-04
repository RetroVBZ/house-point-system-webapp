<?php

namespace App\Http\Controllers;

use App\Models\teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\houses;

class TeacherAuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle registration

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'teacherName' => 'required|string|max:255',
            'houseName' => 'required|string|exists:houses,houseName', // updated
            'password' => 'required|string|min:6',
        ]);

        // Find the house ID by name
        $house = houses::where('houseName', $request->houseName)->first();

        if (!$house) {
            return back()->withErrors(['houseName' => 'Invalid house name'])->withInput();
        }

        // Create the teacher
        teachers::create([
            'teacherName' => $request->teacherName,
            'houseID' => $house->houseID,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Account created successfully!');
    }
}