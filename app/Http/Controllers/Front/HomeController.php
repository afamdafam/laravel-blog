<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index',[
            'latest_posts' => Posts::with('User')->where('status', 1)->latest()->take(3)->get() 
        ]);
    }

    public function posts()
    {
        return view('front.posts-list',[
            'latest_posts' => Posts::with('User')->where('status', 1)->latest()->get()
        ]);
    }

    public function about(){
        return view('front.about');
    }
}