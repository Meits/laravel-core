<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Blog extends Model
{
    //
    protected $fillable = [
        'title',
        'titleH1',
        'description',
        'banner',
        'text',
        'alias'
    ];

    public function related()
    {
        return $this->belongsToMany('App\Models\Blog', 'blog_related', 'post_id', 'related_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\BlogComments', 'blog_id', 'id')->orderBy('id', 'DESC');
    }

    public function tips()
    {
        return $this->hasMany('App\Models\BlogTips');
    }

    public function commentsPub()
    {
        return $this->hasMany('App\Models\BlogComments', 'blog_id', 'id')->where('status', '1')->orderBy('id', 'DESC');
    }


    static function scopeBlogs($query)
    {
        return $query->
            orderBy('created_at', 'DESC');
    }

    /**
     * @param $query
     * @return mixed
     */
    static function scopePopular($query)
    {
        return $query->
                orderBy('views', 'DESC')->
                orderBy('created_at', 'DESC')->
                limit(config('settings.blog_popular'));
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        //administrator
        if(Route::current()->getPrefix() == "/administrator") {
            return 'id';
        }
        return 'alias';
    }

}
