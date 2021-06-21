<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\changeuser;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\UserInfo;
use App\Http\Controllers\UserinfoController;
use App\CustomFacade;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Route::middleware(['auth:sanctum', 'verified'])->get('/displayu',[UserController::class,'changeuser'])->name('displayu');

Route:: get('/usercontrols',[UserController::class, 'changeuser'])->name('users.controls');
Route:: post('/usersaction',[UserController::class, 'ajaxactionUser'])->name('users.action');
Route:: post('/usersadd',[UserController::class, 'addUser'])->name('users.add');
Route:: post('users/infostore',[UserinfoController::class,'store'])->name('users.store');
Route:: view('/usersinfo','userinfo_form')->name('usersinfo');
Route:: view('/usersimport','user_import')->name('usersimport');
Route:: post('/userscsv',[UserController::class, 'userImport'])->name('users.import');

// Route::get('/facademake',function(CustomFacade $custom)
// {
// $custom->hello('hi how are you ','sharmaash');
// });   made custom service

