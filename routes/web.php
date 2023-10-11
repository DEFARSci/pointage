<?php


use App\Mail\WeelyReportMail;
use App\Mail\WeeklyReportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\PointagesController;
use App\Http\Controllers\UserAdminController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/pointeur',[PointagesController::class,'index'])->name('userPointer');
Route::get('getuserPointer/{id}',[PointagesController::class,'getuserpointer'])->middleware(['auth'])->name('getuserPointer');
Route::put('getuserPointer/{id}',[PointagesController::class,'saveuserpointer'])->name('saveuserPointer');
Route::get('voirPointer/{carte_id}' , [PointagesController::class, 'voirpointer'])->name('voirPointer');
Route::get('/pointage/{jour}/pdf', [PointagesController::class, 'generatePDF'])->name('listPiontage.pdf');
// show pointer par mois
Route::get('voirPointermois/{carte_id}' , [SearchController::class, 'voirpointermois'])->name('voirPointermois');





Route::get('/',[PointagesController::class,'listPiontage'])->name('Pointer');
Route::get('Pointagedate',[PointagesController::class,'Piontagedate'])->name('Pointerdate');

Route::get('personne',[PersonneController::class,'indexp'])->name('indexp');
Route::get('/personne/create',[PersonneController::class, 'create'])->name('personne-create');
Route::post('/enregistrer/personne', [PersonneController::class, 'store'])->name('create');
Route::get('/personnes/{id}/edit', [PersonneController::class, 'edit'])->name('personne-edit');
Route::put('/personnes/{id}', [PersonneController::class, 'update'])->name('personnes.update');
Route::delete('/personnes/{id}', [PersonneController::class,'destroy'])->name('personnes.destroy');

//paiement

Route::get('/paiement/{carte_id}', [PaiementController::class, 'doPaiement'])->name('paiement');
Route::post('/paiment', [PaiementController::class, 'postpaiment'])->name('postpaiment');

// Route::get('/', function () {
//    Mail::to('mamejarrah99@gmail.com')
//         ->send(new  WeeklyReportMail());
// });

//utilisateur
Route::get('/user', [UserAdminController::class, 'index'])->name('user');
Route::delete('/user/{id}', [UserAdminController::class,'destroy'])->name('user.destroy');
