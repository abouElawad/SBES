<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Jobs\NewsletterEmail;
use App\Http\Requests\NewsletterRequest;
use RealRashid\SweetAlert\Facades\Alert;


class SendEmailsController extends Controller 
{
    public function sendEmails()
    {
      return view('sendemails');
    }

    public function send(NewsletterRequest $request)
    {
      $batches = Subscriber::limit(10)->pluck('email')->chunk(2);
      $requestData = $request->only(['body', 'subject']); 
    $senderEmail = auth()->user()->email;
    $delay = 0;
    
    $newsLetter = Newsletter::create($request->validated());
    foreach ($batches as $emails) {
      foreach($emails as $email)

              NewsletterEmail::dispatch($email, $senderEmail,$requestData,$newsLetter)
                                    ->delay(now()->addSeconds($delay));
              $delay+=10;
    }
    // Alert::success('success', 'Newsletter sent ');
    return to_route('dashboard');
     
    }
    
}
