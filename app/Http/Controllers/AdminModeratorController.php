<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminModerator;

class AdminModeratorController extends Controller
{
    // // عرض الفورم
    // public function create()
    // {
    //     return view('admin_moderator_form');
    // }

    public function addAdmin()
    {
        return view('addNewAdmin');
    }

    // // تخزين البيانات
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'user_name' => 'required|string|max:255|unique:admin_moderators,user_name',
    //         'email' => 'required|email|max:255|unique:admin_moderators,email',
    //         'phone' => 'required|string|max:15',
    //         'address' => 'required|string|max:255',
    //        'password' => [
    //         'required',
    //         'string',
    //         'min:6',
    //         'regex:/[A-Z]/',
    //         'regex:/[a-z]/',
    //         'regex:/[0-9]/',
    //         'regex:/[@$!%*?&#]/',
    //         'address' => 'required|string|max:255'
    //     ]], [

    //         'user_name.unique' => 'The username is already taken. Please choose another one.',
    //         'email.unique' => 'The email is already registered. Please use a different email address.',
    //         'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
    //     ]);

    //     $validated['password'] = bcrypt($validated['password']); // تشفير كلمة المرور

    //     AdminModerator::create($validated); // حفظ البيانات

    //     return redirect()->route('test')->with('success', 'Admin Moderator added successfully!');
    // }
    public function editAdminView($id)
    {
        try {

            $admin = AdminModerator::findOrFail($id);
            return view('editAdminModeratorInfoAdminModeratorView', compact('admin'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve admin data: ' . $e->getMessage());
        }
    }
    public function updateProfile(Request $request, $id)
    {
        try {

            $admin = AdminModerator::findOrFail($id);
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:admin_moderators,email,' . $id,
                'user_name' => 'required|string|max:255|unique:admin_moderators,user_name,' . $id,
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


        $admin = AdminModerator::findOrFail($id);


        $admin->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return back()->with('success', 'Password updated successfully.');

    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update password: ' . $e->getMessage());
    }
}
}
