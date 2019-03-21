<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // TABLE NAME
    protected $table = "posts";
    // PRIMARY KEY
    public $primaryKey = "id";
    // TIMESTAMPS
    public $timestamps = true;
    // CREATE RELATIONSHIP BETWEEN POSTS TABLE AND USER
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function likes(){
        return $this->hasMany('App\Like');
    }
}
