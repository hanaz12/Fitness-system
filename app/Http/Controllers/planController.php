<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class planController extends Controller
{
    public function showAddPlanForm($traineeId)
{
    $trainee = Trainee::findOrFail($traineeId);  // جلب بيانات الترينى باستخدام الـ ID
    return view('addPlanCoachView', compact('trainee'));

}

        public function storePlan(Request $request, $traineeId)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'plan_name' => 'required|string|max:255',
            'description' => 'required|string',
            'coach_id' => 'required|exists:coaches,id',
            'trainee_id'=>'required|exists:trainees,id'
        ]);

        // إضافة trainee_id إلى الـ validated data
        $validated['trainee_id'] = $traineeId;  // إضافة الـ trainee_id للـ plan

        // إنشاء الـ Plan وحفظه
        $plan = new Plan($validated);
        $plan->save();  // سيتم حفظ الـ trainee_id في العمود الخاص به

        // تحديث الـ plan_id للـ Trainee
        $trainee = Trainee::findOrFail($traineeId);
        $trainee->plan_id = $plan->id; // تحديث الـ plan_id للـ Trainee
        $trainee->save();

        // إرسال إشعار للـ Trainee
        $this->sendPlanNotification($trainee, $plan);

        // إعادة التوجيه مع رسالة النجاح
        return redirect()->route('manage.trainee', $traineeId)
                         ->with('success', 'Plan has been assigned successfully!');
    }



    // إرسال إشعار للـ Trainee
    private function sendPlanNotification(Trainee $trainee, Plan $plan)
    {
        $notificationMessage = 'Hello ' . $trainee->first_name . ', you have been assigned a new plan: ' . $plan->plan_name . '.';

        // إدراج الإشعار في جدول notifications
        DB::table('notifications')->insert([
            'sender_id' => null,  // افترض أن المستخدم الحالي هو الذي أرسل الإشعار
            'sender_type' => null,  // أو أي نوع آخر مثل 'Admin'
            'receiver_id' => $trainee->id,
            'receiver_type' => 'Trainee',
            'message' => $notificationMessage,
            'status' => 'unread', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updatePlan(Request $request, $traineeId, $planId)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'plan_name' => 'required|string|max:255',
            'description' => 'required|string',
           'coach_id' => 'required|exists:coaches,id',
            'trainee_id'=>'required|exists:trainees,id'
        ]);


        // العثور على الـ plan المحدد
        $plan = Plan::findOrFail($planId);
        $plan->update($validated);



        // إرسال إشعار للـ Trainee بعد التحديث
        $trainee = Trainee::findOrFail($traineeId);

        $this->sendPlanUpdateNotification($trainee, $plan);

        // إعادة التوجيه مع رسالة النجاح
        return redirect()->route('manage.trainee', $traineeId)
                         ->with('success', 'Plan updated successfully!');
    }
    private function sendPlanUpdateNotification(Trainee $trainee, Plan $plan)
{


    $notificationMessage = 'Hello ' . $trainee->first_name . ', your plan has been updated: ' . $plan->plan_name . '.';

    // إدراج الإشعار في جدول notifications
    DB::table('notifications')->insert([
        'sender_id' => null,  // يمكن أن يكون هذا هو المستخدم الذي أرسل الإشعار
        'sender_type' => null,  // يمكن أن يكون Admin أو Coach أو أي نوع آخر
        'receiver_id' => $trainee->id,
        'receiver_type' => 'Trainee',
        'message' => $notificationMessage,
        'status' => 'unread',  // حالة الإشعار (غير مقروء)
        'created_at' => now(),
        'updated_at' => now(),
    ]);

}


    public function editPlanForm($traineeId, $planId)
{
    // جلب البيانات من قاعدة البيانات
    $plan = Plan::findOrFail($planId);
    $trainee = Trainee::findOrFail($traineeId);

    // التأكد من أن المتغيرات يتم تمريرها بشكل صحيح إلى الـ view
    return view('editPlanCoachView', compact('plan', 'trainee'));
}
public function deletePlan($traineeId, $planId)
    {
        $plan = Plan::findOrFail($planId);

        $trainee = Trainee::findOrFail($traineeId);
        // $trainee->plan_id = null;
        // $trainee->save();

        $plan->delete();

        return redirect()->route('manage.trainee', $traineeId)
                         ->with('success', 'Plan deleted successfully!');
    }


    public function index()
    {

        $plans = Plan::all();
        return view('plansViewOfAdminHomePage', compact('plans'));
    }
}
