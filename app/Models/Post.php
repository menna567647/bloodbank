<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['id', 'title', 'content', 'images', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function favoredByClients()
    {
        return $this->belongsToMany(Client::class, 'client_post', 'post_id', 'client_id')
            ->withPivot('is_favorite')
            ->withTimestamps();
    }
}
