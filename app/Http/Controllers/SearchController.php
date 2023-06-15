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
        setlocale(LC_TIME, 'fr_FR');
        $mois = date('F', mktime(0, 0, 0, $request->mois, 1));
       // dd($mois);
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
    
           // dd($totalHours);
    
            foreach($pointage as $point){
               // dd(Carbon::parse($point->date)->month);
                if(Carbon::parse($point->date)->month==$dateNow->month){
                    $date=new DateTime($point->heurDarriver);
                    //  dd($date->format('H:i:s'));
                      $rs =(abs(strtotime("18:00:00")-strtotime($date->format('H:i:s')))/3600)*60;
                    //  dd($rs);
                      $specificHours += $rs;
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
            ];
        }else{
            $data=[
                "pointage"=>null,
                "userPointer"=>$userPointer[0],
                "percentage"=>null,
                "mois"=>$mois,
            ];
        }
            return view('pointeur.showmois', $data);
       
    }
    
}
