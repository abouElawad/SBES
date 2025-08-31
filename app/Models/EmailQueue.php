<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{
  protected $fillable = [
    'newsletter_id',
        'subscriber_id',
    'status',
    'attempts',
    'last_error',
    'created_at',
  ];

    public $timestamps = false;
    protected $dates = ['created_at'];

    public function newsletters()
    {
      return $this->belongsTo(Newsletter::class);
    }
    public function subscriber()
    {
      return $this->belongsTo(Subscriber::class);
    }
}
