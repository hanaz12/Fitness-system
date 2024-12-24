<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Coach;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PackageController extends Controller
{
    public function index()
    {
        $packages = package::all();
        return view('packagesViewAdminView', compact('packages'));
    }


   public function store(Request $request)
{
    try {
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|unique:packages|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'duration' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
            'coach_id' => 'nullable|exists:coaches,id',
            'admin_id' => 'required|exists:admins,id',
        ]);


        $package = Package::create($validated);




        if (!empty($package->coach_id)) {
            $coach = Coach::find($package->coach_id);
            if ($package->status === 'available') {
                // Message when the package is available
                $notificationMessage = "🎉 Congratulations! You are now the responsible coach for the package '{$package->name}'. 🎉\n\nThis package is now available, and you can start working on it.";
            } else {
                // Message when the package is unavailable
                $notificationMessage = "🚨 Important Update! 🚨\n\nYou have been assigned as the responsible coach for the package '{$package->name}', but it is currently unavailable.";
            }

            // Send the notification to the coach
            DB::table('notifications')->insert([
                'sender_id' => null,  // Assume the admin is sending the notification
                'sender_type' => 'Admin',
                'receiver_id' => $coach->id,
                'receiver_type' => 'Coach',
                'message' => $notificationMessage,
                'status' => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Debug: Check notification for the coach
            \Log::info('Coach Notification Sent:', ['coach_id' => $coach->id, 'message' => $notificationMessage]);
        }

        // Send notifications to all trainees about the package status
        $trainees = DB::table('trainees')->get();
        foreach ($trainees as $trainee) {
            if ($package->status === 'available') {
                // Message when the package is available
                $traineeMessage = "🎉 New Package Available! 🎉\n\nThe package '{$package->name}' is now available! Check it out and get started.";
            } else {
                // Message when the package is unavailable
                $traineeMessage = "🚨 Package Update! 🚨\n\nThe package '{$package->name}' is currently unavailable. Stay tuned for updates.";
            }

            // Send the notification to the trainee
            DB::table('notifications')->insert([
                'sender_id' => null,  // Assume the admin is sending the notification
                'sender_type' => 'Admin',
                'receiver_id' => $trainee->id,
                'receiver_type' => 'Trainee',
                'message' => $traineeMessage,
                'status' => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Debug: Check notification for the trainee
            \Log::info('Trainee Notification Sent:', ['trainee_id' => $trainee->id, 'message' => $traineeMessage]);
        }

        // Redirect with success message
        return redirect()->route('packages.admin')->with('success', 'Package added successfully!');
    } catch (\Exception $e) {
        // Log the error and display an error message
        \Log::error('Error storing package: ' . $e->getMessage());

        // Redirect with error message
        return redirect()->route('packages.admin')->with('error', 'An error occurred while adding the package. Please try again.');
    }
}




    public function showEditForm($id)
    {
        $package = Package::findOrFail($id);

        // جلب قائمة الـ coaches
        $coaches = Coach::where('status', 'active')->get();

        $admins = Admin::all();
        $subscribedTraineesCount = DB::table('trainees')
        ->where('package_id', $package->id)
        ->count();

        // تمرير البيانات إلى الـ View
        return view('packageEditForm', [
            'package' => $package,
            'coaches' => $coaches,
            'admins' => $admins,
            'subscribedTraineesCount' => $subscribedTraineesCount,
        ]);
    }



public function update(Request $request, $id)
{
    $package = Package::findOrFail($id);
    $oldStatus = $package->status; // الحالة القديمة
    $oldCoachId = $package->coach_id; // المدرب القديم

    // التحقق من صحة البيانات
    $validatedData = $request->validate([
        'name' => 'required|string|unique:packages,name,' . $package->id . '|max:255',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:1|max:100',
        'duration' => 'required|numeric',
        'description' => 'nullable|string',
        'status' => 'required|in:available,unavailable',
        'coach_id' => 'nullable|exists:coaches,id',
        'admin_id' => 'required|exists:admins,id',
    ]);

    // إذا كانت الباكدج متاحة، يجب تعيين مدرب
    if ($validatedData['status'] === 'available' && !$validatedData['coach_id']) {
        return redirect()->back()->withErrors(['coach_id' => 'A coach must be assigned if the package is available.']);
    }

    // إذا كانت الباكدج تحتوي على متدربين ولا يمكن تغيير الحالة إلى unavailable
    if ($validatedData['status'] === 'unavailable' && $package->trainees()->count() > 0) {
        return redirect()->back()->withErrors(['status' => 'Cannot make the package unavailable while it has enrolled trainees.']);
    }

    // التحقق من التغييرات
    $statusChanged = $oldStatus !== $validatedData['status']; // إذا تغيرت الحالة
    $coachChanged = isset($validatedData['coach_id']) && $validatedData['coach_id'] !== $oldCoachId; // إذا تغير المدرب
    $detailsChanged = $validatedData['price'] !== $package->price
                    || $validatedData['discount'] !== $package->discount
                    || $validatedData['description'] !== $package->description
                    || $validatedData['duration'] !== $package->duration
                    || $validatedData['name'] !== $package->name; // إضافة الاسم للتحقق من تغييرات التفاصيل

    // تحديث البيانات
    $package->update($validatedData);

    // إرسال إشعارات بناءً على التغييرات
    if ($statusChanged) {
        $this->sendStatusChangeNotifications($package, $oldStatus, $validatedData['status']);
    }

    if ($detailsChanged) {
        $this->sendDetailsChangeNotifications($package);
    }

    if ($coachChanged) {
        $this->sendCoachChangeNotifications($package, $oldCoachId, $validatedData['coach_id']);
    }

    return redirect()->route('packages.admin')->with('success', 'Package updated successfully!');
}

private function sendDetailsChangeNotifications($package)
{
    $trainees = DB::table('trainees')->get();

    foreach ($trainees as $trainee) {
        $message = "📢 The package '{$package->name}' has been updated with new details!";

        DB::table('notifications')->insert([
            'sender_id' => null,
            'sender_type' => 'Admin',
            'receiver_id' => $trainee->id,
            'receiver_type' => 'Trainee',
            'message' => $message,
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
private function sendStatusChangeNotifications($package, $oldStatus, $newStatus)
{
    $trainees = DB::table('trainees')->get();

    foreach ($trainees as $trainee) {
        $message = $newStatus === 'available'
            ? "🎉 The package '{$package->name}' is now available!"
            : "🚨 The package '{$package->name}' is now unavailable.";

        DB::table('notifications')->insert([
            'sender_id' => null,
            'sender_type' => 'Admin',
            'receiver_id' => $trainee->id,
            'receiver_type' => 'Trainee',
            'message' => $message,
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

private function sendCoachChangeNotifications($package, $oldCoachId, $newCoachId)
{
    // إشعار الكوتش القديم
    if ($oldCoachId) {
        $oldCoach = Coach::find($oldCoachId);
        if ($oldCoach) {
            $message = "🚨 You are no longer responsible for the package '{$package->name}'.";
            DB::table('notifications')->insert([
                'sender_id' => null,
                'sender_type' => 'Admin',
                'receiver_id' => $oldCoach->id,
                'receiver_type' => 'Coach',
                'message' => $message,
                'status' => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // إشعار الكوتش الجديد
    if ($newCoachId) {
        $newCoach = Coach::find($newCoachId);
        if ($newCoach) {
            $message = "🎉 You are now responsible for the package '{$package->name}'.";
            DB::table('notifications')->insert([
                'sender_id' => null,
                'sender_type' => 'Admin',
                'receiver_id' => $newCoach->id,
                'receiver_type' => 'Coach',
                'message' => $message,
                'status' => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


    public function showAddForm(){
        $coaches = Coach::where('status', 'active')->get();
        return view('addPackageAdminView', ['coaches' => $coaches]);
    }

}
