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
    return redirect()->route('home');
});

Auth::routes();

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/{firm_id}/manage-firm/admin',[FirmController::class, 'adminPage'])->middleware('manage-user')->name('adminPage');
Route::get('/{firm_id}/user/new',[UserController::class, 'createUserPage'])->middleware('manage-user','check-membership')->name('createUserPage');
Route::get('/{firm_id}/user/detail/{user_id}',[UserController::class,'detailPage'])->middleware('manage-user','check-membership')->name('userDetailPage');
Route::get('/{firm_id}/profile/detail/{user_id}',[UserController::class,'profilePage'])->middleware('manage-user','check-membership')->name('profileDetailPage');
Route::get('/{firm_id}/recipient/detail/{recipient_id}',[UserController::class,'detailPage'])->middleware('manage-recipient','check-membership')->name('recipientDetailPage');
Route::post('/{firm_id}/user/update',[UserController::class,'updateUser'])->middleware('manage-user','check-membership')->name('updateUser');
Route::post('/{firm_id}/user/create',[UserController::class,'createUser'])->middleware('manage-user','check-membership')->name('createUser');
Route::get('/{firm_id}/user/delete/{user_id}',[UserController::class,'deleteUser'])->middleware('manage-user','check-membership')->name('deleteUser');
