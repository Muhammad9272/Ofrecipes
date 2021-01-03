<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['recipe_id','name','email','review','rating','status'];


    public static function ratings($recipeid){
        $stars = Rating::where('recipe_id',$recipeid)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '')*20;
        return $ratings;
    }
    public static function rating($recipeid){
        $stars = Rating::where('recipe_id',$recipeid)->avg('rating');
        $stars = number_format((float)$stars, 1, '.', '');
        return $stars;
    }
     public function replies()
    {
        return $this->hasMany('App\Models\Reply','rating_id');
    }
     public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe','recipe_id','id');
    }



}
