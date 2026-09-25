<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('pages.Home');
});
Route::get('/sewa-villa', function () {
    return view('pages.sewa-villla.ListVilla');
});
Route::get('/sewa-villa/{id}', function ($id) {
    return view('pages.sewa-villla.DetailVilla', compact('id'));
});
Route::get('/tersimpan', function () {
    return view('pages.Saved');
});
Route::get('/trip', function () {
    return view('pages.sewa-villla.ListVilla');
});
Route::get('/blog', function () {
    return view('pages.Blog');
});
Route::get('/kontak', function () {
    return view('pages.Contact');
});
Route::get('/booking', function () {
    return view('pages.booking.index');
});
Route::get('/booking/process', function () {
    return view('pages.booking.Process');
});



Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
});

Auth::routes();
