<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\PostController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PostController as FrontPostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('front.welcome');
// });

Route::get('/',[HomeController::class,'index']);
Route::get('/posts',[HomeController::class,'posts']);
Route::get('/about',[HomeController::class,'about']);

Route::get('/p/{slug}', [FrontPostController::class, 'show']);

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index']);

    Route::resource('/post', PostController::class);
    
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
