<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
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

           // dd($pointage);
              $data=[
            "pointage"=>$pointage,
            "userPointer"=>$userPointer[0],
        ];

        return view('pointeur.show', $data);
}






public function generatePDF()

{
    
    $date = Carbon::now()->toDateString();
    $pointage = Pointages::where('date',$date)->orderBy('heurDarriver')->get();

    $data =[
            "jour"=>Carbon::now()->toDateString(),
            "pointage"=>$pointage,
        ];
         $content = view('emails.weekly_report', $data)->render();

    $pdf = new Dompdf();
    $pdf->loadHtml($content);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $pdfContent = $pdf->output();
    /*  Mail::to('mamejarrah99@gmail.com')
        ->send(new  WeeklyReportMail());  */
          Mail::send([], [], function ($message) use ($pdfContent) {
           $message->to('mamejarrah99@gmail.com')
            ->subject('Weekly Report')
            ->attachData($pdfContent, 'weekly_report.pdf');
    });


    return $pdf->stream("pointeur/listPointage.pdf");
}




}
