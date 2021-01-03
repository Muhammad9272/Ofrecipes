<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['name','email','rating_id','text'];
    
    public function rating()
    {
    	return $this->belongsTo('App\Models\Rating');
    }

}
