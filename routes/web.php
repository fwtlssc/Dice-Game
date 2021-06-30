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


Route::get('/','FrontendController@index')->name('index');
Route::post('/','FrontendController@roll')->name('roll');

Route::group(['prefix'=>'admin'],function(){
    Route::get('login','AdminController@loginIndex')->name('login');
    Route::post('login','AdminController@login');
    Route::group(['middleware'=>'admin'],function(){
        Route::get('/','AdminController@index')->name('admin.index');
        Route::post('/admin','AdminController@update');
        Route::post('logout','AdminController@logout')->name('logout');
    });
});

Route::get('test',function(){
    
    return view('test');
})->name('test');
