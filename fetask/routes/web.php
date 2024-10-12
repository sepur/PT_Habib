<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cek_login;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
    return redirect('/login');
});

	
    #Route::get('/', [App\Http\Controllers\Aplikasicontroller::class, 'dasboardportal'])->name('dasboardportal');

    // Route::get('/', [App\Http\Controllers\Authcontroller::class, 'viewLogin'])->name('login');
    Route::get('/login', [App\Http\Controllers\Authcontroller::class, 'viewLogin'])->name('login');
    Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create'])->name('register');
    Route::post('/storeregister', [App\Http\Controllers\RegisterController::class, 'store'])->name('storeregister');
    Route::post('/auth', [App\Http\Controllers\Authcontroller::class, 'authenticate'])->name('auth');


});

// Route::group(['middleware' => 'auth'], function () {
Route::middleware([Cek_login::class])->group(function () {
    Route::get('/logout', [App\Http\Controllers\Authcontroller::class, 'logout'])->name('logout');
    Route::get('/dasboardportal', [App\Http\Controllers\Aplikasicontroller::class, 'dasboardportal'])->name('dasboardportal');
    // Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    // Route::get('/listUser', [App\Http\Controllers\Usercontroller::class, 'listUser'])->name('listUser');
    // Route::post('/adduser', [App\Http\Controllers\Usercontroller::class, 'adduser'])->name('adduser');


     ##User
    Route::get('/indexuser', [App\Http\Controllers\Usercontroller::class, 'indexuser'])->name('indexuser');
    Route::get('/createuser', [App\Http\Controllers\Usercontroller::class, 'createuser'])->name('createuser');
    Route::get('/showupdateuser/{id}', [App\Http\Controllers\Usercontroller::class, 'showupdateuser'])->name('showupdateuser');
    Route::post('/storeupdateuser/{id}', [App\Http\Controllers\Usercontroller::class, 'storeupdateuser'])->name('storeupdateuser');
    Route::get('/listUser', [App\Http\Controllers\Usercontroller::class, 'listUser'])->name('listUser');
    Route::post('/adduser', [App\Http\Controllers\Usercontroller::class, 'adduser'])->name('adduser');
    Route::post('/deleteuser/{id}', [App\Http\Controllers\Usercontroller::class, 'deleteuser'])->name('deleteuser');

    #Aplikasi
    Route::get('/indexaplikasi', [App\Http\Controllers\Aplikasicontroller::class, 'indexaplikasi'])->name('indexaplikasi');
    Route::get('/createaplikasi', [App\Http\Controllers\Aplikasicontroller::class, 'createaplikasi'])->name('createaplikasi');
    Route::get('/showupdateaplikasi/{id}', [App\Http\Controllers\Aplikasicontroller::class, 'showupdateaplikasi'])->name('showupdateaplikasi');
    Route::post('/storeupdateaplikasi/{id}', [App\Http\Controllers\Aplikasicontroller::class, 'storeupdateaplikasi'])->name('storeupdateaplikasi');
    Route::get('/listaplikasi', [App\Http\Controllers\Aplikasicontroller::class, 'listaplikasi'])->name('listaplikasi');
    Route::post('/addaplikasi', [App\Http\Controllers\Aplikasicontroller::class, 'addaplikasi'])->name('addaplikasi');
    Route::post('/deleteaplikasi/{id}', [App\Http\Controllers\Aplikasicontroller::class, 'deleteaplikasi'])->name('deleteaplikasi');


    #Task
    Route::get('/indextask', [App\Http\Controllers\Taskcontroller::class, 'indextask'])->name('indextask');
    Route::get('/createtask', [App\Http\Controllers\Taskcontroller::class, 'createtask'])->name('createtask');
    Route::get('/showupdatetask/{id}', [App\Http\Controllers\Taskcontroller::class, 'showupdatetask'])->name('showupdatetask');
    Route::post('/storeupdatetask/{id}', [App\Http\Controllers\Taskcontroller::class, 'storeupdatetask'])->name('storeupdatetask');
    Route::get('/listtask', [App\Http\Controllers\Taskcontroller::class, 'listtask'])->name('listtask');
    Route::post('/addtask', [App\Http\Controllers\Taskcontroller::class, 'addtask'])->name('addtask');
    Route::post('/deletetask/{id}', [App\Http\Controllers\Taskcontroller::class, 'deletetask'])->name('deleteaplikasi');


    #Report
    Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
    Route::get('/eksekusireport', [App\Http\Controllers\ReportController::class, 'eksekusireport'])->name('eksekusireport');


});
