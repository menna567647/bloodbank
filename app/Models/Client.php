<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Bloodtype;
use App\Models\City;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Donation;
use App\Models\Report;

class Client extends Authenticatable implements CanResetPasswordContract
{
    use HasApiTokens, CanResetPasswordTrait, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'password',
        'email',
        'dob',
        'blood_type_id',
        'last_donation_date',
        'city_id',
        'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bloodType()
    {
        return $this->belongsTo(Bloodtype::class, 'blood_type_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function fav()
    {
        return $this->belongsToMany(Post::class, 'client_post', 'client_id', 'post_id')
                    ->withPivot('is_favorite')
                    ->withTimestamps();
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'client_notification', 'client_id', 'notification_id')
                    ->withPivot('is_read')
                    ->withTimestamps();
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function routeNotificationForFcm()
    {
        return $this->getDeviceTokens();
    }

    public function getDeviceTokens()
    {
        return $this->tokens()->pluck('fcm_token')->toArray();

    }

      public function reports()
    {
        return $this->hasMany(Report::class);

    }
}