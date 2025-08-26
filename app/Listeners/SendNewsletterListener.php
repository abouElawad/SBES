<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\LoginMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendNewsletterListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(public Request $request)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $emails = User::limit(5)->pluck('email')->toArray();
       foreach($emails as $email){
         Mail::to($email)->send(new LoginMail($this->request));
       }
    }
}
