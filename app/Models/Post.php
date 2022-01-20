<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STORAGE_IMAGES_PATH = 'posts';
    const STATUS_ACTIVE = 1;
    const DEFAULT_IMAGE_PATH = 'images/default_post.jpg';

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

    public function getPrimaryImages(){
        if( $this->images->count() > 0 ){
            return $this->images->first()->image_path;
        }
        return asset(self::DEFAULT_IMAGE_PATH);
    }

    public function uploadImages($files){
        foreach($files as $eventImage) {
            $path = $eventImage->store(self::STORAGE_IMAGES_PATH, 'public');
            $data = [
                'image_path' => $path
            ];
            $this->images()->create($data);
        }
    }

}
