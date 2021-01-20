<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['blog_id','name','email','comment','status'];
    public function Blog()
    {
    	return $this->belongsTo('App\Models\Article');
    }
}
