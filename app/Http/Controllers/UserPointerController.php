<?php

namespace App\Http\Controllers;

use App\Models\Pointages;
use App\Models\UserPointer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        if (count($userPointer) !=0 && count($userPointerDepart) == 0) {
          $pointage=new Pointages();
          $pointage->pointers_carte_id=$userPointer[0]->carte_id;
          $pointage->heurDarriver=Carbon::now()->toTimeString();
          $pointage->date=Carbon::now()->toDateString();
          $pointage->save();

          return response()->json(['status' => 'arriver']);
        }elseif(count($userPointer) !=0 && count($userPointerDepart) != 0 && count($userPointerDepart2)!=0){
         $pointageDerparts=Pointages::find($userPointerDepart2[0]->id);
         $pointageDerparts->heurDepart=Carbon::now()->toTimeString();
          $pointageDerparts->save();
             return response()->json(['status' => $pointageDerparts]);
        }else{

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


