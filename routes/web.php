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

// Route::get('buy/{cookies}', function ($cookies) {
   
//     $wallet = Auth::user()->wallet;
//     Auth::user()->update(['wallet' => $wallet - $cookies * 1]);
//     Log:info('User ' . $user->email . ' have bought ' . $cookies . ' cookies'); // we need to log who ordered and how much
//     return 'Success, you have bought ' . $cookies . ' cookies!';
// });

Route::get('/', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/login', 'App\Http\Controllers\UserController@login');
Route::get('/buy', 'App\Http\Controllers\UserController@storeSessionData');