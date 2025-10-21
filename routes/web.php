<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\MediaItemController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\PledgeController;
use App\Http\Controllers\DonationController;


// 🌍 Homepage route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ℹ️ About page route
Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/news', function () {
    return view('news');
})->name('news');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::view('/donate', 'donate')->name('donate');
Route::view('/events', 'events')->name('events');
Route::view('/get-involved', 'get-involved')->name('get-involved');

Route::get('/campaigns', [PledgeController::class, 'campaigns'])->name('campaigns');


Route::prefix('media')->group(function () {
    Route::get('/photos', [MediaController::class, 'photos'])->name('media.photos');
    Route::get('/videos', [MediaController::class, 'videos'])->name('media.videos');
    Route::get('/publications', [MediaController::class, 'publications'])->name('media.publications');
    Route::get('/reports', [MediaController::class, 'reports'])->name('media.reports');

    });
// Public Media Routes
Route::get('/media', [App\Http\Controllers\MediaController::class, 'index'])->name('media.index');
Route::get('/media/{mediaItem:slug}', [App\Http\Controllers\MediaController::class, 'show'])->name('media.show');
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');



Route::get('/pledges', [PledgeController::class, 'index'])->name('pledges.index');
Route::post('/pledges', [PledgeController::class, 'store'])->name('pledges.store');






Route::get('/donate', [DonationController::class, 'index'])->name('donate');
Route::post('/donate/stkpush', [DonationController::class, 'stkPush'])->name('donate.stkpush');
Route::post('/mpesa/callback', [DonationController::class, 'callback']);




Route::get('/membership/register', [MemberController::class, 'create'])->name('membership.create');
Route::post('/membership/send-otp', [MemberController::class, 'sendOtp'])->name('membership.sendOtp');
Route::post('/membership/verify-otp', [MemberController::class, 'verifyOtp'])->name('membership.verifyOtp');
Route::post('/membership/resend-otp', [MemberController::class, 'resendOtp'])->name('membership.resendOtp');
Route::get('/membership/thank-you', [MemberController::class, 'thankYou'])->name('membership.thankyou');




// ==========================
// 🔐 Admin Authentication
// ==========================
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ==========================
// 🧑‍💻 Admin Protected Routes
// ==========================
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    // 📊 Dashboard & Analytics
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    

    // 🖼️ Media Management
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [MediaItemController::class, 'index'])->name('index');
        Route::get('/create', [MediaItemController::class, 'create'])->name('create');
        Route::post('/store', [MediaItemController::class, 'store'])->name('store');
        Route::get('/{mediaItem}/edit', [MediaItemController::class, 'edit'])->name('edit');
        Route::put('/{mediaItem}', [MediaItemController::class, 'update'])->name('update');
        Route::delete('/{mediaItem}', [MediaItemController::class, 'destroy'])->name('destroy');
    });

    // 🧱 Projects Management
    Route::resource('projects', ProjectController::class);
    Route::resource('team', App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class)->names('news');


});


