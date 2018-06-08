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

//route for login
Route::get('/login', function () {
    return view('welcome');
});

//route for daily expense
Route::get('/daily-expense', function () {
    return view('welcome');
});

//route for noting down any new expense
Route::get('/note-expense', function () {
    return view('welcome');
});

Route::post('/note-expense', function () {
    return view('welcome');
});

Route::get('/open-day', function(){
   return view('welcome');
});

Route::get('/close-day', function(){
    return view('welcome');
});

Route::get('/open-day', function(){
    return view('welcome');
});

Route::get('/add-vendor', function(){
    return view('welcome');
});

Route::get('/add-item', function(){
    return view('welcome');
});