<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    public function voirpointermois($carte_id, Request $request)
    {
    //  setlocale(LC_TIME, 'fr_FR');
        // $mois = date('F', mktime(0, 0, 0, $request->mois, 1));
        $mois=DateTime::createFromFormat('!m', $request->mois)->format('F');
        //dd($mois);
                 $userPointer = DB::table('user_pointers')
            ->where('carte_id','=',$carte_id)
            ->get();
    
                //dd($userPointer);
                $pointage = DB::table('user_pointers')
            ->join('pointages', 'user_pointers.carte_id', '=', 'pointages.pointers_carte_id')
            ->where('carte_id','=',$carte_id)
            ->select('user_pointers.*', 'pointages.*')
            ->get();
          
    
            if ($pointage->has(0)) {
               $date1=new DateTime($pointage[0]->date);
           
           // dd($date1);
            
            $dateNow=\Carbon\Carbon::now();
            // if ($dateNow->isLastOfMonth()) {
            //     # code...l
            // }
           //dd($dateNow);
           $interval=new DateInterval('P1D');
    
           $periode = new DatePeriod($date1, $interval, $dateNow);
    
           $nombreDeJours = 0;
    
    foreach ($periode as $jour) {
        $jourDeLaSemaine = $jour->format('N'); // 1 (lundi) à 7 (dimanche)
    
        if ($jourDeLaSemaine < 6) {
            $nombreDeJours++;
        }
    }
    
    
          // dd($interval);
           // $diff=$date1->diff(Carbon::now());
          // dd($diff->days);
            $totalHours = ((abs(strtotime("18:00:00")-strtotime("9:00:00"))/3600)*60)*$nombreDeJours;
           // dd($totalHours); // Nombre total d'heures
            $specificHours = 0; // Nombre d'heures spécifique à représenter
            $total=0;
    
           // dd($totalHours);
    
            foreach($pointage as $point){
               // dd(Carbon::parse($point->date)->month);
                if(Carbon::parse($point->date)->month==$request->mois){
                    $dateArriver=new DateTime($point->heurDarriver);
                    $dateDepart=new DateTime($point->heurDepart);

                    if ($point->heurDepart==null) {
                        $rs =(abs(strtotime("18:00:00")-strtotime($dateArriver->format('H:i:s')))/3600)*60;
    
                    }else{
    
                        $rs =(abs(strtotime($dateDepart->format('H:i:s'))-strtotime($dateArriver->format('H:i:s')))/3600)*60;
                    }
                    //dd($rs);
                      $specificHours += $rs;
                      $total +=$point->paiementRetard;
                };
              
            }
       // dd($specificHours);
            $percentage = ($specificHours / $totalHours) * 100;
               //dd($percentage);
                  $data=[
                "pointage"=>$pointage,
                "userPointer"=>$userPointer[0],
                "percentage"=>$percentage,
                "mois"=>$mois,
                "testmois"=>$request->mois,
                "total"=>$total,
            ];
        }else{
            $data=[
                "pointage"=>null,
                "userPointer"=>$userPointer[0],
                "percentage"=>null,
                "mois"=>$mois,
                "total"=>null,
            ];
        }
            return view('pointeur.showmois', $data);
       
    }
    
}
