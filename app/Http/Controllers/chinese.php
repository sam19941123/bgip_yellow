<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chinese extends Controller
{
     public function resource_list($id)    
    {
        $bggid = $id;
        $title = $_GET['title'];
        $url = $_GET['url'];
        DB::table('link')->insert(
        ['bggid' => $id, 'title' => $title, 'link' => $url, 'username'=>'yourmother']
        );
        
        return view('chinese_resource')
    }
}
