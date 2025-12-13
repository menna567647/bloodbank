<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Governrate;
use App\Models\Client;

class City extends Model
{
    protected $fillable = ['id', 'name', 'governrate_id'];

    public function governrate()
    {
        return $this->belongsTo(Governrate::class, 'governrate_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'city_id');
    }
}
