<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    // Method to display notifications
    public function index()
    {
        // Get the user type and ID from the session
        $userId = session('user_id');
        $userRole = session('user_role');

        // Fetch notifications for the current user (based on role and ID)
        $notifications = DB::table('notifications')
            ->where('receiver_id', $userId)
            ->where('receiver_type', $userRole)  // This can be Admin, Coach, Trainee, etc.
            ->orderBy('created_at', 'desc')
            ->get();

        // Update status to 'read' for all unread notifications when user enters the page
        DB::table('notifications')
            ->where('receiver_id', $userId)
            ->where('receiver_type', $userRole)
            ->where('status', 'unread')
            ->update(['status' => 'read']);

        // Return the notifications view with the data
        return view('notifications', compact('notifications'));
    }

    // Method to delete a notification by ID
    public function clear($id)
    {
        // Get the user ID from the session
        $userId = session('user_id');
        $userRole = session('user_role');

        // Delete the notification if it belongs to the logged-in user
        $deleted = DB::table('notifications')
            ->where('id', $id)
            ->where('receiver_id', $userId)
            ->where('receiver_type', $userRole)
            ->delete();

        if ($deleted) {
            return redirect()->route('notifications.index')->with('success', 'Notification cleared successfully.');
        } else {
            return redirect()->route('notifications.index')->with('error', 'Failed to clear the notification.');
        }
    }
}
