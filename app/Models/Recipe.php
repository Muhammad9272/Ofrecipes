<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['photo','video','video_link','name','slug','summary','pinterest','author_check','author_name','author_link','serving','serving_text','publish_check','publish_date','updated_check','updated_date','post_schedule','prep_days','prep_hours','prep_mins','cook_days','cook_hours','cook_mins','recipes_id','cuisines_id','childcat_id','keywords','equipment','instruction','nutrition','calories','notes','detail_desc','seo_check','meta_title','meta_tag','meta_desc','views','is_featured','is_trending','status'];

    public function ingredients(){
        return $this->hasMany('App\Models\Ingredients');
    }

     public function reviews()
    {
        return $this->hasMany('App\Models\Rating','recipe_id');
    }
}
