<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OurServiceSliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisaTrakController;
use Illuminate\Support\Facades\Route;

/* ============================ Forntend url ======================= */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [VisaTrakController::class, 'visa_track'])->name('visa-find');
Route::get('/our-service', [OurServiceSliderController::class, 'index'])->name('our-service');
Route::get('/contact-us', [HomeController::class, 'Contact'])->name('contact-us');


Route::get('/dashboard', [UserController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


/* =============================== Admin End ========================== */
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/admin/siteinfo', [AdminController::class, 'siteInfo'])->name('siteinfo');


    // Visa Tracking
    Route::get('/admin/visa-status', [VisaTrakController::class, 'index'])->name('admin.visa');
    Route::get('/admin/create-visatrack', [VisaTrakController::class, 'create'])->name('create-visa');
    Route::post('/admin/store-visa', [VisaTrakController::class, 'store'])->name('visa-store');
    Route::get('/admin/edit-visa/{id}', [VisaTrakController::class, 'edit'])->name('visa-edit');
    Route::put('/admin/update-visa/{id}', [VisaTrakController::class, 'update'])->name('visa-update');
    Route::delete('/admin/delete-visa/{id}', [VisaTrakController::class, 'destroy'])->name('visa-delete');
    // POST for Visa Tracking AJAX JSON
    Route::post('/admin/visa-status', [VisaTrakController::class, 'indexAjax'])->name('visa-status.index');

    // Testimonial Urls
    Route::get('/admin/create-testimonial', [HomeController::class, 'createTestimonials'])->name('create-testi');
    Route::post('/admin/store-testimonial', [HomeController::class, 'storeTestimonial'])->name('store-testi');


    // Airlines Urls
    Route::get('/admin/all-airlines', [HomeController::class, 'showAirlines'])->name('showAirlines');
    Route::get('/admin/create-airline', [HomeController::class, 'CreateAirline'])->name('create-airline');
    Route::post('/admin/create-airline', [HomeController::class, 'storeAirline'])->name('store-airline');
    Route::get('/admin/edit-airline/{id}', [HomeController::class, 'editAirline'])->name('edit-airline');
    Route::put('/admin/update-airline/{id}', [HomeController::class, 'updateAirline'])->name('update-airline');

    

    // Route::prefix('visa-status')->name('visa-status.')->group(function () {
    //     Route::post('/', [VisaTrakController::class, 'index'])->name('index');
    // });

    // Our service List Urls
    Route::get('/admin/all-slider', [OurServiceSliderController::class, 'index'])->name('all-slider');
    Route::get('/admin/services-create', [OurServiceSliderController::class, 'create'])->name('service-create');
    Route::post('/admin/services-store', [OurServiceSliderController::class, 'store'])->name('services-store');
    Route::put('/admin/services-update/{id}', [OurServiceSliderController::class, 'update'])->name('services-update');
    Route::get('/admin/services-edit/{id}', [OurServiceSliderController::class, 'edit'])->name('services-edit');
    Route::delete('/admin/our-services/{id}', [OurServiceSliderController::class, 'destroy'])->name('services-destroy');
    Route::patch('/admin/our-services/{id}/toggle', [OurServiceSliderController::class, 'toggle'])->name('services-toggle');

    // Site Settings Urls
    Route::get('/admin/settings', [SiteSettingsController::class, 'edit'])->name('settings-edit');
    Route::put('/admin/settings/{id}', [SiteSettingsController::class, 'update'])->name('settings-update');

    // Bank Details Urls
    Route::get('/admin/all-bank',[BankController::class,'index'])->name('all-bank');
    Route::get('/admin/bank-create',[BankController::class,'create'])->name('bank-create');
    Route::post('/admin/bank-store',[BankController::class,'store'])->name('bank.store');
    Route::get('/admin/bank-edit/{id}',[BankController::class,'edit'])->name('bank.edit');
    Route::put('/admin/bank-update/{id}',[BankController::class,'update'])->name('bank.update');
    Route::delete('/admin/bank-delete/{id}', [BankController::class, 'destroy'])->name('bank-destroy');


});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
