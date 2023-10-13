<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index($id){


            // Using Customer Model

            $customer = Customer::find($id);
            // this id is from customer table
            $allData = [
                'customer_name' => $customer->customer_name,
                'customer_email' => $customer->customer_email,
                'customer_country' => $customer->country->country_name
            ];
            return view('index', ['data' => $allData]);


            // Using Country Model

            // $country = Country::find($id);
            // // this id is from country table
            // $allData = [
            //     'customer_name' => $country->customer->customer_name,
            //     'customer_email' => $country->customer->customer_email,
            //     'customer_country' => $country->country_name
            // ];
            // return view('index', ['data' => $allData]);


    }
}
