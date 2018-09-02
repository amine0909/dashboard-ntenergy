<?php

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
    return view('auth.login');
});

Route::get("/updateUserInfo", function() {
    return view('updateInfo');
})->name('updateInfo')->middleware('auth');

Route::get("/updatePassword", function() {
    return view('updatePassword');
})->name('updatePassword')->middleware('auth');

Route::post('saveUpdatedInfo', 'userController@saveUpdate')->name("saveUpdate")->middleware('auth');
Route::post('savePassword', 'userController@savePassword')->name("savePassword")->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
