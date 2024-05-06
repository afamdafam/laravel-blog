<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('back.dashboard.index', [
            'total_posts' => Posts::count(),
            'total_views' =>  Posts::sum('views'),
            'latest_posts' => Posts::with('User')->whereStatus(1)->latest()->take(5)->get(),
            'popular_posts' => Posts::with('User')->whereStatus(1)->orderBy('views')->take(5)->get()
        ]);
    
}
}