<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['id', 'donation_id', 'client_id','reason','message'];

    public function donation(){
        return $this->belongsTo(Donation::class);
    }

     public function client(){
        return $this->belongsTo(Client::class);
    }
}
