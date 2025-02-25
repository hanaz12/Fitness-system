<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Trainee;
use App\Mail\WelcomeCoach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CoachController extends Controller
{

    public function homepage()
{
  
    $coach_id = session('user_id');

    // جلب المتدربين الذين ينتمون إلى الباقة الخاصة بالكوتش
    $trainees = Trainee::with(['package', 'plan'])
        ->whereHas('package', function ($query) use ($coach_id) {
            $query->where('coach_id', $coach_id); // تصفية المتدربين الذين لديهم package مع coach_id الخاص بالكوتش
        })
        ->get();
    return view('coachHomePage', compact('trainees'));
}



    public function index()
    {
        $coaches = Coach::all();
        return view('coachesViewAdminView', compact('coaches'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:coaches,email',
                'user_name' => 'required|string|max:255|unique:coaches,user_name',
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'admin_id' => 'required|exists:admins,id',
                'salary' => 'required|numeric',
                'password' => [
            'required',
            'string',
            'min:6',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&#]/',
        ], [

            'user_name.unique' => 'The username is already taken. Please choose another one.',
            'email.unique' => 'The email is already registered. Please use a different email address.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]]);


            $validated['password'] = bcrypt($validated['password']);
            $coach = new Coach($validated);
            $coach->save();

            Mail::to($coach->email)->send(new WelcomeCoach($coach));

            return redirect()->route('coachesViewAdminView')->with('success', 'Coach added successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create Coach: ' . $e->getMessage());
        }
    }



    public function edit($id)
    {
        try {
            $coach = Coach::findOrFail($id);
            return view('editCoachInfo', compact('coach'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve coach data: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request for Admin Moderator updating Admin's data
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:coaches,email,' . $id,
                'user_name' => 'required|string|max:255|unique:coaches,user_name,' . $id,
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'salary' => 'nullable|numeric',
                'password' => 'nullable|string|min:6',
                'admin_id' => 'nullable|exists:admins,id',
            ]);


            $coach = Coach::findOrFail($id);

            // If password is provided, hash it before updating
            if ($request->filled('password')) {
                $validated['password'] = bcrypt($request->password);
            }

            // Update the admin data with the validated information
            $coach->update($validated);

            // Redirect to the Admin Moderator Home Page
            return redirect()->route('coaches.admin')->with('success', 'coach updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update Admin: ' . $e->getMessage());
        }
    }
    


    public function updateProfile(Request $request, $id)
    {
        try {
           
            $coach = Coach::findOrFail($id);

           
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:coaches,email,' . $id,
                'user_name' => 'required|string|max:255|unique:coaches,user_name,' . $id,
                'phone' => 'required|numeric',
                'address' => 'required|string',
            ]);

            // تحديث البيانات
            $coach->update($validated);

            return redirect()->back()->with('success', 'Your profile has been updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }



    public function editCoachView($id)
    {
        try {

            $coach = Coach::findOrFail($id);

            return view('editCoachPersonalInfoCoachView', compact('coach'));

        } catch (\Exception $e) {
            // في حالة حدوث خطأ
            return back()->with('error', 'Failed to retrieve coach data: ' . $e->getMessage());
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


        $coach = Coach::findOrFail($id);


        $coach->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return back()->with('success', 'Password updated successfully.');

    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update password: ' . $e->getMessage());
    }
}
public function indexHelp()
    {

        return view('HelpCoachView');
    }
    public function manageTrainee($id)
{

    $trainee = Trainee::findOrFail($id);
    $plan = $trainee->plan;
    return view('manageTraineeCoachView', compact('trainee', 'plan'));
}


public function showAddForm(){
    return view('addNewCoachAdminView');
}
public function blockCoach($id)
{

    $coach = Coach::findOrFail($id);


    $coach->status = 'blocked';
    $coach->save();


    return redirect()->route('coaches.admin')
                     ->with('success', 'Coach has been blocked successfully.');

}

public function unblockCoach($id)
{
    $coach = Coach::findOrFail($id);
    $coach->status = 'active';
    $coach->save();

    return redirect()->route('coaches.admin')
                     ->with('success', 'Coach has been un blocked successfully.');
}

}
