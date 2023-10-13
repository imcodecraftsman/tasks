<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function addCustomer(){
        $country = new Country();
        $country->country_name = 'Afganistan';
        $customer = new Customer();
        $customer->customer_name = 'Harshal Kshirsagar';
        $customer->customer_email = 'hk2000@gmail.com';
        $customer->save();
        $customer->country()->save($country);
    }

    public function showCountry($id){
        $country = Customer::find($id)->country;
        return view('country',['country' => $country]);
    }
}
