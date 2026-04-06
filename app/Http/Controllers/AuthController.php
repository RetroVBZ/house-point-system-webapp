<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\teachers;
use App\Models\students;

class AuthController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:student,teacher',
            'studentID' => 'required_if:role,student|string',
            'teacherName' => 'required_if:role,teacher|string',
            'password' => 'required_if:role,teacher|string',
        ]);

        $role = $request->role;

        if ($role === 'student') {
            $student = students::where('studentID', $request->studentID)->first();
            if (!$student) {
                return redirect()->back()->withErrors(['studentID' => 'Student not found']);
            }
        
            // Store student info in session
            session([
                'student_id' => $student->studentID,
                'role' => 'student',
                'studentFirstName' => $student->studentFirstName,
                'studentLastName' => $student->studentLastName,
            ]);
        
            return redirect()->route('home'); // Student dashboard/leaderboard
        }

        if ($role === 'teacher') {
            $teacher = teachers::where('teacherName', $request->teacherName)->first();

            if (!$teacher || !Hash::check($request->password, $teacher->password)) {
                return redirect()->back()->withErrors(['teacherName' => 'Invalid credentials']);
            }

            // Store teacher ID
            session([
                'teacher_id' => $teacher->teacherID,
                'role' => 'teacher',
            ]);

            return redirect()->route('teacher_view'); // Teacher dashboard
        }
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['teacher_id', 'student_id', 'role', 'studentFirstName', 'studentLastName']);
        return redirect()->route('login');
    }

    // Helper to get current user
    public static function currentUser()
    {
        if (session('role') === 'teacher' && session('teacher_id')) {
            return teachers::find(session('teacher_id'));
        } elseif (session('role') === 'student' && session('student_id')) {
            return students::where('studentID', session('student_id'))->first();
        }
        return null;
    }
}