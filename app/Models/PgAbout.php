<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgAbout extends Model
{
    protected $fillable = ['title','summary','slug','photo','desc','seo_check','meta_title','meta_tag','meta_desc','status'];
}
