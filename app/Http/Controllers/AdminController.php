<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use Intervention\Image\Facades\Image; // see notes below

class AdminController extends Controller
{


    public function showTest() // for testing purposes only
    {
        return view('test');
    }

    // returns view
    public function showSignup1()
    {
        return view('admin.signup-step1');
    }
    public function showSignup2()
    {
        return view('admin.signup-step2');
    }

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
            ->with('message', 'Successfully Created an Admin Account');
    }

    // for signup step 2
    public function storeSignup2(Request $request)
    {
        // dd($request->all()); // for debugging only

        $adminId = session('admin_id'); // Retrieve 'admin_id' from the session

        $validated = $request->validate([
            "employee_id" => ['required', 'max:6'],
        ]);

        $validated['admintype_id'] = 1; // assigning Super Admin type

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

        return redirect(route('admin_signup2'))->with('message', 'Admin data updated successfully');
    }
    // creating a thumbnail
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
}





// dev notes:

// to install Image Intervention, [composer require intervention/image] 
// -> [composer update]
// -> register in app(config) this in providers array [Intervention\Image\ImageServiceProvider::class,]
// -> publish using [php artisan vendor:publish --provider="Intervention\Image\ImageServiceProvider"]
// -> register alias in app(config) in alias array ['Image' => Intervention\Image\Facades\Image::class,]
// so that I can use this Image in Facades

// [php artisan storage:link] -> to connect the public storage to storage>app