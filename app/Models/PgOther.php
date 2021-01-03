<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgOther extends Model
{
	
     protected $fillable = ['title','slug','desc','seo_check','meta_title','meta_tag','meta_desc','status'];
}
