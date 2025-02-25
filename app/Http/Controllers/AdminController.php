<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Mail\welcomeadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;


class AdminController extends Controller
{
    /**
     * Display a listing of the admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all admins from the database
        $admins = Admin::all();
        return view('adminModeratorHomePage', compact('admins'));
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email',
                'user_name' => 'required|string|max:255|unique:admins,user_name',
                'phone' => 'required|numeric',
                'address' => 'required|string|max:255', // Address validation moved here
                'admin_moderator_id' => 'nullable|exists:admin_moderators,id', // Foreign key
                'salary' => 'nullable|numeric',
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/[A-Z]/',
                    'regex:/[a-z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*?&#]/',
                ]
            ], [
                'user_name.unique' => 'The username is already taken. Please choose another one.',
                'email.unique' => 'The email is already registered. Please use a different email address.',
                'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ]);


            $validated['password'] = bcrypt($validated['password']);
            $admin = new Admin($validated);
             $admin->save();

            Mail::to($admin->email)->send(new welcomeadmin($admin));

            // Redirect to the Admin Moderator home page with success message
            return redirect()->route('adminModeratorHomePage')->with('success', 'Admin created successfully!');
        } catch (\Exception $e) {
            // Return with an error message if there's a failure
            return back()->with('error', 'Failed to Add Admin Moderator: ' . $e->getMessage());
        }
    }

   

    public function edit($id)
    {
        try {

            $admin = Admin::findOrFail($id);


            return view('editAdminInfo', compact('admin'));
        } catch (\Exception $e) {

            return back()->with('error', 'Failed to retrieve admin data: ' . $e->getMessage());
        }
    }

    public function editAdminView($id)
    {
        try {

            $admin = Admin::findOrFail($id);
            return view('editAdminInfoAdminView', compact('admin'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve admin data: ' . $e->getMessage());
        }
    }
    public function updateProfile(Request $request, $id)
    {
        try {

            $admin = Admin::findOrFail($id);
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email,' . $id,
                'user_name' => 'required|string|max:255|unique:admins,user_name,' . $id,
                'phone' => 'required|numeric',
                'address' => 'required|string',
            ]);
            $admin->update($validated);

            return redirect()->back()->with('success', 'Your profile has been updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request, $id)
{
    try {

        $request->validate([
            'password' => [
                'required',
                'string',
                'min:6', // Minimum length
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&#]/', // At least one special character
                'confirmed', // Password confirmation
            ],
        ], [

            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);


        $admin = Admin::findOrFail($id);


        $admin->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return back()->with('success', 'Password updated successfully.');

    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update password: ' . $e->getMessage());
    }
}
    public function update(Request $request, $id)
{
    try {
        // Validate the incoming request for Admin Moderator updating Admin's data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'user_name' => 'required|string|max:255|unique:admins,user_name,' . $id,
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'salary' => 'nullable|numeric',
            'password' => 'nullable|string|min:6',
            'admin_moderator_id' => 'nullable|exists:admin_moderators,id',
        ]);

       
        $admin = Admin::findOrFail($id);

        // If password is provided, hash it before updating
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        // Update the admin data with the validated information
        $admin->update($validated);

        // Redirect to the Admin Moderator Home Page
        return redirect()->route('adminModeratorHomePage')->with('success', 'Admin updated successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update Admin: ' . $e->getMessage());
    }
}





    public function homePage()
    {
        // إجمالي عدد الـ Trainees في النظام
        $totalTrainees = Cache::rememberForever('total_trainees', function () {
            return DB::table('trainees')->count();
        });

        // إجمالي عدد الـ Trainees الذين لديهم اشتراك في Packages
        $traineesWithSubscriptions = Cache::rememberForever('trainees_with_subscriptions', function () {
            return DB::table('trainees')
                ->whereNotNull('package_id') // اشتراط أن تكون الـ package_id غير فارغة
                ->count();
        });

        // إجمالي الـ Revenue بناءً على الـ Trainees و الـ Packages
        $totalRevenue = Cache::rememberForever('total_revenue', function () {
            return DB::table('trainees')
                ->join('packages', 'trainees.package_id', '=', 'packages.id')
                ->sum('packages.price');
        });

        // عدد الكوتشيز (Coaches)
        $totalCoaches = Cache::rememberForever('total_coaches', function () {
            return DB::table('coaches')->count();
        });

        // عدد الـ Packages
        $totalPackages = Cache::rememberForever('total_packages', function () {
            return DB::table('packages')->count();
        });

        // تمرير البيانات إلى الـ View
        return view('homeViewOfAdminHomePage', compact(
            'totalTrainees',
            'traineesWithSubscriptions',
            'totalRevenue',
            'totalCoaches',
            'totalPackages'
        ));
    }



    // Block Admin method
    public function blockAdmin($id)
    {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Update the admin's status to 'blocked' (or any status you define)
        $admin->status = 'blocked';
        $admin->save();

        // Redirect back with a success message
        return redirect()->route('adminModeratorHomePage')
                         ->with('success', 'Admin has been blocked successfully.');

}

public function unblockAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->status = 'active';  // Assuming 'active' is the status
        $admin->save();

        return redirect()->route('adminModeratorHomePage')
                         ->with('success', 'Admin has been un blocked successfully.');
    }


    public function trainees()
    {
      
        $trainees = DB::table('trainee_package_plan_view')->get();
        return view('traineesAdminView', compact('trainees'));
    }

}


