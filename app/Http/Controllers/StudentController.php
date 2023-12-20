<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Student;
use App\Models\QRCode;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\TokenMismatchException;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QR_Code;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    //-------------------------functions for views-------------------------

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

        // retrieve all courses
        $courses = Course::all();

        // Retrieve students with the specific google_id
        $google_id = session('google_id');
        $student = Student::where('google_id', $google_id)->get();
        foreach ($student as $student_instance) {
            return view('student.signup-step1', compact('courses'))->with('student', $student_instance);
        }
    }

    public function showProfile($student_id)
    {
        // Fetch the admin's data from the database based on the $adminId
        $student = Student::find($student_id);

        // Check if the admin exists
        if (!$student) { // You can handle what to do if the admin is not found, such as displaying an error message or redirecting to a 404 page.
            return view('errors.stundent_not_found');  // For example, you can return a view with an error message:
        }

        // Pass the admin data to the view and display it
        return view('student.profile', ['student' => $student]);
    }

    //-------------------------functions for functionality-------------------------

    // logout
    public function processLogout(Request $request)
    {
        try {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('student_login'))->with('message', 'Logout successful');
        } catch (TokenMismatchException $e) {
            return redirect()->route('student_login')->withErrors(['csrf' => 'CSRF token expired. Please try again.']);
        }
    }

    // storing signup1
    public function storeSignup1(Request $request, $student_id)
    {
        try {
            $validated = $request->validate([
                "course_id" => ['required'],
            ]);

            $student = Student::find($student_id); // Find the admin by ID and update the attributes

            if ($student) {
                $student->update($validated); // Update the data of that student
                // Additional logic if needed
                Auth::guard('student')->login($student); // logging student with 'student' guard
                return redirect(route('student_dashboard'))->with('message', 'Successfully save student info!');
            } else {
                return response()->json(['error' => 'Student not found'], 404);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            back();
        }
    }

    public function displayQRCode() // create qrcode button if no qrcode yet
    {
        if (Auth::check()) {
            $student_qrcode = QRCode::where('student_osasid', Auth::user()->student_osasid)->first();

            if ($student_qrcode) {
                return response()->json(['qrcode_filename' => $student_qrcode->qrcode_filename]);
            } else {
                return response()->json(['error' => 'No QR code found for the logged-in student.']);
            }
        } else {
            return response()->json(['error' => 'You are not logged in.']);
        }
    }

    public function generateQR($student_id)
    {
        // the content is the padded student_osasid
        $qrContent = 'OWS-' . str_pad($student_id, 5, '0', STR_PAD_LEFT);

        // filename is the osasid with time and its extension.
        $filename = $qrContent . '_' . time() . '.svg';

        // Set the size of the QR code ++
        QR_Code::size(200)
        ->margin(5)
        ->generate($qrContent, public_path('images/student/qrcode/' . $filename));

        // Store the generated QR code in the storage directory
        Storage::disk('public')->put('student/qrcode/' . $filename, file_get_contents(public_path('images/student/qrcode/' . $filename)));

        // array to supply creation of QRCode model instance
        $data = [
            'qrcode_filename' => $filename,
            'student_osasid' => $student_id,
        ];

        // Creating a new instance of the QRCode model and saving it to the database
        QRCode::create($data);

        // going back to dashboard
        return redirect(route('student_dashboard'))->with('message', 'Successfully created your QR Code!');
    }
}
