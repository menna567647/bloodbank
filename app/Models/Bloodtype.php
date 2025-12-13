<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Bloodtype extends Model
{
    protected $table = 'blood_types';

    protected $fillable = ['id','name'];

    public function clients()
    {
        return $this->hasMany(Client::class, 'blood_type_id');
    }
}
