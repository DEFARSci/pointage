<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPointerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a grougetuserp which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('userPointer/',[UserPointerController::class,'addcartid'])->name('userPointer');
Route::get('userPointers/',[UserPointerController::class,'getuser'])->name('getuserPointer');
Route::get('userPointers/{carte_id}',[UserPointerController::class,'showuser'])->name('showuserPointer');
