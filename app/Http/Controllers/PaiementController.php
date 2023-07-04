<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    public function doPaiement($carte_id){

        $paiements = DB::table('paiements')
        ->where('pointers_carte_id', '=', $carte_id)
        ->select('paiements.*')
        ->get();
        $pointeur=DB::table('user_pointers')
        ->where('carte_id', '=', $carte_id)
        ->select('user_pointers.*')
        ->get();
       
    $data=[
        "paiements" => $paiements,
        "carte_id" => $carte_id,
        "pointeur" => $pointeur[0],
    ];

        return view('pointeur.paiement', $data);

    }
   

    public function postpaiment(Request $request){

        
        $paiement = new Paiement();
        $paiement->pointers_carte_id=$request->carte_id;
        $paiement->date= Carbon::now()->toDateString();
        $paiement->depot=$request->motant;
        $paiement->save();
    return redirect("voirPointer/" . $paiement->pointers_carte_id);

    }
}
