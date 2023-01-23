<?php

use App\Models\GroupsUser;
use App\Models\User;
use Carbon\Carbon;
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

Route::get('/mail-preview', function(){

    $user = User::with('group')->get();
    dd($user);

    if(empty($user->group[0])){
        dd($user->group);
    }
   // dd($user[0]);
    return new App\Mail\SendMail($users);
});


