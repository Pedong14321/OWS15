<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use App\Models\Office;
use App\Models\AdminType;
use App\Models\Student;
use App\Models\StudentEvent;
use Intervention\Image\Facades\Image; // see notes below
use Illuminate\Support\Facades\Log;
use Illuminate\Session\TokenMismatchException;

class AdminController extends Controller
{

    public function showTest() // for testing purposes only
    {
        return view('test');
    }

    //-------------------------functions for views-------------------------

    // returns view
    public function showSignup1()
    {
        return view('admin.signup-step1');
    }
    public function showSignup2()
    {
        return view('admin.signup-step2');
    }
    public function showLogin()
    {
        return view('admin.login');
    }
    public function showIndex()
    {
        return view('admin.index');
    }
    public function showOfficeIndex()
    {
        return view('admin.office.index');
    }
    public function showAdminManage()
    {
        $admins = Admin::all();
        $offices = Office::all();
        $admin_types = AdminType::all();
        return view('admin.manage', compact('admins', 'offices', 'admin_types'));
    }
    public function showProfile($admin_id)
    {
        // Fetch the admin's data from the database based on the $adminId
        $admin = Admin::find($admin_id);

        // Check if the admin exists
        if (!$admin) { // You can handle what to do if the admin is not found, such as displaying an error message or redirecting to a 404 page.
            return view('errors.admin_not_found');  // For example, you can return a view with an error message:
        }

        // Pass the admin data to the view and display it
        return view('admin.profile', ['admin' => $admin]);
    }
    public function showCreateAdmin()
    {
        $offices = Office::all();
        $admin_types = AdminType::all();
        return view('admin.create', compact('offices', 'admin_types'));
    }
    public function showQRscanner()
    {
        return view('admin.student_event.qr-scanner');
    }
    public function showStudentEvents()
    {
        $student_events = StudentEvent::all();
        return view('admin.student_event.index', compact('student_events'));
    }
    public function showCreateEvents()
    {
        return view('admin.student_event.create');
    }
    //-------------------------functions for functionality-------------------------

    // storing signup step 1
    public function storeSignup1(Request $request)
    {
        try {
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

            // Store 'admin_id' in the session
            session()->put('admin_id', $newAdmin->admin_id);

            return redirect(route('admin_signup2'))
                ->with('message', 'Successfully saved your info');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            back();
        }
    }

