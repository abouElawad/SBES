<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
   use HasFactory , Notifiable;
   protected $fillable=['subject','body'];
   public $timestamps = false;
    protected $dates = ['created_at'];

    public function emailQueue()
    {
      return $this->hasMany(EmailQueue::class);
    }
   

}
