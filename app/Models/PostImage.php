<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImagePathAttribute($value){
        if($value){
            return asset('storage/' . $value);
        }
        return $value;
    }

}
