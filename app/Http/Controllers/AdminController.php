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
use App\Models\Scholarship;
use App\Models\scholargrant;
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
    }

    // for signup step 2
    public function storeSignup2(Request $request)
    {

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

    // storing new event
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

    public function scholarship(Request $rq)
    {
        $cnter = scholarship::query()->count();
        $id = scholarship::query()->pluck('id');
        $name = scholarship::query()->pluck('name');
        $email = scholarship::query()->pluck('email');
        $contact =  scholarship::query()->pluck('contact');
        $desc = scholarship::query()->pluck('desc');
        $process = scholarship::query()->pluck('process');
        $sid = scholarship::query()->pluck('scholarshipid');

        return view('admin.scholarship.index', compact('cnter', 'id', 'name', 'email', 'contact', 'desc', 'process', 'sid'));
    }

    public function savescholar(Request $rq)
    {
        $name = $rq->scholarshipName;
        $type = $rq->type;
        $desc = $rq->scholarshipDescription;
        $process = $rq->scholarshipApplicationProcess;
        $email = $rq->scholarshipEmail;
        $contact = $rq->contact;

        // dd($contact);

        $n = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }


        $scholarid =  date("Y") . "-" . $randomString;


        scholarship::create([
            'name' => $name,
            'email' => $email,
            'type' => $type,
            'desc' => $desc,
            'process' => $process,
            'contact' => $contact,
            'scholarshipid' => $scholarid,
        ]);

        return redirect()->route('admin.scholarships');
        //    return view('admin.scholarship.index');
    }
    public function delete(Request $rq)
    {
        $id = $rq->schoid;
        Scholarship::where('scholarshipid', '=', $id)->delete();

        return redirect()->route('admin.scholarships');
    }

    public function Grantees(request $rq)
    {
        $cnter = scholargrant::query()->count();
        $id = scholargrant::query()->pluck('id');
        $lname = scholargrant::query()->pluck('Lname');
        $fname = scholargrant::query()->pluck('Fname');
        $Mname = scholargrant::query()->pluck('Mname');
        $program = scholargrant::query()->pluck('program');
        $type = scholargrant::query()->pluck('type');
        $Yrlevel = scholargrant::query()->pluck('Yrlevel');
        $studentEmail = scholargrant::query()->pluck('studentemail');
        $studentID = scholargrant::query()->pluck('studentId');
        $contact = scholargrant::query()->pluck('contact');
        $status = scholargrant::query()->pluck('status');


        //     scholargrant::create([
        //         'Last_name'=>$lastname,
        //         'First_name'=>$firstName,
        //         'Middle_name'=>$middleName,
        //         'Program'=>$program,
        //         'type'=>$paymentType,
        //         'Year_Level'=>$Yrlevel,
        //         'Student_email'=>$studentEmail,
        //         'Student_id'=>$studentID,
        //         'Contact'=>$contact,
        //    ]);


        return view('admin.scholarship.grantees', compact('id', 'cnter', 'lname', 'fname', 'Mname', 'program', 'type', 'Yrlevel', 'studentEmail', 'studentID', 'contact', 'status'));
    }

    public function savesgrant(Request $rq)
    {
        $lastname = $rq->lastName;
        $firstName = $rq->firstName;
        $middleName = $rq->middleName;
        $program = $rq->program;
        $paymentType = $rq->paymentType;
        $Yrlevel = $rq->Yrlevel;
        $studentEmail = $rq->studentEmail;
        $studentID = $rq->studentID;
        $status = $rq->status;
        $contact = $rq->contact;



        scholargrant::create([
            'Lname' => $lastname,
            'Fname' => $firstName,
            'Mname' => $middleName,
            'program' => $program,
            'type' => $paymentType,
            'Yrlevel' => $Yrlevel,
            'studentemail' => $studentEmail,
            'studentId' => $studentID,
            'contact' => $contact,
            'status' => $status,


        ]);

        return redirect()->route('admin.grantees');
    }
    // public function EditGrant(Request $rq)
    // {
    //     $id = $rq->id;
    //     dd($id);
    //     $id = scholargrant::where('id', '=', $id)->pluck('id');
    //     $lname = scholargrant::where('id', '=', $id)->pluck('Lname');
    //     $fname = scholargrant::where('id', '=', $id)->pluck('Fname');
    //     $Mname = scholargrant::where('id', '=', $id)->pluck('Mname');
    //     $program = scholargrant::where('id', '=', $id)->pluck('program');
    //     $type = scholargrant::where('id', '=', $id)->pluck('type');
    //     $Yrlevel = scholargrant::where('id', '=', $id)->pluck('Yrlevel');
    //     $studentEmail = scholargrant::where('id', '=', $id)->pluck('studentemail');
    //     $studentID = scholargrant::where('id', '=', $id)->pluck('studentId');
    //     $status = scholargrant::where('id', '=', $id)->pluck('status');
    //     $contact = scholargrant::where('id', '=', $id)->pluck('contact');


    //     // scholargrant::where('id', '=', $id)->update([
    //     // 'Lname'=>$lastname,
    //     // 'Fname'=>$firstName,
    //     // 'Mname'=>$middleName,
    //     // 'program'=>$program,
    //     // 'type'=>$paymentType,
    //     // 'Yrlevel'=>$Yrlevel,
    //     // 'studentemail'=>$studentEmail,
    //     // 'studentId'=>$studentID,
    //     // 'contact'=>$contact,

    //     return view('admin.EditGrants', compact('id', 'lname', 'fname', 'Mname', 'program', 'type', 'Yrlevel', 'studentEmail', 'studentID', 'contact', 'status'));
    // }
    public function EditGrant(Request $rq)
    {
        $id = $rq->id;

        // Find the scholargrant record by id
        $scholargrant = scholargrant::find($id);

        // Check if the record exists
        if (!$scholargrant) {
            abort(404); // Or handle the case where the record is not found
        }

        // Retrieve the values of specific columns
        $lname = $scholargrant->Lname;
        $fname = $scholargrant->Fname;
        $Mname = $scholargrant->Mname;
        $program = $scholargrant->program;
        $type = $scholargrant->type;
        $Yrlevel = $scholargrant->Yrlevel;
        $studentEmail = $scholargrant->StudentEmail;
        $studentID = $scholargrant->StudentID;
        $status = $scholargrant->status;
        $contact = $scholargrant->contact;

        // dd(compact('id', 'lname', 'fname', 'Mname', 'program', 'type', 'Yrlevel', 'studentEmail', 'studentID', 'contact', 'status'));
        // Pass the retrieved data to the view for editing
        return view('admin.scholarship.EditGrants', compact('id', 'lname', 'fname', 'Mname', 'program', 'type', 'Yrlevel', 'studentEmail', 'studentID', 'contact', 'status'));
    }


    public function EditGrants(Request $rq)
    {
        $id = $rq->id;
        $lastname = $rq->lastName;
        $firstName = $rq->firstName;
        $middleName = $rq->middleName;
        $program = $rq->program;
        $paymentType = $rq->paymentType;
        $Yrlevel = $rq->Yrlevel;
        $studentEmail = $rq->studentEmail;
        $studentID = $rq->studentID;
        $contact = $rq->contact;
        $status = $rq->status;


        // dd(compact('id', 'lastname', 'firstName',  'middleName', 'program', 'paymentType', 'Yrlevel', 'studentEmail','studentID','contact','status'));
        scholargrant::where('id', '=', $id)->update([
            'Lname' => $lastname,
            'fname' => $firstName,
            'Mname' => $middleName,
            'program' => $program,
            'type' => $paymentType,
            'Yrlevel' => $Yrlevel,
            'studentemail' => $studentEmail,
            'studentId' => $studentID,
            'contact' => $contact,
            'status' => $status,
        ]);

        return redirect()->route('admin.grantees');
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