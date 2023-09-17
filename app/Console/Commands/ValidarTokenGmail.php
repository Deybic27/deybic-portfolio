<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\GoogleConfigServicesController;

class ValidarTokenGmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:validar-token-gmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validar y enviar mail de recordatorio para refescar token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $serviceController = new GoogleConfigServicesController();
        $service = $serviceController->showByName('gmail_api');

        $espires_at = Carbon::create($service->expires_at);
        $now = Carbon::now();
        $now->modify("+10 minutes");
        if ($espires_at->lte($now)) {
            $gmail = new GmailController();
            $gmail->sendMail("System", "system@deybic-portfolio.com", "Deybic Rojas", "deybic9715@gmail.com", "REFRESH GMAIL TOKEN", "El token de acceso al api de gmail para el envío de correos está próximo a caducar, por favor refrescar el token en la siguiente url: " . env("APP_URL") . "/google/oauth");
        }
        print($now . "\n");
        print($espires_at);
    }
}
