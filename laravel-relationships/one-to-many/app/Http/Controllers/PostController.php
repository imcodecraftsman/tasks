<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store($id) {
        $auther = Auther::find($id);
        $post = new Post();
        $post->title = 'My second blog with ram';
        $auther->post()->save($post);
    }

    public function getPostData($id) {
        $posts = Auther::find($id)->post;
        echo '<pre>';print_r($posts);echo '</pre>';die;
    }
}
