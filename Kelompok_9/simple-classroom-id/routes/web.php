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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');
Route::resource('classrooms', 'ClassroomsController');

Route::post('classrooms', 'ClassroomsController@create_participant')->name('classrooms.create_participant');
Route::post('classrooms/create', 'ClassroomsController@store')->name('classrooms.store');
Route::post('classrooms/{classroom}', 'ClassroomsController@theories')->name('classrooms.theories');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', 'UsersController');
    Route::resource('classrooms', 'ClassroomsController');

    Route::post('classrooms', 'ClassroomsController@create_participant')->name('classrooms.create_participant');
    Route::post('classrooms/create', 'ClassroomsController@store')->name('classrooms.store');
    Route::post('classrooms/{classroom}', 'ClassroomsController@theories')->name('classrooms.theories');
});

