<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['category_id', 'user_id', 'title', 'body', 'file'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function comments()
    {
    	return $this->hasMany('App\Comment', 'post_id', 'id');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }
    public function likes()
    {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }
}
