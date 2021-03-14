<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;
    protected $table = 'subcategories';
    protected $fillable = ['category_id','name','slug','photo','status','detail_desc','seo_check','meta_title','meta_tag','meta_desc'];

        public function category()
    {
    	return $this->belongsTo('App\Models\Category','category_id','id');
    }
        public function childs()
    {
    	return $this->hasMany('App\Models\Childcategory','subcategory_id')->where('status','=',1);
    }
}
