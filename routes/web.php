<?php

use App\Events\MessageNotification;
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

// to fire event
Route::get('/event', function () {
    event(new MessageNotification('this my first broadcast message !'));
});

// to listen to event

Route::get('/listen', function () {
    return view('listen');
});
