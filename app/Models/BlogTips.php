<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTips extends Model
{
    //
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }
}
