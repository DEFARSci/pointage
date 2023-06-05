<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\Models\Pointage; 

class SendWeeklyReportEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-weekly-report';
    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'Send weekly report email';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    
       public function handle()
    {
        // Récupérer les données de pointage du lundi au vendredi depuis la base de données
        $pointage = Pointage::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('date')
            ->get();

        // Générer le contenu de la vue avec les données récupérées
        $content = view('emails.weekly_report', compact('pointage'))->render();

        // Générer le fichier PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $pdfContent = $dompdf->output();

        // Envoyer le courrier électronique avec le fichier PDF en pièce jointe
        Mail::raw('Weekly Report', function ($message) use ($pdfContent) {
            $message->to('recipient@example.com')
                ->subject('Weekly Report')
                ->attachData($pdfContent, 'weekly_report.pdf');
        });

        $this->info('Weekly report email sent successfully.');
    }
    
    }

