<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointagesController;
use App\Http\Controllers\UserPointerController;

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

Route::get('userPointer',[PointagesController::class,'index'])->name('userPointer');
Route::get('getuserPointer/{id}',[PointagesController::class,'getuserpointer'])->name('getuserPointer');
Route::put('getuserPointer/{id}',[PointagesController::class,'saveuserpointer'])->name('saveuserPointer');


Route::get('Pointage',[PointagesController::class,'listPiontage'])->name('Pointer');
Route::get('Pointagedate',[PointagesController::class,'Piontagedate'])->name('Pointerdate');