<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug){
        return view('front.post',[
            'posts' => Posts::whereSlug($slug)->first()
        ]);
    }
}
