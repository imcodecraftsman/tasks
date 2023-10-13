<?php

use App\Http\Controllers\SingerController;
use App\Http\Controllers\SongController;
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

Route::get('/add-song', [SongController::class, 'addSong']);
Route::get('/add-singer', [SingerController::class, 'addSinger']);

Route::get('/show-songs/{singer_id}', [SongController::class, 'showSongs']);
Route::get('/show-singers/{song_id}', [SingerController::class, 'showSinger']);
