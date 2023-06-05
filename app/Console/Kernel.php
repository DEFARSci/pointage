<?php

namespace App\Console;

use App\Mail\WeeklyReportMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $personnes = \App\Personne::all(); // Obtenez la liste des utilisateurs à qui vous souhaitez envoyer l'e-mail
            foreach ($personnes as $personne) {
            Mail::to('mamejarrah99@gmail.com')->send(new WeeklyReportMail());
            }
        })->weekly()->fridays()->at('18:00'); // Configurez ici le jour et l'heure d'envoi de l'e-mail
       /*  $schedule->command('email:weekly-report')->weeklyOn(5, '18:00'); */
       
    $schedule->command('email:send-weekly-report')->fridays()->at('20:00');


}
    

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
