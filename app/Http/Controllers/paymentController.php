<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Package;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\subscribtion;

class paymentController extends Controller
{

    public function store(Request $request)
{

    $validated = $request->validate([
        'trainee_id' => 'required|exists:trainees,id',
        'amount' => 'required|numeric',
        'method' => 'required|in:paypal,credit_card',
        'payNumber' => 'required|string|size:16',
        'expiry_date' => 'required|date_format:Y-m-d',
        'cvv' => 'required|string|size:3',
    ]);


    $method = $request->input('method');
    if ($method == 'paypal') {
        $getwayID = 'paypal_gateway_id';
        $getwayName = 'PayPal';
    } else {
        $getwayID = 'creditcard_gateway_id';
        $getwayName = 'Credit Card';
    }


    $encryptedPayNumber = bcrypt($request->input('payNumber'));

    $payment = new Payment();
    $payment->trainee_id = $request->input('trainee_id');
    $payment->amount = $request->input('amount');
    $payment->method = $method;
    $payment->getwayID = $getwayID;
    $payment->getwayName = $getwayName;
    $payment->payNumber = $encryptedPayNumber;
    $payment->payment_date = now();
    $payment->status = 'completed';
    $payment->save();


    $trainee = Trainee::find($request->input('trainee_id'));
    if (!$trainee) {
        return redirect()->back()->with('error', 'Trainee not found.');
    }


    $package = Package::find($request->input('package_id'));
    if (!$package) {
        return redirect()->back()->with('error', 'Package not found.');
    }


    if ($payment->status !== 'completed') {
        return redirect()->route('paymentPage')->with('error', 'Payment failed. Please try again.');
    }


    $trainee->package_id = $package->id;
    $trainee->save();


    $currentRevenue = Cache::get('total_revenue', 0);
    $newRevenue = $currentRevenue + $package->price;
    Cache::forever('total_revenue', $newRevenue);


    DB::table('notifications')->insert([
        'sender_id' => $trainee->id,
        'sender_type' => 'Trainee',
        'receiver_id' => $trainee->id,
        'receiver_type' => 'Trainee',
        'message' => 'You have successfully subscribed to the package.',
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
            'message' => 'A new trainee has just subscribed to a package with id ',
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    $coachId = $package->coach_id;
    if ($coachId) {
        DB::table('notifications')->insert([
            'sender_id' => $trainee->id,
            'sender_type' => 'Trainee',
            'receiver_id' => $coachId,
            'receiver_type' => 'Coach',
           'message' => 'A new trainee has subscribed to your package with ID ' . $trainee->id . ' you have to assign a perfect plan to him.',
           'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    Mail::to($trainee->email)->send(new subscribtion($trainee));

    return redirect()->route('traineeHomePage')->with('success', 'Subscription completed successfully!');
}


    public function payments(){
        $payments = Payment::all();
        return view('paymentViewAdminView', compact('payments'));
    }
}

