<?php

namespace App\Http\Controllers\Api\Portfolio\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\PostCategoriesController;
use App\Mail\ContactEmail;

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
        // dd($request->fromName, $request->fromEmail);
        try {
            Mail::to("contacto@deybicrojas.com")->send(new ContactEmail($request->fromName, $request->fromEmail, $request->subject, $request->text));
        } catch (\Throwable $th) {
            return new Response("Service Unavailable", 503);
        }
        return new Response("E-mail sent", 200);
        // $fromName = $request->fromName;
        // $fromEmail = $request->fromEmail;
        // $toName = "Deybic Rojas";
        // $toEmail = "deybic9715@gmail.com";
        // $subject = $request->subject;
        // $text = $request->text 
        // . "\nFrom: " . $fromName
        // . " <" . $fromEmail
        // . ">\nTo: " . $toName
        // . " <" . $toEmail
        // . ">";
        // $response = $this->gmail->sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $text);
        // return new Response($response->json(), $response->status());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmailSmtp(Request $request) {
        // dd($request);
        
    }
}
