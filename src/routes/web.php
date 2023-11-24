<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\RestController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [TimeController::class, 'index']);
    Route::get('/attendance', [TimeController::class, 'attendancePage']);
    Route::get('/userList', [TimeController::class, 'userList']);
});
Route::post('/time', [TimeController::class, 'workStart']);
Route::post('/time/update', [TimeController::class, 'workEnd']);
Route::get('/attendance/nextDay', [TimeController::class, 'nextDay']);
Route::post('/attendance/nextDay', [TimeController::class, 'nextDay']);
Route::get('/userList/detail', [TimeController::class, 'detail']);
Route::get('/userList/nextMonth', [TimeController::class, 'nextMonth']);
Route::post('/userList/nextMonth', [TimeController::class, 'nextMonth']);
Route::post('/rest', [RestController::class, 'restStart']);
Route::post('/rest/update', [RestController::class, 'restEnd']);