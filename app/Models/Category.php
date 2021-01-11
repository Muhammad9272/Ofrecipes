<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = false;
    protected $fillable = ['name','slug','status','detail_desc','seo_check','meta_title','meta_tag','meta_desc'];
        public function subs()
    {
    	return $this->hasMany('App\Models\Subcategory')->where('status','=',1);
    }
}
