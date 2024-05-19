<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticularController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UserBranchController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserRegionController;
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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/filter-data', [PageController::class, 'filterData'])->name('filter.data');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [PageController::class, 'loadDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['as'=>'user.','prefix'=>'user','middleware'=>'auth'], function (){
    // Route::resource('/profile', ProfileController::class);
    Route::resource('/profile', UserProfileController::class);
    Route::resource('/region', UserRegionController::class);
    Route::resource('/branch', UserBranchController::class);
    Route::resource('/particular', ParticularController::class);
    Route::resource('/staff', StaffController::class);
    Route::resource('/data', DataController::class);
    Route::get('/performanceView', [DataController::class, 'performanceView'])->name('performanceView');
    Route::get('/allRegionPerformanceView', [DataController::class, 'regionPerformanceView'])->name('regionPerformanceView');
    Route::get('/allBranchPerformanceView', [DataController::class, 'branchPerformanceView'])->name('branchPerformanceView');
    Route::get('/otrPerformanceView', [DataController::class, 'otrPerformanceView'])->name('otrPerformanceView');
    Route::post('/data/upload-data', [DataController::class, 'uploadData'])->name('uploadData');
    Route::get('/data-filter', [DataController::class, 'dataFilter'])->name('data.filter');
    
    Route::get('/performanceView/data-filter', [DataController::class, 'performanceDataFilter'])->name('performanceDataFilter');
    Route::get('/allBranchPerformanceView/data-filter', [DataController::class, 'branchPerformanceDataFilter'])->name('branchPerformanceDataFilter');
    Route::get('/allRegionPerformanceView/data-filter', [DataController::class, 'regionPerformanceDataFilter'])->name('regionPerformanceDataFilter');
    Route::get('/otrPerformanceView/data-filter', [DataController::class, 'otrPerformanceDataFilter'])->name('otrPerformanceDataFilter');
    Route::resource('/target', TargetController::class);
    Route::resource('/target', TargetController::class);
    Route::get('branch/{branch}/staff', [TargetController::class, 'getStaff']);
    Route::post('/target-update', [TargetController::class, 'targetUpdate'])->name('targetUpdate');
    Route::get('/destroyTarget/{id}', [TargetController::class, 'destroyTarget'])->name('destroyTarget');
    Route::resource('/achievement', AchievementController::class);
    Route::get('/destroyAchievement/{id}', [AchievementController::class, 'destroyAchievement'])->name('destroyAchievement');
    Route::post('/updatePassword', [UserProfileController::class, 'updatePassword'])->name('profile.updatePassword');

});


Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');
Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>'admin'], function (){

    Route::get('/dashboard', [AdminPageController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Route::resource('/user', UserController::class);
    // Route::resource('/category', AdminCategoryController::class);
    // Route::post('/userApproved/{id}', [UserController::class, 'userApproved'])->name('approved');
    // Route::post('/userUnapproved/{id}', [UserController::class, 'UserUnApproved'])->name('unapproved');
    Route::resource('/region', RegionController::class);
    Route::resource('/branch', BranchController::class);
    Route::resource('/manager', ManagerController::class);
    Route::resource('/profile', AdminProfileController::class);
    Route::post('/updatePassword', [AdminProfileController::class, 'updatePassword'])->name('profile.updatePassword');

   
});

require __DIR__.'/auth.php';
