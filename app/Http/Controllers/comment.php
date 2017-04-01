<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class comment extends Controller
{
    public function shut_up($id,Request $request)    
    {
        $like= $request->input('goodorbad');

        $bggid = $id;
        $username = $_GET['username'];
        $description = $_GET['description'];
   
        DB::table('comment')->insert(
        ['bggid' => $id, 'username' => $username,  'description' => $description, 'like'=>$like]
        );

        if($like == 0)
            DB::table('games')->where('bggid',$id)->increment('bad');
        else if($like == 1)
            DB::table('games')->where('bggid',$id)->increment('good');
        
         return back()->withInput();
    }

}
