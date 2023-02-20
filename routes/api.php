<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ResetPassController;
use App\Http\Controllers\User\EmailVerfyController;
use App\Http\Controllers\User\ForgetPassController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//public
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('admin/login',[AdminController::class,'login']);
Route::post('password/forget-password',[ForgetPassController::class,'forgetPassword']);
Route::post('password/reset-password',[ResetPassController::class,'passwordReset']);
//admin
Route::get('admin/Alladmins',[AdminProfileController::class,'profile'])
->middleware(['auth:sanctum', 'ability:admin']);
//frontuser
Route::get('allUsers',[ProfileController::class,'allUsers'])
->middleware(['auth:sanctum', 'ability:user,admin']);
Route::post('email-verfication',[EmailVerfyController::class,'emaiVerify'])
->middleware(['auth:sanctum', 'ability:user,admin']);
Route::get('email-verfication',[EmailVerfyController::class,'resendEmailVerify'])
->middleware(['auth:sanctum', 'ability:user,admin']);
