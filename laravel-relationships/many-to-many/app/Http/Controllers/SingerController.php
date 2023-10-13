<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use App\Models\SingerSong;
use App\Models\Song;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    public function addSinger()
    {
        $singer = new Singer;
        $singer->name = 'Lata Mangeshkar';
        $singer->save();

        $songsIds = [1,3,5];
        $singer->songs()->attach($songsIds);
    }


    // Get singers from song id
    public function showSinger($id){
        return $singers = Song::find($id)->singers;
     }
}
