<?php

namespace App\Http\Controllers;

use App\Models\EmailQueue;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function dashBoard()
  {
    $subscribersCount = Subscriber::count();
    $emailQueue = EmailQueue::query();
    $allEmails = (clone $emailQueue)->count();
    $PendingEmails = (clone $emailQueue)->where('status', 'pending')->count();
    $processingEmails = (clone $emailQueue)->where('status', 'processing')->count();
    $failedEmails = (clone $emailQueue)->where('status', 'failed')->count();
    $succeedEmails = (clone $emailQueue)->where('status', 'sent')->count();

    $newsLetters = Newsletter::latest()->limit(3)->get();
    return view('dashboard', compact(
      'subscribersCount','allEmails',
      'failedEmails','PendingEmails','processingEmails',
      'succeedEmails','newsLetters'
    ));
  }

  public function showNewsletter(Newsletter $newsletter)
  {
    $newsletter =  $newsletter->load([
        'emailQueue' => function ($query) {
            $query->wherein('status', ['pending','sent','failed'])->with('subscriber');
        }
    ]);
    $emailQueues = $newsletter->emailQueue()
        ->with('subscriber') // eager load subscriber
        ->paginate();

        
    return view('newsletter.show',compact('newsletter','emailQueues'));
  }
}
