<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function doPaiement($carte_id){

        return view('pointeur.paiement',compact('carte_id'));

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
