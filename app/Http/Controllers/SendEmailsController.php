<?php

namespace App\Http\Controllers;

use App\Jobs\DailyEmails;
use App\Models\User;
use App\Mail\LoginMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailsController extends Controller 
{
    public function sendEmails()
    {
      return view('sendemails');
    }

    public function send(Request $request)
    {
      $emails = User::limit(5)->pluck('email')->toArray();

    
    $requestData = $request->only(['body', 'title']); 
    $senderEmail = auth()->user()->email;
    foreach ($emails as $email) {
              
               DailyEmails::dispatch($email, $senderEmail,$requestData);
    }
     

    return to_route('dashboard');
     
    }
}
