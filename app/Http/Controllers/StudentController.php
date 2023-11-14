<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showIndex()
    {
        return view('student.index');
    }

    public function showLogin()
    {
        return view('student.login');
    }

    public function showSignup1()
    {
        // Retrieve students with the specific google_id
        $google_id = session('google_id');
        $student = Student::where('google_id', $google_id)->get();
        foreach ($student as $student_instance) {
            return view('student.signup-step1')->with('student', $student_instance);
        }
    }

    public function showProfile($student_id) {
        // Fetch the admin's data from the database based on the $adminId
        $student = Student::find($student_id);

        // Check if the admin exists
        if (!$student) { // You can handle what to do if the admin is not found, such as displaying an error message or redirecting to a 404 page.
            return view('errors.stundent_not_found');  // For example, you can return a view with an error message:
        }

        // Pass the admin data to the view and display it
        return view('student.profile', ['student' => $student]);
    }

    // logout
    public function processLogout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('student_login'))->with('message', 'Logout successful');
    }
}
