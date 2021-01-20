<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     protected $fillable = ['category_id','title','slug','photo','image','small_desc','desc','seo_check','meta_title','meta_tag','meta_desc','views','status','publish_check','publish_date','updated_date','post_schedule'];

     public function category()
    {
    	return $this->belongsTo('App\Models\BlogCategory','category_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','blog_id')->where('status',1);
    }
}
