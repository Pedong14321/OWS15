<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;

class AdminController extends Controller
{

    public function showTest() // for testing purposes only
    {
        return view('test');
    }

    // returns view
    public function showSignup1() {
        return view('admin.signup-step1');
    }
    public function showSignup2() {
        return view('admin.signup-step2');
    }

    // storing signup step 1
    public function storeSignup1(Request $request) {

        $validated = $request->validate([
            "admin_lname" => ['required', 'min:2', 'alpha_spaces'],
            "admin_fname" => ['required', 'min:2', 'alpha_spaces'],
            "admin_mi" => ['required', 'regex:/^(N\/A|[A-Za-z])$/'], //require to be clearer, user must put N/A if they have no mi
            "admin_contact" => ['nullable', 'numeric', 'digits_between:10,15'],
            "email" => ['required', 'email', Rule::unique('admins', 'email')],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9])/',
            ],
        ]);
        $validated['password'] = bcrypt($validated['password']); // incrypting the inputted password
        $newAdmin = Admin::create($validated);
        
        
        return redirect(route('admin_signup2'))
            ->with('message', 'Successfully Created an Admin Account');

    }
}
