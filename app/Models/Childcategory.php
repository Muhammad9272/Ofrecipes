<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    protected $fillable = ['subcategory_id','name','slug','tag','tag_color','mega_image','is_featured','image','status','detail_desc','seo_check','meta_title','meta_tag','meta_desc'];
    public $timestamps = false;

    public function subcategory()
    {
    	return $this->belongsTo('App\Models\Subcategory');
    }


}
