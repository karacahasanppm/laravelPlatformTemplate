<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RecipientController;

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

Route::middleware('auth')->group(function (){

    Route::middleware(['manage-firm'])->group(function (){

        Route::get('/super-dashboard',[UserController::class,'superuserDashboard'])->name('superuserDashboard');
        Route::get('/superuserAssignFirm/{firm_id}/{user_id}',[UserController::class,'superuserAssignFirm'])->name('superuserAssignFirm');

    });

    Route::middleware(['check-membership'])->group(function () {

        Route::get('/{firm_id}/profile/detail/{user_id}',[UserController::class,'profilePage'])->name('profileDetailPage');

        Route::middleware(['manage-user'])->group(function (){

            Route::get('/{firm_id}/manage-firm/admin',[FirmController::class, 'adminPage'])->name('adminPage');
            Route::get('/{firm_id}/user/create',[UserController::class, 'createUserPage'])->name('createUserPage');
            Route::get('/{firm_id}/user/detail/{user_id}',[UserController::class,'detailPage'])->name('userDetailPage');

            Route::post('/{firm_id}/user/update',[UserController::class,'updateUser'])->name('updateUser');
            Route::post('/{firm_id}/user/create',[UserController::class,'createUser'])->name('createUser');
            Route::get('/{firm_id}/user/delete/{user_id}',[UserController::class,'deleteUser'])->name('deleteUser');

        });

        Route::middleware(['manage-recipient'])->group(function (){

            Route::get('/{firm_id}/recipient/create',[RecipientController::class, 'createRecipientPage'])->name('createRecipientPage');
            Route::post('/{firm_id}/recipient/update',[RecipientController::class,'update'])->name('updateRecipient');
            Route::post('/{firm_id}/recipient/create',[RecipientController::class,'create'])->name('createRecipient');
            Route::get('/{firm_id}/recipient/delete/{recipient_id}',[RecipientController::class,'delete'])->name('deleteRecipient');

        });

        Route::middleware(['view-recipient'])->group(function (){
            Route::get('/{firm_id}/recipient/detail/{recipient_id}',[RecipientController::class,'index'])->name('recipientDetailPage');
        });

    });

});

