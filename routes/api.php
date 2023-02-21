<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ResetPassController;
use App\Http\Controllers\User\EmailVerfyController;
use App\Http\Controllers\User\ForgetPassController;
use App\Http\Controllers\ProductsDiscountController;
use App\Http\Controllers\ProductsInventoryController;
use App\Http\Controllers\Admin\AdminProfileController;

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


//products
Route::get('/products', [ProductsController::class, 'index']);
Route::post('/products', [ProductsController::class, 'store']);
Route::get('/products/{products}', [ProductsController::class, 'show']);
Route::put('/products/{products}', [ProductsController::class, 'update']);
Route::delete('/products/{products}', [ProductsController::class, 'destroy']);
Route::get('/products/search/{name}', [ProductsController::class, 'search']);
Route::get('/products/search/categories/{name}', [ProductsController::class, 'searchCategories']);



//categories
Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::get('/categories/{categories}', [CategoriesController::class, 'show']);
Route::put('/categories/{categories}', [CategoriesController::class, 'update']);
Route::delete('/categories/{categories}', [CategoriesController::class, 'destroy']);
Route::get('/categories/search/{name}', [CategoriesController::class, 'search']);


//inventory
Route::get('/Inventory', [ProductsInventoryController::class, 'index']);
Route::post('/Inventory', [ProductsInventoryController::class, 'store']);
Route::get('/Inventory/{Inventory}', [ProductsInventoryController::class, 'show']);
Route::put('Inventory/{Inventory}', [ProductsInventoryController::class, 'update']);
Route::delete('/Inventory/{Inventory}', [ProductsInventoryController::class, 'destroy']);
Route::get('/Inventory/search/{name}', [ProductsInventoryController::class, 'search']);



//discount
Route::get('/Discount', [ProductsDiscountController::class, 'index']);
Route::post('/Discount', [ProductsDiscountController::class, 'store']);
Route::get('/Discount/{Discount}', [ProductsDiscountController::class, 'show']);
Route::put('Discount/{Discount}', [ProductsDiscountController::class, 'update']);
Route::delete('/Discount/{Discount}', [ProductsDiscountController::class, 'destroy']);
Route::get('/Discount/search/{name}', [ProductsDiscountController::class, 'search']);


//shopping
Route::get('/shopping', [ShoppingController::class, 'index']);
Route::post('/shopping', [ShoppingController::class, 'store']);
Route::get('/shopping/{shopping}', [ShoppingController::class, 'show']);
Route::put('shopping/{shopping}', [ShoppingController::class, 'update']);
Route::delete('/shopping/{shopping}', [ShoppingController::class, 'destroy']);
Route::get('/shopping/search/{name}', [ShoppingController::class, 'search']);


//cart
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'store']);
Route::get('/cart/{cart}', [CartController::class, 'show']);
Route::put('/cart/{cart}', [CartController::class, 'update']);
Route::delete('/cart/{cart}', [CartController::class, 'destroy']);
Route::get('/cart/search/{name}', [CartController::class, 'search']);

