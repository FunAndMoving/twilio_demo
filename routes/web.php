<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',[HomeController::class,'show']);
Route::post('/',[HomeController::class,'storePhoneNumber']);
Route::post('/custom', [HomeController::class,'sendCustomMessage']);
Route::get('/list',[HomeController::class,'get_list']);
Route::get('/received_message',[HomeController::class,'received_message']);