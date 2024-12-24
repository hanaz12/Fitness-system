<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
{
    $user_name = $request->input('user_name');
    $password = $request->input('password');
    $userRole = $request->input('user');

    if (empty($user_name) || empty($password) || empty($userRole)) {
        return back()->with('error', 'Username, password, and user type are required.');
    }


    if ($userRole == 'trainee') {
        $user = DB::table('trainees')->where('user_name', $user_name)->first();
    } elseif ($userRole == 'Admin') {
        $user = DB::table('admins')->where('user_name', $user_name)->first();
    } elseif ($userRole == 'Admin-moderator') {
        $user = DB::table('admin_moderators')->where('user_name', $user_name)->first();
    } elseif ($userRole == 'Coach') {
        $user = DB::table('coaches')->where('user_name', $user_name)->first();
    } else {
        return back()->with('error', 'Invalid user type.');
    }


    if (!$user) {
        return back()->with('error', 'User not found.');
    }


    if ($userRole != 'Admin-moderator' &&$user->status == 'blocked' ) {
        return back()->with('error', 'Your account is blocked.');
    }


    if (Hash::check($password, $user->password)) {

        session([
            'user_id' => $user->id,
            'user_name' => $user->user_name,
            'user_role' => $userRole,
            'email' => $user->email ?? null,
            'first_name' => $user->first_name ?? null,
            'last_name' => $user->last_name ?? null,
        ]);


        if ($userRole == 'trainee') {
            return redirect('/traineeHomePage');
        } elseif ($userRole == 'Admin') {
            return redirect('/adminHomePage');
        } elseif ($userRole == 'Admin-moderator') {
            return redirect('/adminModeratorHomePage');
        } elseif ($userRole == 'Coach') {
            return redirect('/coachHomePage');
        }
    } else {
        return back()->with('error', 'Invalid credentials.');
    }
}

public function logout(Request $request)
{
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('logined')->with('success', 'You have successfully logged out.');
}

public function showLoginForm()
{
    return view('loginpage');
}

}
