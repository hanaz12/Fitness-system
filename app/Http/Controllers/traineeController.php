<?php
namespace App\Http\Controllers;


use App\Models\Plan;
use App\Models\Package;
use App\Models\Trainee;
use App\Mail\WelcomeMail;
use App\Mail\subscribtion;
use Illuminate\Http\Request;
use App\Mail\cancelSubscribtion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class traineeController extends Controller
{
    public function create()
    {
        return view('signup');
    }


public function plan($id)
{

    $trainee = Trainee::findOrFail($id);
    $coachPhone = null;
        if ($trainee->package_id) {
            $coach = DB::table('packages')
                ->join('coaches', 'packages.coach_id', '=', 'coaches.id')
                ->where('packages.id', $trainee->package_id)
                ->select('coaches.phone')
                ->first();

            if ($coach) {
                $coachPhone = $coach->phone;
            }
        }

    if (is_null($trainee->package_id)) {
        $message = "You should subscribe to one of the available packages to receive your specific plan.";
        return view('plansTraineeView', [
            'message' => $message,
            'plan' => null,
            'trainee' => $trainee,
            'packageName' => null,
            'coachPhone'=>$coachPhone,
        ]);
    }


    $plan = Plan::where('trainee_id', $id)->first();


    if (is_null($plan)) {
        $packageName = $trainee->package ? $trainee->package->name : null;
        $message = "Your plan is being prepared, and it will be available soon. We will notify you whan your plan is ready";
        return view('plansTraineeView', [
            'message' => $message,
            'plan' => null,
            'trainee' => $trainee,
            'packageName' => $packageName,
            'coachPhone'=>$coachPhone,
        ]);
    }


    $packageName = $trainee->package ? $trainee->package->name : null;
    return view('plansTraineeView', [
        'message' => null,
        'plan' => $plan,
        'trainee' => $trainee,
        'packageName' => $packageName,
        'coachPhone'=>$coachPhone,
    ]);
}


    public function store(Request $request)
{

    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'user_name' => 'required|string|max:255|unique:trainees,user_name',
        'email' => 'required|email|unique:trainees,email',
        'password' => [
            'required',
            'string',
            'min:6',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&#]/',
        ],
        'phone' => 'required|string',
        'address' => 'required|string',
        'gender' => 'required|string',
        'age' => 'required|integer',
        'weight' => 'required|numeric',
        'height' => 'required|numeric',
        'medical_history' => 'nullable|string',
        'goal' => 'nullable|string'
    ], [

        'user_name.unique' => 'The username is already taken. Please choose another one.',
        'email.unique' => 'The email is already registered. Please use a different email address.',
        'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
    ]);


    $validated['password'] = bcrypt($validated['password']);

    $currentTraineesCount = Cache::get('total_trainees', 0);
    $newTraineesCount = $currentTraineesCount + 1;
    Cache::forever('total_trainees', $newTraineesCount);


    $trainee = new Trainee($validated);
    $trainee->save();


    Mail::to($trainee->email)->send(new WelcomeMail($trainee));

    DB::table('notifications')->insert([
        'sender_id' => $trainee->id,
        'sender_type' => 'Trainee',
        'receiver_id' => $trainee->id,
        'receiver_type' => 'Trainee',
        'message' => 'Welcome! You have successfully registered. You can now navigate and choose your suitable package.',
        'status' => 'unread',
        'created_at' => now(),
        'updated_at' => now(),
    ]);


    $adminIds = DB::table('admins')->pluck('id');
    foreach ($adminIds as $adminId) {
        DB::table('notifications')->insert([
            'sender_id' => $trainee->id,
            'sender_type' => 'Trainee',
            'receiver_id' => $adminId,
            'receiver_type' => 'Admin',
            'message' => 'A new trainee has just registered.',
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    return redirect('/')->with('success', 'Registration successful! A welcome email has been sent.');
}



    public function updateTraineeView(Request $request, $id)
    {

        try {

            $trainee = Trainee::findOrFail($id);
            $oldMedicalHistory = $trainee->medical_history;
            $oldGoal = $trainee->goal;


            $trainee->update($request->only([
                'first_name',
                'last_name',
                'email',
                'phone',
                'address',
                'age',
                'height',
                'weight',
                'gender',
                'medical_history',
                'goal'
            ]));


            $notificationMessage = null;

            if ($oldMedicalHistory !== $trainee->medical_history) {
                $notificationMessage = 'The trainee has updated their medical history.whose ID is {$trainee->id} and user name is {$trainee->user_name} ';
            }

            if ($oldGoal !== $trainee->goal) {
                $notificationMessage = $notificationMessage
                    ? $notificationMessage . ' Additionally, the goal has been updated.'
                    : 'The trainee has updated their goal.';
            }


            if ($notificationMessage) {

                $package = DB::table('packages')->where('id', $trainee->package_id)->first();
                $coachId = $package->coach_id ?? null;

                if ($coachId) {
                    DB::table('notifications')->insert([
                        'sender_id' => $trainee->id,
                        'sender_type' => 'Trainee',
                        'receiver_id' => $coachId,
                        'receiver_type' => 'Coach',
                        'message' => $notificationMessage,
                        'status' => 'unread',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            return back()->with('success', 'Trainee information updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update trainee information: ' . $e->getMessage());
        }
    }


    public function updatePassword(Request $request, $id)
{
    try {

        $request->validate([
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
                'confirmed',
            ],
        ], [

            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);


        $trainee = Trainee::findOrFail($id);


        $trainee->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return back()->with('success', 'Password updated successfully.');

    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update password: ' . $e->getMessage());
    }
}

    public function editTraineeView($id)
    {
        try {
            $trainee = Trainee::with(['package.coach'])->findOrFail($id);

            $packageName = $trainee->package ? $trainee->package->name : 'No Package Assigned';
            $coachName = $trainee->package && $trainee->package->coach
                ? $trainee->package->coach->first_name . ' ' . $trainee->package->coach->last_name
                : 'No Coach Assigned';



            return view('editTraineePersonalInfoTraineeView', compact('trainee','packageName','coachName'));

        } catch (\Exception $e) {

            return back()->with('error', 'Failed to retrieve trainee data: ' . $e->getMessage());
        }
    }







    public function homePage()
    {

        $userId = session('user_id');



        $trainee = DB::table('trainees')->where('id', $userId)->first();

        if (!$trainee) {
            return redirect('/login')->with('error', 'Trainee not found.');
        }

        $coachPhone = null;
        if ($trainee->package_id) {
            $coach = DB::table('packages')
                ->join('coaches', 'packages.coach_id', '=', 'coaches.id')
                ->where('packages.id', $trainee->package_id)
                ->select('coaches.phone')
                ->first();

            if ($coach) {
                $coachPhone = $coach->phone;
            }
        }
        $packages = package::all();

        return view('traineeHomePage', compact('trainee', 'coachPhone','packages'));
    }


    public function subscribe($packageId)
    {

        $package = Package::find($packageId);
        if (!$package) {
            return redirect()->back()->with('error', 'Package not found.');
        }
        $userId = session('user_id');
        $trainee = DB::table('trainees')->where('id', $userId)->first();
        return view('payment', [
            'package' => $package,
            'trainee' => $trainee,
        ]);
    }


//     // public function unsubscribe($packageId)
// {
//     $userId = session('user_id');
//     $trainee = DB::table('trainees')->where('id', $userId)->first();

//     // تحقق من إذا كان المتدرب مشترك في هذا الباقة
//     if (!$trainee || $trainee->package_id != $packageId) {
//         return redirect()->back()->with('error', 'You are not subscribed to this package.');
//     }

//     // إلغاء الاشتراك
//     DB::table('trainees')->where('id', $userId)->update(['package_id' => null]);

//     // تحديث عدد المتدربين المشتركين في الكاش
//     $currentTraineesCountwithsubscription = Cache::get('trainees_with_subscriptions', 0);
//     $newTraineesCount = $currentTraineesCountwithsubscription - 1;
//     Cache::forever('trainees_with_subscriptions', $newTraineesCount);

//     // إرسال إشعار للمتدرب
//     DB::table('notifications')->insert([
//         'sender_id' => $trainee->id,
//         'sender_type' => 'Trainee',
//         'receiver_id' => $trainee->id,
//         'receiver_type' => 'Trainee',
//         'message' => 'You have successfully unsubscribed from the package.',
//         'status' => 'unread',
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//     // إرسال إشعار لجميع المدراء
//     $adminIds = DB::table('admins')->pluck('id');
//     foreach ($adminIds as $adminId) {
//         DB::table('notifications')->insert([
//             'sender_id' => $trainee->id,
//             'sender_type' => 'Trainee',
//             'receiver_id' => $adminId,
//             'receiver_type' => 'Admin',
//             'message' => 'A trainee has unsubscribed from a package.',
//             'status' => 'unread',
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }


//     $coachId = $trainee->package_id ? Package::find($trainee->package_id)->coach_id : null;
//     if ($coachId) {
//         DB::table('notifications')->insert([
//             'sender_id' => $trainee->id,
//             'sender_type' => 'Trainee',
//             'receiver_id' => $coachId,
//             'receiver_type' => 'Coach',
//             'message' => 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: ' . $trainee->first_name . ' ' . $trainee->last_name . ' (ID: ' . $trainee->id . ')',
//             'status' => 'unread',
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }


//     Mail::to($trainee->email)->send(new cancelSubscribtion($trainee));


//     return redirect()->route('traineeHomePage')->with('success', 'You have successfully unsubscribed from the package.');
// }
public function unsubscribe($packageId)
{
    $userId = session('user_id');
    $trainee = DB::table('trainees')->where('id', $userId)->first();

    // تحقق من إذا كان المتدرب مشترك في هذا الباقة
    if (!$trainee || $trainee->package_id != $packageId) {
        return redirect()->back()->with('error', 'You are not subscribed to this package.');
    }

    // إلغاء الاشتراك
    DB::table('trainees')->where('id', $userId)->update(['package_id' => null]);

    // حذف الخطة المرتبطة بالمتدرب من جدول 'plans'
    $plan = DB::table('plans')->where('trainee_id', $userId)->first();
    if ($plan) {
        DB::table('plans')->where('trainee_id', $userId)->delete();
    }

    // تحديث عدد المتدربين المشتركين في الكاش
    $currentTraineesCountwithsubscription = Cache::get('trainees_with_subscriptions', 0);
    $newTraineesCount = $currentTraineesCountwithsubscription - 1;
    Cache::forever('trainees_with_subscriptions', $newTraineesCount);

    // إرسال إشعار للمتدرب
    DB::table('notifications')->insert([
        'sender_id' => $trainee->id,
        'sender_type' => 'Trainee',
        'receiver_id' => $trainee->id,
        'receiver_type' => 'Trainee',
        'message' => 'You have successfully unsubscribed from the package.',
        'status' => 'unread',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // إرسال إشعار لجميع المدراء
    $adminIds = DB::table('admins')->pluck('id');
    foreach ($adminIds as $adminId) {
        DB::table('notifications')->insert([
            'sender_id' => $trainee->id,
            'sender_type' => 'Trainee',
            'receiver_id' => $adminId,
            'receiver_type' => 'Admin',
            'message' => 'A trainee has unsubscribed from a package.',
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // إرسال إشعار للمدرب إذا كان موجود
    $coachId = $trainee->package_id ? Package::find($trainee->package_id)->coach_id : null;
    if ($coachId) {
        DB::table('notifications')->insert([
            'sender_id' => $trainee->id,
            'sender_type' => 'Trainee',
            'receiver_id' => $coachId,
            'receiver_type' => 'Coach',
            'message' => 'A trainee has unsubscribed from your package. Please update the plan accordingly. Trainee Name: ' . $trainee->first_name . ' ' . $trainee->last_name . ' (ID: ' . $trainee->id . ')',
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // إرسال بريد إلكتروني للمتدرب
    Mail::to($trainee->email)->send(new cancelSubscribtion($trainee));

    // إعادة التوجيه مع رسالة النجاح
    return redirect()->route('traineeHomePage')->with('success', 'You have successfully unsubscribed from the package.');
}

    public function edit($id)
    {

        $trainee = DB::table('trainee_package_plan_view')->where('trainee_id', $id)->first();
        $packages = DB::table('packages')->where('status', 'available')->get();
        return view('editTraineeAdminView', compact('trainee', 'packages'));
    }

    public function updateTrainee(Request $request, $id)
    {
        // الادمن هنا بيقدر انه يغير الباكدج بتاعت ال trainee
        $trainee = Trainee::findOrFail($id);
       if (empty($request->package_name)) {
            $trainee->package_id = null;
        } else {

            $package = Package::where('name', $request->package_name)->first();
          if ($package) {
                $trainee->package_id = $package->id;
            } else {

                return redirect()->back()->with('error', 'Package not found.');
            }
        }
        $trainee->save();

        return redirect()->route('trainees.admin', $id)->with('success', 'Trainee updated successfully');
    }


    public function blockTrainee($id)
    {


        $trainee = Trainee::findOrFail($id);
        $trainee->status = 'blocked';
        $trainee->save();


        return redirect()->route('trainees.admin')
                         ->with('success', 'Trainee has been blocked successfully.');

}

public function unblockTrainee($id)
    {
        $trainee = Trainee::findOrFail($id);
        $trainee->status = 'active';
        $trainee->save();

        return redirect()->route('trainees.admin')
                         ->with('success', 'Trainee has been un blocked successfully.');
    }


    public function indexHelp()
    {

        return view('help');
    }


}
