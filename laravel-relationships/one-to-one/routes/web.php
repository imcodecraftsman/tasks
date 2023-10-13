<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('add-customer', [CustomerController::class, 'addCustomer']);
Route::get('show-country/{customer_id}', [CustomerController::class, 'showCountry']);
Route::get('show-customer/{country_id}', [CountryController::class, 'showCustomer']);



Route::get('index/{id}', [IndexController::class, 'index']);
