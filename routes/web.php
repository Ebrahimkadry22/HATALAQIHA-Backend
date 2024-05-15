<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DasboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobController as AdminJobController;
use App\Http\Controllers\admin\TypeJobController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ApplyJob;
use App\Http\Controllers\FindJobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SaveJobController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// pubilc
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view/job-Detail/{idjob}',[JobController::class,'viewjob'])->name('view.job');
Route::get('/find-jobs',[FindJobController::class,'index'])->name('find.jobs');
Route::post('/apply-job',[ApplyJob::class,'applyJob'])->name('apply.job');
Route::post('/save-job',[SaveJobController::class,'saveJob'])->name('save.job');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/registration', [AccountController::class, 'registration'])->name('registration');
    Route::post('/account/registration', [AccountController::class, 'processRegistration'])->name('account.registration');
    Route::get('/accountlogin', [AccountController::class, 'login'])->name('accountlogin');
    Route::post('/authenticate/login', [AccountController::class, 'authenticate'])->name('account.authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::put('account/update', [AccountController::class, 'updateProfile'])->name('account.update');
    Route::post('/update-password',[AccountController::class,'updatePassword'])->name("update.password");
    // Route::put('account/updatepic',[AccountController::class,'updateProfileImage'])->name('account.updatePic');
    Route::get('/createpost', [JobController::class, 'createJob'])->name('create.post');
    Route::post('/storepost', [JobController::class, 'storeJob'])->name('store.post');
    Route::get('/myjobs', [JobController::class, 'myJobs'])->name('account.myjobs');
    Route::get('/edit/job/{idjob}', [JobController::class, 'editJob'])->name('edit.job');
    Route::post('/update/job/{idjob}', [JobController::class, 'updateJob'])->name('update.job');
    Route::post('/delete/job', [JobController::class, 'deletejob'])->name('delete.job');
    Route::get('/my-job-application',[ApplyJob::class,'myjobApplication'])->name('myjobApplication');
    Route::get('/my-saved-jobs',[SaveJobController::class,'mySavedJobs'])->name('mySavedjobs');
    Route::post('/remove-saved-job',[SaveJobController::class,'removeJobs'])->name('remove.jobsaved');
    Route::post('/remove-job-application',[ApplyJob::class,'removeJobs'])->name('remove.jobApply');
});

Route::group(['prefix' => 'admin/','middleware' => 'checkRole'], function () {
    // users
    Route::get('dasboard',[DasboardController::class,'index'])->name('admin.dasboard');
    Route::get('users',[UserController::class,'index'])->name('admin.users');
    Route::get('edit/user/{id}',[UserController::class,'edituser'])->name('admin.edit.users');
    Route::put('update/user/{id}',[UserController::class,'updateUser'])->name('admin.update.users');
    Route::delete('delete/user',[UserController::class,'destroy'])->name('admin.delete.users');
    // jobs
    Route::get('jobs',[AdminJobController::class,'index'])->name('admin.jobs');
    Route::get('edit/job/{id}',[AdminJobController::class,'editJob'])->name('admin.edit.job');
    Route::put('/update/job/{id}', [AdminJobController::class, 'updateJob'])->name('admin.update.job');
    Route::delete('delete/job',[AdminJobController::class,'destroy'])->name('admin.delete.job');
    // category
    Route::get('category',[CategoryController::class,'index'])->name('admin.category');
    Route::get('add/category',[CategoryController::class,'createCategory'])->name('admin.create.category');
    Route::post('add/category',[CategoryController::class,'addCategory'])->name('admin.add.category');
    Route::get('edit/category/{id}',[CategoryController::class,'editCategory'])->name('admin.edit.category');
    Route::put('update/category/{id}',[CategoryController::class,'updateCategory'])->name('admin.update.category');
    Route::delete('delete/category',[CategoryController::class,'destroy'])->name('admin.delete.category');
    // TypeJob
    Route::get('jobType',[TypeJobController::class,'index'])->name('admin.jobType');
    Route::get('add/Typejob',[TypeJobController::class,'createTypeJob'])->name('admin.create.TypeJob');
    Route::post('add/Typejob',[TypeJobController::class,'addTypejob'])->name('admin.add.TypeJob');
    Route::get('edit/typejob/{id}',[TypeJobController::class,'editTypeJob'])->name('admin.edit.typeJob');
    Route::put('update/typejob/{id}',[TypeJobController::class,'updateTypeJob'])->name('admin.update.typejob');
    Route::delete('delete/typejob',[TypeJobController::class,'destroy'])->name('admin.delete.typejob');
    // Job Application
    Route::get('jobApplication',[JobApplicationController::class,'index'])->name('admin.jobApplication');

});
