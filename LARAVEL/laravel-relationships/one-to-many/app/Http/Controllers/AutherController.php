<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use App\Models\Post;
use Illuminate\Http\Request;

class AutherController extends Controller
{
    public function store() {
        $auther = new Auther();
        $auther->name = 'Ram Jadhav';
        $auther->email = 'ramjadhav@gmail.com';
        $auther->save();
    }

    public function getAutherData($id) {
        $auther = Post::find($id)->auther;
        echo '<pre>';print_r($auther);echo '</pre>';die;
    }


}
