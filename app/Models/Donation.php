<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
     protected $fillable = ['id','patient_name','patient_age','patient_phone','blood_type_id','number_of_bags','city_id','hospital_name','notes','client_id','status','is_spam'];

     public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

     public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

        public function reports()
    {
        return $this->hasMany(Report::class);

    }
}
