<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Dompdf\Dompdf;
use App\Models\Personne;
use Barryvdh\DomPDF\PDF;
use App\Models\Pointages;
use App\Models\UserPointer;
use Illuminate\Http\Request;
use App\Mail\WeeklyReportMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;


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

   public function voirpointer( $carte_id)
{
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
        
        $dateNow=Carbon::now();
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
            //if(Carbon::parse($point->date)->month==$dateNow->month){
                $date=new DateTime($point->heurDarriver);
                //  dd($date->format('H:i:s'));
                  $rs =(abs(strtotime("18:00:00")-strtotime($date->format('H:i:s')))/3600)*60;
                //  dd($rs);
                  $specificHours += $rs;
            //};
          
        }
   // dd($specificHours);
        $percentage = ($specificHours / $totalHours) * 100;
           //dd($percentage);
              $data=[
            "pointage"=>$pointage,
            "userPointer"=>$userPointer[0],
            "percentage"=>$percentage
        ];
    }else{
        $data=[
            "pointage"=>null,
            "userPointer"=>$userPointer[0],
            "percentage"=>null
        ];
    }
        return view('pointeur.show', $data);
   
}


public function generatePDF()

{
    $personns=Personne::all();
   
    
    $date = Carbon::now()->toDateString();
    $pointage = Pointages::where('date',$date)->orderBy('heurDarriver')->get();

    $data =[
            "jour"=>Carbon::now()->toDateString(),
            "pointage"=>$pointage,
        ];
         $content = view('emails.weekly_report', $data)->render();
         $dimension= array(0,0,680,920);

    $pdf = new Dompdf();
    $pdf->loadHtml($content);
    $pdf->setPaper($dimension);
    $pdf->render();
    $pdfContent = $pdf->output();
    /*  Mail::to('mamejarrah99@gmail.com')
        ->send(new  WeeklyReportMail());  */
        foreach ($personns as $person) {
            Mail::send([], [], function ($message) use ($person, $pdfContent) {
                $message->to($person->email)
                    ->subject('Weekly Report')
                    ->attachData($pdfContent, 'weekly_report.pdf');
            });
        }
        //helloworld
    return $pdf->stream("pointeur/listPointage.pdf");
}




}
