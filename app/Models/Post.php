<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
        'category_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\PostCategory','category_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\PostComment','post_id');
    }

    public function images(){
        return $this->hasMany('App\Models\PostImage','post_id');
    }

}
