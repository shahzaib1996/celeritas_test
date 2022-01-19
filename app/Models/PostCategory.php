<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    public function posts(){
        return $this->hasMany('App\Models\Post','category_id');
    }

}
