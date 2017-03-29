<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class link extends Controller
{
    public function put_me_in($id)    
    {
        $bggid = $id;
        $title = $_GET['title'];
        $url = $_GET['url'];
        DB::table('link')->insert(
        ['bggid' => $id, 'title' => $title, 'link' => $url, 'username'=>'yourmother']
        );
        
        return back()->withInput();
    }
}
