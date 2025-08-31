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

class NewsletterEmail implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  public $tries = 3;
  // public $backoff = 10; //how long to wait before retrying.
  // public $timeout = 120; //max execution time in seconds for the job.
  /**
   * Create a new job instance.
   */

  public function __construct(public string $email, public string $senderEmail, public array  $requestData, protected Newsletter $newsLetter, public ?int $emailQueueId = null)
  {
    if (!$this->emailQueueId) {
      $emailQueue = EmailQueue::firstOrCreate(
        [
          'newsletter_id' => $newsLetter->id,
          'subscriber_id' => Subscriber::where('email', $this->email)->value('id'),
        ],
        [
          'status' => 'pending',
          'attempts' => 0
        ]
      );
      $this->emailQueueId = $emailQueue->id;
    }
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    $emailQueue = EmailQueue::find($this->emailQueueId);
    try{
      Mail::to($this->email)->send(new LoginMail($this->requestData, $this->senderEmail));
      //  dd($r->getMessageId());
    $emailQueue->update(['status' => 'sent']);
    }catch(\Throwable $exception){
      $emailQueue->increment('attempts');
      $emailQueue->update(['status' => 'processing',
                                       
                                        'last_error' => $exception->getMessage(),
                                      ]);

                                      throw $exception; 
    }
  
  }

  public function failed(\Throwable $exception)
  {
    $emailQueue = EmailQueue::find($this->emailQueueId);
    $emailQueue->update([
     
      'status' => 'failed',
      'last_error' => $exception->getMessage(),
    ]);
  }
}
