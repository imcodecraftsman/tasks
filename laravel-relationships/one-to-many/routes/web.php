<?php

use App\Http\Controllers\AutherController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('save_auther_data', [AutherController::class, 'store']);
Route::get('save_post_data/{auther_id}', [PostController::class, 'store']);

Route::get('get_post_data/{auther_id}', [PostController::class, 'getPostData']);

Route::get('get_auther_data/{post_id}', [AutherController::class, 'getAutherData']);


Route::get('get_all_data/{id}', [IndexController::class, 'getAllData']);
