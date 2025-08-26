<?php

namespace App\Jobs;

use App\Mail\LoginMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DailyEmails implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   */
  public function __construct(public array $emails, public string $senderEmail, public array  $requestData)
  {
    //
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    
// $users->chunk(100, fn($users) => SendBatch::dispatch($users));
     Mail::to($this->emails)->send(new LoginMail($this->requestData,$this->senderEmail));
  }
}
