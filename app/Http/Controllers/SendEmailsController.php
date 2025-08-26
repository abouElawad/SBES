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
      // $emails = User::limit(500)->chunk(40)->pluck('email')->toArray();
      $batches = User::limit(500)->pluck('email')->chunk(45);
    
    $requestData = $request->only(['body', 'title']); 
    $senderEmail = auth()->user()->email;
    $delay = 0;

    foreach ($batches as $emails) {
              
               DailyEmails::dispatch($emails->toArray(), $senderEmail,$requestData) ->delay(now()->addSeconds($delay));
               $delay+=10;
    }
     
    return to_route('dashboard');
     
    }
}
