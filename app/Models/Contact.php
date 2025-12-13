<?php

namespace App\Models;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     protected $fillable = ['id','name','email','phone','title','text','client_id'];

     public function client()
    {
        return $this->belongsTo(Client::class);
    }
}