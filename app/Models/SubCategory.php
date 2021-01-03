<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;
    protected $table = 'subcategories';
    protected $fillable = ['category_id','name','slug','photo','status'];

        public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }
}
