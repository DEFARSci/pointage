<?php

namespace App\Http\Controllers;

use App\Models\Pointages;
use App\Models\UserPointer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;


class UserPointerController extends Controller
{
   public function addcartid(Request $request){

    $cart_id=$request->carte_id;

    $userPointer = DB::table('user_pointers')
        ->where('carte_id','=',$cart_id)
        ->get();
    $userPointerDepart = DB::table('pointages')
        ->where('date','=',Carbon::now()->toDateString())
        ->where('pointers_carte_id','=',$cart_id)
        ->get();
    $userPointerDepart2 = DB::table('pointages')
        ->where('pointers_carte_id','=',$cart_id)
        ->where('date','=',Carbon::now()->toDateString())
        ->get();

    // Vérifier si l'utilisateur a déjà une carte d'identité dans la base de données
    if (count($userPointer) !=0 && count($userPointerDepart) == 0) {
        // Calculer le paiement de retard en fonction de l'heure d'arrivée
        $heureArrivee = Carbon::now()->toTimeString();
        $heureLimite1 = Carbon::createFromTimeString('9:00:00');
        $heureLimite2 = Carbon::createFromTimeString('9:10:00');
        $paiementRetard = 0;

        $heureArrivee = Carbon::parse($request->heure_arrivee);

        if ($heureArrivee->gte($heureLimite1) && $heureArrivee->lt($heureLimite2)) {
            $paiementRetard = 100;
        } elseif ($heureArrivee->gte($heureLimite2)) {
            $paiementRetard = 200;
        }

        // Ajouter le pointage à la base de données
        $pointage=new Pointages();
        $pointage->pointers_carte_id=$userPointer[0]->carte_id;
        $pointage->heurDarriver=$heureArrivee;
        $pointage->date=Carbon::now()->toDateString();
        $pointage->paiementRetard=$paiementRetard;
        $pointage->save();

        return response()->json(['status' => 'arriver']);
    } elseif (count($userPointer) !=0 && count($userPointerDepart) != 0 && count($userPointerDepart2)!=0) {
        // Mettre à jour le pointage de départ dans la base de données
        $pointageDepart=Pointages::find($userPointerDepart2[0]->id);
        $pointageDepart->heurDepart=Carbon::now()->toTimeString();
        $pointageDepart->save();

        return response()->json(['status' => $pointageDepart]);
    } else {
        // Ajouter la carte d'identité à la base de données
        $userPointer=new UserPointer();
        $userPointer->carte_id=$cart_id;
        $userPointer->save();

        return response()->json(['status'=>'ajouter']);
    }
}

    public function getuser(){
    //$userPointer= UserPointer::all();

    $userPointer = DB::table('user_pointers')
    ->join('pointages', 'user_pointers.carte_id', '=', 'pointages.pointers_carte_id')
    ->where('pointages.date','=',Carbon::now()->toDateString())
    ->select('user_pointers.*','pointages.*')
    ->get();

     //dd($userPointer);

      //  $userPointer = DB::table('user_pointers')
      //           ->where('carte_id','=',233)
      //           ->get();

      return response()->json($userPointer);
    }



}


