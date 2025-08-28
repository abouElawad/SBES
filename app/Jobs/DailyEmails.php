<?php

namespace App\Jobs;

use App\Mail\LoginMail;
use App\Models\EmailQueue;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DailyEmails implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  protected EmailQueue $emailQueue;

   public $tries = 5;

  /**
   * Create a new job instance.
   */

  public function __construct(public string $email, public string $senderEmail, public array  $requestData, protected Newsletter $newsLetter)
  {
    
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    //  dd( $this->newsLetter->id,Subscriber::where('email', $this->email)->value('id'));
    $this->emailQueue = EmailQueue::create(
      [
        'newsletter_id' => $this->newsLetter->id,
        'subscriber_id' => Subscriber::where('email', $this->email)->value('id'),
        'status' => 'processing',
      ]
    );
    

      Mail::to($this->email)->send(new LoginMail($this->requestData, $this->senderEmail));
      $this->emailQueue->update(['status' => 'sent']);
  
  
dd( $this->emailQueue->status);
  
}

public function failed(\Throwable $exception)
  {
    $this->emailQueue->increment('attempts');

    if ($this->emailQueue->attempts >= 3) {
      $this->emailQueue->update([
        'status' => 'failed',
        'last_error' => $exception->getMessage(),
      ]);
    } else {
      $this->release(300); // retry after 5 minutes
    }
  }
}