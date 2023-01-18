<?php

namespace App\Http\Controllers;

use App\Models\Pointages;
use App\Models\UserPointer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PointagesController extends Controller
{
    public function index(){
        $userPointeur=UserPointer::all();
        
        return View('pointeur.index',compact('userPointeur'));
    }

    public function listPiontage(){
       // $pointage=Pointages::all();
       $pointage = DB::table('user_pointers')
       ->join('pointages', 'user_pointers.carte_id', '=', 'pointages.pointers_carte_id')
       ->where('date','=',Carbon::now()->toDateString())
       ->select('user_pointers.*', 'pointages.*')
       ->get();
       
        //dd($pointage);
        $data=[
            "pointage"=>$pointage,
            "jour"=>Carbon::now()->toDateString()
        ];
        return View('pointeur.listPiontage',$data);
    }

    public function getuserpointer($id){
        $pointeur=UserPointer::find($id);
        $data=[
            "pointeur"=>$pointeur,
        ];
        return View('pointeur.edit',$data);
    }

    public function saveuserpointer(Request $request, $id){
        request()->validate([
                 'nom' =>['required','max:20'],
                'prenom' =>['required'],
                'phone' =>['required'],
            ]);


        $pointeur=UserPointer::find($id);
        $pointeur->nom=$request->nom;
        $pointeur->prenom=$request->prenom;
        $pointeur->phone=$request->phone;
        $pointeur->email=$request->email;
        $pointeur->save();

        $sucess='User Updated';
        return back()->withSuccess($sucess);

    }

    public function Piontagedate(Request $request){

        $pointage = DB::table('user_pointers')
        ->join('pointages', 'user_pointers.carte_id', '=', 'pointages.pointers_carte_id')
        ->where('date','=',$request->date)
        ->select('user_pointers.*', 'pointages.*')
        ->get();

        $data=[
            "pointage"=>$pointage,
            "jour"=>$request->date
        ];
        return View('pointeur.listPiontagedate',$data);
        
    }
}
