<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageBlogController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ManagePartnerController;
use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\ManageReportController;
use App\Http\Controllers\Admin\ManageSettingController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageVoucherController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

Route::get('/',[LandingPageController::class, 'index']) -> name('home');
Route::get('/sewa-villa', [LandingPageController::class, 'rent_villa']) -> name('sewa-villa');
Route::get('/sewa-villa/{id}', [LandingPageController::class, 'detail_rent_villa']) -> name('detail-rent-villa');
Route::get('/tersimpan', [LandingPageController::class, 'saved']) -> name('tersimpan');
Route::get('/trip', [LandingPageController::class, 'trip']) -> name('trip');
Route::get('/trip/{id}', [LandingPageController::class, 'detail_trip']) -> name('detail-trip');
Route::get('/blog', [LandingPageController::class, 'blog']) -> name('blog');
Route::get('/blog/{slug}', [LandingPageController::class, 'detailBlog']) -> name('detail-blog');
Route::get('/kontak', [LandingPageController::class, 'contact']) -> name('kontak');
Route::get('/booking/{id}', [LandingPageController::class, 'booking']) -> name('booking');
Route::get('/booking/{id}/process', [LandingPageController::class, 'bookingProcess']) -> name('booking-process');
Route::get('/booking/{id}/payment', [LandingPageController::class, 'bookingPayment']) -> name('booking-payment');

Route::middleware(['auth'])->group(function () {
    Route::prefix('my')->name('my.')->group(function () {
        Route::get('/profil', [ProfilController::class, 'index'])->name('index');
        Route::put('/profil/update', [ProfilController::class, 'profil_update'])->name('profil_update');
        Route::get('/my-booking', [ProfilController::class, 'my_booking'])->name('my-booking');
        Route::get('/purchase-list', [ProfilController::class, 'purchase_list'])->name('purchase-list');
    });
});

Route::middleware(['auth', 'role:ADMIN,OWNER'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ManageProductController::class, 'index'])->name('index');
            Route::get('/create', [ManageProductController::class, 'create'])->name('create');
            Route::post('/store', [ManageProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ManageProductController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ManageProductController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [ManageProductController::class, 'delete'])->name('delete');
            Route::get('/show', [ManageProductController::class, 'show'])->name('show');
            Route::get('/export-pdf', [ManageProductController::class, 'export_pdf'])->name('export_pdf');
            Route::get('/export-excel', [ManageProductController::class, 'export_excel'])->name('export_excel');
        });
        Route::prefix('booking')->name('booking.')->group(function () {
            Route::get('/', [ManageBookingController::class, 'index'])->name('index');
            Route::get('/{id}', [ManageBookingController::class, 'show'])->name('show');
            Route::get('/export-pdf', [ManageBookingController::class, 'export_pdf'])->name('export_pdf');
            Route::get('/export-excel', [ManageBookingController::class, 'export_excel'])->name('export_excel');
        });
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [ManageBlogController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [ManageBlogController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ManageBlogController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [ManageBlogController::class, 'delete'])->name('delete');
            Route::get('/create', [ManageBlogController::class, 'create'])->name('create');
            Route::post('/store', [ManageBlogController::class, 'store'])->name('store');
            Route::get('/export-pdf', [ManageBlogController::class, 'export_pdf'])->name('export_pdf');
            Route::get('/export-excel', [ManageBlogController::class, 'export_excel'])->name('export_excel');
        });
        Route::prefix('voucher')->name('voucher.')->group(function () {
            Route::get('/', [ManageVoucherController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [ManageVoucherController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ManageVoucherController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [ManageVoucherController::class, 'delete'])->name('delete');
            Route::get('/create', [ManageVoucherController::class, 'create'])->name('create');
            Route::post('/store', [ManageVoucherController::class, 'store'])->name('store');
            Route::get('/show', [ManageVoucherController::class, 'show'])->name('show');
        });
        Route::prefix('partner')->name('partner.')->group(function () {
            Route::get('/', [ManagePartnerController::class, 'index'])->name('index');
            Route::get('/create', [ManagePartnerController::class, 'create'])->name('create');
            Route::post('/store', [ManagePartnerController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ManagePartnerController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ManagePartnerController::class, 'update'])->name('update');
        });
        Route::prefix('management-user')->name('management-user.')->group(function () {
            Route::get('/', [ManageUserController::class, 'index'])->name('index');
            Route::get('/create', [ManageUserController::class, 'create'])->name('create');
            Route::post('/store', [ManageUserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ManageUserController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ManageUserController::class, 'update'])->name('update');
            Route::get('/{id}/show', [ManageUserController::class, 'show'])->name('show');
        });
        Route::prefix('report')->name('report.')->group(function () {
            Route::get('/', [ManageReportController::class, 'index'])->name('index');
            Route::get('/show', [ManageReportController::class, 'show'])->name('show');
            Route::get('/export-pdf', [ManageReportController::class, 'export_pdf'])->name('export_pdf');
            Route::get('/export-excel', [ManageReportController::class, 'export_excel'])->name('export_excel');
        });
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/', [ManageSettingController::class, 'index'])->name('index');
            Route::put('/{id}/update', [ManageSettingController::class, 'update'])->name('update');
        });
    });

});

Auth::routes();

// Not Found Route
Route::fallback(function () {
    Log::warning('404 Error', [
        'url' => request()->fullUrl(),
        'user_agent' => request()->userAgent(),
        'ip' => request()->ip()
    ]);

    return response()->view('pages.404', [], 404);
});
