<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/blog", "BlogController@index")->name('blog');
Route::get("/blog/details/{id}", "BlogController@show");
Route::get("/blog/{search}", "BlogController@search");

Route::post("/comment-form","CommentController@store");

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//this route solve the problem of 404 when vue route is in history mode not hash (#) mode
//Route::get('/{catchall?}','AppController@show')->where('catchall','^(?!api).*$')->name('administration');