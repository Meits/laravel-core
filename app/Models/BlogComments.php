<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'comment',
        'site',
        'photo',
        'blog_id',
        'comment_id',
        'status'
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\BlogComments','comment_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Blog','blog_id');
    }

    public function commentsPub()
    {
        return $this->hasMany('App\Models\BlogComments','comment_id')->where('status','1');
    }
}
