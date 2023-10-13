<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function showCustomer($id){
        $customer = Country::find($id)->customer;
        return view('customer',['customer' => $customer]);
    }
}
