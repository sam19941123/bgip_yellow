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
        
         return back()->withInput();
    }

}
