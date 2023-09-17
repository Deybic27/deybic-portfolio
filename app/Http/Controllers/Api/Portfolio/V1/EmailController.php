<?php

namespace App\Http\Controllers\Api\Portfolio\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GmailController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    /**
     * Gmail controller.
     * 
     * @var App\Http\Controllers\GmailController
     */
    protected $gmail;

    /**
     * Construct function.
     */
    public function __construct()
    {
        $this->gmail = new GmailController;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmailContact(Request $request) {
        $fromName = $request->fromName;
        $fromEmail = $request->fromEmail;
        $toName = "Deybic Rojas";
        $toEmail = "deybic9715@gmail.com";
        $subject = $request->subject;
        $text = $request->text 
        . "\nFrom: " . $fromName
        . " <" . $fromEmail
        . ">\nTo: " . $toName
        . " <" . $toEmail
        . ">";
        $response = $this->gmail->sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $text);
        return new Response($response->json(), $response->status());
    }
}
