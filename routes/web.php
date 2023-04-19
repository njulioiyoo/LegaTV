<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('live');
    // return view('welcome');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', ['as' => 'news', 'uses' => 'App\Http\Controllers\PageController@news']);
    Route::get('/{slug}', ['as' => 'news.detail', 'uses' => 'App\Http\Controllers\PageController@newsDetail']);
});

Route::group(['prefix' => 'program'], function () {
    Route::get('/', ['as' => 'program', 'uses' => 'App\Http\Controllers\PageController@program']);
    Route::get('/{slug}', ['as' => 'program.detail', 'uses' => 'App\Http\Controllers\PageController@programDetail']);
});

Route::get('/live', ['as' => 'livetv', 'uses' => 'App\Http\Controllers\PageController@liveTV']);
