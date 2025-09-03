<?php

use App\Models\User;
use App\Mail\LoginMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SendEmailsController;
use App\Models\Newsletter;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashBoard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([], function () {

  Route::get('/send-emails', [SendEmailsController::class, 'sendEmails']);
  Route::post('/send-emails', [SendEmailsController::class, 'send'])->name('sendemails');
  Route::get('newsletter/{newsletter}',[DashboardController::class,'showNewsletter'])->name('newsletter.show');
  Route::post('/emails/{newsletter}/retry', [SendEmailsController::class, 'retryAll'])->name('email.retry');

});


require __DIR__ . '/auth.php';
