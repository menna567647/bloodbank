<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $fillable = array('id','phone', 'email', 'fb_url', 'x_url', 'app_store_url', 'about_app');

}