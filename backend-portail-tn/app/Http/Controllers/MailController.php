<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidatMail;

class MailController extends Controller
{
    public function sendCandidatMail(Request $request)
    {
        $title = $request->title;
        $body = $request->body;
        $email = $request->email;
        Mail::to($email)->send(new CandidatMail($body, $title, $email));
        return response()->json(['message' => 'Email sent successfully']);
    }
}
