<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function addSong(){
        $song = new Song();
        $song->title = 'O mere dil ke chain';
        $song->save();
    }

    // Get songs from singer id
    public function showSongs($id){
       return $songs = Singer::find($id)->songs;
    }
}
