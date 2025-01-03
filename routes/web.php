<?php

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckSession;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\planController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\packageController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\traineeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminModeratorController;

// public for all users
Route::get('/', function() {
    return view('homePage');
});
Route::post('/loginn', [AuthController::class, 'login']);  // هنا اللوجيك بتاع ال Login page
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/loginpage', [AuthController::class, 'showLoginForm'])->name('logined');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::delete('/notifications/{id}', [NotificationController::class, 'clear'])->name('notifications.delete');
Route::delete('/notifications/clear/{id}', [NotificationController::class, 'clear'])->name('notifications.clear');











 Route::middleware(CheckSession::class)->group(function () {
Route::get('/adminHomePage', [AdminController::class, 'homePage'])->name('adminHomePage');
Route::get('/traineeHomePage', [traineeController::class, 'homePage'])->name('traineeHomePage');
Route::get('/adminModeratorHomePage', [AdminController::class, 'index'])->name('adminModeratorHomePage');
Route::get('/coachHomePage', [CoachController::class, 'homepage'])->name('coachHomePage');

 });

















// admin Moderator Home page
Route::get('/update-personal-infoadminmoderator/{user_id}', [AdminModeratorController::class, 'editAdminView'])->name('updatePersonalInfoAdminModerator');
Route::post('/adminmoderator/{id}/update-password', [AdminModeratorController::class, 'updatePassword'])->name('adminModerator.updatePassword');
Route::post('/adminmoderator/profile/update/{id}', [AdminModeratorController::class, 'updateProfile'])->name('adminModerator.profile.update');

Route::post('/adminmoderator/block/{id}', [AdminController::class, 'blockAdmin'])->name('admin.block');
Route::post('/adminmoderator/unblock/{id}', [AdminController::class, 'unblockAdmin'])->name('admin.unblock');
Route::get('/adminmoderator/new', [AdminModeratorController::class, 'addAdmin'])->name('admin.add');
Route::get('/adminmoderator/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/adminmoderator/store', [AdminController::class, 'store'])->name('admin.store');
Route::post('/adminmoderator/update/{id}', [AdminController::class, 'update'])->name('admin.update');


//================================================================//
//trainee Home page

Route::post('/trainee/{id}/update-password', [traineeController::class, 'updatePassword'])->name('trainee.updatePassword');
Route::post('/trainee/update2/{id}', [traineeController::class, 'updateTraineeView'])->name('trainee.upadateInfo');
Route::get('/update-personal-infoTrainee/{user_id}', [traineeController::class, 'editTraineeView'])->name('updatePersonalInfoTraineeView');
Route::get('/subscribe/{packageId}', [traineeController::class, 'subscribe'])->name('subscribe');
Route::post('/unsubscribe/{packageId}', [traineeController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/payment/process', [paymentController::class, 'store'])->name('payment.store');
Route::get('/help', [traineeController::class, 'indexHelp'])->name('help');
Route::get('/payment', function() {
    return view('payment');
});
Route::get('/signup', [traineeController::class, 'create'])->name('signup.create');
Route::post('/trainee', [traineeController::class, 'store'])->name('trainee.store');
// Route::get('/traineePlans', [traineeController::class, 'plan'])->name('plans.tainee');
Route::get('/traineePlans/{id}', [traineeController::class, 'plan'])->name('plans.tainee');


//================================================================//
//  coach home page
Route::get('coach/trainee/{id}/add-plan', [planController::class, 'showAddPlanForm'])->name('coach.addPlan');
Route::post('coach/trainee/{id}/add-plan', [planController::class, 'storePlan'])->name('Plan.store');
Route::get('/trainees/{traineeId}/plans/{planId}/edit', [planController::class, 'editPlanForm'])->name('plans.edit');
Route::post('/trainees/{traineeId}/plans/{planId}', [planController::class, 'updatePlan'])->name('plans.update');
Route::get('/trainees/{traineeId}/plans/{planId}', [planController::class, 'deletePlan'])->name('plans.delete');
Route::post('/coach/{id}/update-password', [CoachController::class, 'updatePassword'])->name('coach.updatePassword');
Route::get('/help', [CoachController::class, 'indexHelp'])->name('help');
Route::get('/update-personal-infoCoach/{user_id}', [CoachController::class, 'editCoachView'])->name('updatePersonalInfoCoachView');
Route::get('/trainee/manage/{id}', [CoachController::class, 'manageTrainee'])->name('manage.trainee');
Route::post('/coach/profile/update/{id}', [CoachController::class, 'updateProfile'])->name('coach.profile.update');
// Route::post('/coach/update/{id}', [CoachController::class, 'update'])->name('coach.update');

//================================================================//
//admin home page
Route::get('/update-personal-info/{user_id}', [AdminController::class, 'editAdminView'])->name('updatePersonalInfo');
Route::post('/admin/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
Route::post('/admin/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('admin/plans', [PlanController::class, 'index'])->name('plans.admin');
Route::get('admin/payments', [PaymentController::class, 'payments'])->name('payments.admin');
Route::get('admin/trainees', [AdminController::class, 'trainees'])->name('trainees.admin');
Route::get('admin/packages', [PackageController::class, 'index'])->name('packages.admin');
Route::get('admin/coaches', [CoachController::class, 'index'])->name('coaches.admin');
Route::get('admin/coache/addnew', [CoachController::class, 'showAddForm'])->name('coach.add');
Route::post('admin/coach/store', [CoachController::class, 'store'])->name('coach.store');
Route::get('admin/package/addnew', [packageController::class, 'showAddForm'])->name('package.add');
Route::post('admin/package/store', [PackageController::class, 'store'])->name('package.store');
Route::get('admin/package/edit/{id}', [PackageController::class, 'showEditForm'])->name('package.edit');
Route::post('admin/package/update/{id}', [PackageController::class, 'update'])->name('package.update');
Route::post('/admin/block/{id}', [CoachController::class, 'blockCoach'])->name('coach.block');
Route::post('/admin/unblock/{id}', [CoachController::class, 'unblockCoach'])->name('coach.unblock');
Route::get('/admin/edit/{id}', [CoachController::class, 'edit'])->name('coach.edit');
Route::post('/admin/update/{id}', [CoachController::class, 'update'])->name('coach.update');
Route::get('/admin/editTrainee/{id}', [traineeController::class, 'edit'])->name('trainee.edit');
Route::post('/admin/updateTrainee/{id}', [traineeController::class, 'updateTrainee'])->name('trainee.update');
Route::post('/admin/blockTrainee/{id}', [TraineeController::class, 'blockTrainee'])->name('trainee.block');
Route::post('/admin/unblockTrainee/{id}', [TraineeController::class, 'unblockTrainee'])->name('trainee.unblock');
