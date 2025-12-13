<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Governrate extends Model
{
    protected $fillable = ['id', 'name'];

    public function cities()
    {
        return $this->hasMany(City::class, 'governrate_id');
    }

}
