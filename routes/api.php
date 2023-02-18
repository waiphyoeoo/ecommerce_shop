<?php

use App\Http\Controllers\Api\HomeApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/home', [HomeApi::class, 'home']);
Route::get('/show/{slug}', [HomeApi::class, 'show']);

Route::post('/addview/{slug}', [HomeApi::class, 'viewCount']);
