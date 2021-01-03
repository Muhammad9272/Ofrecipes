<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgFaq extends Model
{
    protected $fillable = ['title','desc','status'];
}
