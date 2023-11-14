<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Student;

class GoogleAuthController extends Controller
{
    public function showTest()
    {
        return view('test');
    }

    public function redirect() // first route the sso go through
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback() 
    {
        try {

            $google_user_id = Socialite::driver('google')->user();

            // finding if this google account already signed up before
            $findStudent = Student::where('google_id', $google_user_id->getId())->first();

            if ($findStudent) { // if login
                Auth::login($findStudent);
                return redirect( route('student_dashboard') )->with('message', 'Welcome back!');
            } else { // if signup
                try {
                    $newStudent = Student::create([
                        'student_lname' => $google_user_id->user['family_name'],
                        'student_fname' => $google_user_id->user['given_name'],
                        'student_picture' => $google_user_id->user['picture'],
                        'email' => $google_user_id->user['email'],
                        'google_id' => $google_user_id->user['id'],
                        // 'password' => '' // you can change auto generate password here and send it via email but you need to add checking that the user need to change the password for security reasons
                    ]);
                } catch (Exception $e) {
                    dd($e->getMessage()); // Log or print the exception message for debugging
                }

                Auth::login($newStudent);  //this is for logging the student in

                // Store 'google_id' in the session
                session()->put('google_id', $google_user_id->user['id']);

                return redirect( route('student_signup1') );

                
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            back();
        }
    }
}


// return redirect('/student')->with('message', 'Successfully created your student account!');
