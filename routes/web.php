<?php

use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\PageController as ControllersPageController;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ControllersPageController::class, 'index']);
Route::get('/product/{slug}', [ControllersPageController::class, 'show']);
Route::get('/authuser', function () {
    $user =  User::find(1);
    auth()->login($user);
    return auth()->user();
});


// admin routes
Route::get('/admin/login', [PageController::class, 'showlogin']);
Route::post('/admin/login', [PageController::class, 'login']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['Admin']], function () {
    Route::post('/logout', [PageController::class, 'logout']);
    Route::get('/', [PageController::class, 'showDashboard']);
    Route::post('/product-upload', [ProductController::class, 'imageUpload']);
    Route::get('/product-add/{slug}', [ProductController::class, 'productAdd']);
    Route::post('/product-add/{slug}', [ProductController::class, 'storeproductAdd']);
    Route::get('/product-remove/{slug}', [ProductController::class, 'productremove']);
    Route::post('/product-remove/{slug}', [ProductController::class, 'storeproductremove']);
    Route::get('/product-transactions', [ProductController::class, 'productTransactions']);
    Route::get('/product-remove-transactions', [ProductController::class, 'productremovetransactions']);
});
Route::group(['prefix' => 'admin', 'middleware' => ['Admin']], function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/color', ColorController::class);
    Route::resource('/product', ProductController::class);
});
