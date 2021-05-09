<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('/calendar', [ApiController::class, 'calendar']);
Route::get('/check', [ApiController::class, 'check']);
Route::get('/detail', [ApiController::class, 'detail']);
Route::get('/enrol', [ApiController::class, 'enrol']);
Route::get('/list', [ApiController::class, 'list']);
Route::get('/recieve', [ApiController::class, 'recieve']);
Route::get('/update', [ApiController::class, 'update']);
