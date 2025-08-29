<?php

namespace App\Http\Controllers;

use App\Models\EmailQueue;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function dashBoard()
  {
    $subscribersCount = Subscriber::count();
    $emailQueue = EmailQueue::query();
    $failedEmails = (clone $emailQueue)->where('status', 'failed')->count();
    $succeedEmails = (clone $emailQueue)->where('status', 'sent')->count();

    return view('dashboard', compact(
      'subscribersCount',
      'failedEmails',
      'succeedEmails'
    ));
  }
}
