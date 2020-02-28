<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name', 'category_description', 'status'];
    public $timestamps = false;

    public function posts()
    {
    	return $this->hasMany('App\Post', 'id');
    }
}
