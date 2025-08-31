<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
  use HasFactory , Notifiable;
      protected $fillable = [
        'name',
        'email',
        
    ];

      public function emailQueues()
    {
      return $this->hasMany(EmailQueue::class);
    }
}
