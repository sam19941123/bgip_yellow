<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class search extends Controller
{
    public function get_list()
    {
        $keyword = $_GET['bgname'];
        $game_list = DB::table('games')->where('name_eng','like','%'.$keyword.'%')->get();
        session(['keyword' => $keyword]);

        if(count($game_list) == 1)
        {
            return view('game_detail',['data'=>$game_list[0]]);
        }
    
        return view('game_list',['games'=>$game_list,'keyword'=>$keyword]);
    }

    public function get_game_detail($id)
    {
        $game_data = DB::table('games')->where('bggid',$id)->get()->first();
        return view('game_detail',['data'=>$game_data]);
    }
}
