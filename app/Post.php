<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'featured', 'category_id', 'slug',
    ];

    protected $dates = ['deleted_at']; //for Soft Deletes

    //Accessor
    public function getFeaturedAttribute($featured){
        return asset($featured);
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
