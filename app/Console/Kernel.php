<?php

namespace App\Console;

use App\Mail\WeeklyReportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\PointagesController;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
            $pointageController=new PointagesController();
            $pointageController->generatePDF();
         
        })->dailyAt('12:52')->when(function () {
            return date('Y-m-d') === '2023-06-05';
        });  // Configurez ici le jour et l'heure d'envoi de l'e-mail
       /*  $schedule->command('email:weekly-report')->weeklyOn(5, '18:00'); */
       
  //  $schedule->command('email:send-weekly-report')->fridays()->at('20:00');


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