    // for signup step 2
    public function storeSignup2(Request $request)
    {
        try {
            $adminId = session('admin_id'); // Retrieve 'admin_id' from the session

            $validated = $request->validate([
                "employee_id" => ['required', 'max:6'],
            ]);

            $validated['admintype_id'] = 1; // assigning Super Admin type

            $validated['office_id'] = 1; // assigning office to OSAS

            $admin = Admin::find($adminId); // Find the admin by ID and update the attributes

            if (!$admin) { // if admin is not found
                return redirect()->back()->with('error', 'Admin not found');
            }

            // code for image upload
            // checking if there is a file
            if ($request->hasFile('admin_image')) {

                $request->validate([ // validation for right format and size
                    "admin_image" => 'mimes:jpeg,png,bmp,tiff | max:4096'
                ]);

                // to avoid duplication of image
                $filenameWithExtension = $request->file("admin_image"); // gets the filename+extension
                $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME); // extracts filename only without extension

                $extension = $request->file("admin_image") // gets the extension of the file 
                    ->getClientOriginalExtension();

                $filenameToStore = $filename . '_' . time() . '.' . $extension; // filename_timestamp.extention

                $smallThumbnail = 'small_' . $filename . '_' . time() . '.' . $extension; // small_filename_timestamp.extention

                $request->file('admin_image')->storeAs( // stores the image to ...
                    'public/admin',
                    $filenameToStore
                );

                $request->file('admin_image')->storeAs( // stores the small image to ...
                    'public/admin/thumbnail',
                    $smallThumbnail
                );

                $thumbnail = 'storage/admin/thumbnail/' . $smallThumbnail; // assigns the path to the thumbnail image to this variable
                // example content of $thumbnail is /storage/admin/thumbnail/small_my-image_1670915990.png

                // dd($thumbnail); // <- for debugging only
                $this->createThumbnail($thumbnail, 150, 150);

                $validated['admin_image'] = $filenameToStore; // stores the new filename to db
            }

            $admin->update($validated); // updating the data of that admin

            return redirect(route('admin_login'))->with('message', 'Successfully created Super Admin account');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            back();
        }
    }

    // for creating new admin
    public function storeCreate(Request $request)
    {
        try {
            $validated = $request->validate([
                "admin_lname" => ['required', 'min:2', 'alpha_spaces'],
                "admin_fname" => ['required', 'min:2', 'alpha_spaces'],
                "admin_mi" => ['required', 'regex:/^(N\/A|[A-Za-z])$/'], //require to be clearer, user must put N/A if they have no mi
                "employee_id" => ['required', 'max:6'],
                "office_id" => ['required'],
                "admintype_id" => ['required'],
                "admin_contact" => ['nullable', 'numeric', 'digits_between:10,15'],
                "email" => ['required', 'email', Rule::unique('admins', 'email')],
            ]);

            // checking if there is a file
            if ($request->hasFile('admin_image')) {
                $request->validate([ // validation for right format and size
                    "admin_image" => 'mimes:jpeg,png,bmp,tiff | max:4096'
                ]);

                // to avoid duplication of image
                $filenameWithExtension = $request->file("admin_image"); // gets the filename+extension
                $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME); // extracts filename only without extension

                $extension = $request->file("admin_image") // gets the extension of the file 
                    ->getClientOriginalExtension();

                $filenameToStore = $filename . '_' . time() . '.' . $extension; // filename_timestamp.extention

                $smallThumbnail = 'small_' . $filename . '_' . time() . '.' . $extension; // small_filename_timestamp.extention

                $request->file('admin_image')->storeAs( // stores the image to ...
                    'public/admin',
                    $filenameToStore
                );

                $request->file('admin_image')->storeAs( // stores the small image to ...
                    'public/admin/thumbnail',
                    $smallThumbnail
                );

                $thumbnail = 'storage/admin/thumbnail/' . $smallThumbnail; // assigns the path to the thumbnail image to this variable
                // example content of $thumbnail is /storage/admin/thumbnail/small_my-image_1670915990.png

                // dd($thumbnail); // <- for debugging only
                $this->createThumbnail($thumbnail, 150, 150);

                $validated['admin_image'] = $filenameToStore; // stores the new filename to db
            }

            Admin::create($validated);
            return redirect(route('admin_manage'))->with('message', 'Successfully create new admin account!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            back();
        }
    }

    // creating a small thumbnail
    public function createThumbnail($path, $width, $height) // $path is the path of the thumbnail
    { //  creates a thumbnail image 

        $img = Image::make($path)->resize( // loads into an Intervention Image object, see notes below
            $width,
            $height,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        );
        $img->save($path); // save the resized image back to the original path
    }

    // login
    public function processLogin(Request $request)
    {
        // crsf error handler
        try {

            $validated = $request->validate([
                "email" => ['required', 'email'],
                'password' => 'required'
            ]);

            if (auth()->guard('admin')->attempt($validated)) { // guarded athentication
                session()->regenerate();
                return redirect(route('admin_dashboard'))->with('message', 'Successfully Logged In!');
            }

            return back()->with(['custom-error' => 'Login failed! Incorrect Email or Password']);
        } catch (TokenMismatchException $e) {
            return redirect()->route('student_login')->withErrors(['csrf' => 'CSRF token expired. Please try again.']);
        }
    }

    // logout
    public function processLogout(Request $request)
    {
        // crsf error handler
        try {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('admin_login'))->with('message', 'Logout successful');
        } catch (TokenMismatchException $e) {
            return redirect()->route('student_login')->withErrors(['csrf' => 'CSRF token expired. Please try again.']);
        }
    }

    // processing of qr code
    public function processQR(Request $request)
    {
        $student = Student::where('student_osasid', $request['scanner'])->first();
        if (!$student) {
            return redirect()->back()->with('custom-error', 'Student not found');
        }
        return view('admin.student_event.qr-result', compact('student'));
    }

    // creating new event
    public function storeEvent(Request $request)
    {
        try {
            $validated = $request->validate([
                "event_name" => [''],
                "event_date" => [''],
                "event_time_in" => [''],
                "event_time_out" => [''],
                "event_desc" => [''],
            ]);

            StudentEvent::create($validated);

            return redirect(route('admin_stud_events'))->with('message', 'New Event Created!');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            back();
        }
    }
}





// dev notes:

// to install Image Intervention, [composer require intervention/image] 
// -> [composer update]
// -> register in app(config) this in providers array [Intervention\Image\ImageServiceProvider::class,]
// -> publish using [php artisan vendor:publish --provider="Intervention\Image\ImageServiceProvider"]
// -> register alias in app(config) in alias array ['Image' => Intervention\Image\Facades\Image::class,]
// so that I can use this Image in Facades

// [php artisan storage:link] -> to connect the public storage to storage>app