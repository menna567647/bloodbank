<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     protected $fillable = ['id','title','message','donation_id'];

   public function clients()
   {
    return $this->belongsToMany(Client::class, 'client_notification', 'notification_id', 'client_id')
                ->withPivot('is_read')
                ->withTimestamps();
    }

        public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
