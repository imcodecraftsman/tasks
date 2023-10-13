<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getAllData($id) {

        // Auther id
        $auther = Auther::find($id);
        $postsData = $auther->post;

        echo '<pre>';print_r($postsData);echo '</pre>';die;



        // Post id
        // $postsData = Post::find($id);
        // $auther = $postsData->auther;

        // echo '<pre>';print_r($auther);echo '</pre>';die;

    }
}
