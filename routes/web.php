<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\AdminOrMember;

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
    return view('welcome');
});

Auth::routes();

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/manage-firm/admin',[FirmController::class, 'adminPage'])->middleware(Admin::class)->name('adminPage');
Route::get('/user/new',[UserController::class, 'createUserPage'])->middleware(Admin::class)->name('createUserPage');
Route::get('/user/detail/{user_id}',[UserController::class,'detailPage'])->middleware(AdminOrMember::class)->name('userDetailPage');
Route::post('/user/update',[UserController::class,'updateUser'])->middleware(AdminOrMember::class)->name('updateUser');
Route::post('/user/create',[UserController::class,'createUser'])->middleware(Admin::class)->name('createUser');
