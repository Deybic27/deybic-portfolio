<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\GoogleConfigServicesController;
use Carbon\Carbon;

class GmailController extends Controller
{
    /**
     * Client id.
     * 
     * @var 
     */
    protected $__GOOGLE_GMAIL_CLIENT_ID__;

    /**
     * Client secret.
     * 
     * @var 
     */
    protected $__GOOGLE_GMAIL_CLIENT_SECRET__;

    /**
     * Name service.
     * 
     * @var 
     */
    protected $nameService;

    /**
     * Code.
     * 
     * @var string
     */
    protected $code;

    /**
     * Token.
     * 
     * @var string
     */
    protected $token;

    /**
     * Google Config Services Controller.
     * 
     * @var \App\Http\Controllers\GoogleConfigServicesController
     */
    protected $service;

    public function __construct()
    {
        $this->nameService = 'gmail_api';
        $this->__GOOGLE_GMAIL_CLIENT_ID__ = config('mail.mailers.google.api.gmail.client_id');
        $this->__GOOGLE_GMAIL_CLIENT_SECRET__ = config('mail.mailers.google.api.gmail.client_secret');
        $this->service = new GoogleConfigServicesController();
        
        $serviceInfo = $this->service->showByName($this->nameService);
        if (!$serviceInfo) {
            $request = new Request([
                "name" => $this->nameService,
                "client_id" => $this->__GOOGLE_GMAIL_CLIENT_ID__,
                "client_secret" => $this->__GOOGLE_GMAIL_CLIENT_SECRET__
            ]);
            $this->service->store($request);
            $serviceInfo = $this->service->showByName($this->nameService);
        }
        $this->code = $serviceInfo->code ?? "";
        $this->token = $serviceInfo->token ?? "";
    }

    public function getCode(Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded",
        ])->post("https://accounts.google.com/o/oauth2/v2/auth?client_id=" . $this->__GOOGLE_GMAIL_CLIENT_ID__ . "&redirect_uri=". $request->root() ."/google/oauth/token&scope=https://mail.google.com/&response_type=code");
        return $response;
    }

    public function getToken(Request $request) {
        $this->code = $request->get('code');
        $response = Http::post('https://accounts.google.com/o/oauth2/token', [
            "code" => $this->code,
            "client_id" => $this->__GOOGLE_GMAIL_CLIENT_ID__,
            "client_secret" => $this->__GOOGLE_GMAIL_CLIENT_SECRET__,
            "redirect_uri" => $request->root() . "/google/oauth/token",
            "grant_type" => "authorization_code",
            "response_type" => "token"
        ]);

        $data = $response->json();
        $this->token = $data['access_token'] ?? $this->token;
        $serviceInfo = $this->service->showByName($this->nameService);

        $now = Carbon::now();
        $expires_at = $now->modify("+" . $data['expires_in'] . "seconds");

        $request = new Request([
            "code" => $this->code,
            "token" => $this->token,
            "expires_at" => $expires_at,
        ]);
        $this->service->update($request, $serviceInfo);
        return $response->json();
    }

    public function sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $text) {
        $message = "From: $fromName <$fromEmail>\n";
        $message .= "To: $toName <$toEmail>\n";
        $message .= "Subject: $subject\n\n";
        $message .= $text;
        $messageBase64 = base64_encode($message);

        $url = 'https://gmail.googleapis.com/gmail/v1/users/deybic9715%40gmail.com/messages/send';
        $headers = [
            "Authorization" => "Bearer $this->token",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ];
        $data = [
            "raw" => $messageBase64,
        ];

        $response = Http::withHeaders($headers)->post($url, $data);

        return $response;
    }
}
