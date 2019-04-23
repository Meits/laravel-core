<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'titleH1',
        'description',
        'text',
        'alias',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function datas()
    {
        return $this->hasMany('App\Models\Data');
    }
    public function multifields($alias)
    {
        return $this->hasMany('App\Models\Data')->where('field_id', '=', '9')->where('alias','like', $alias) ;
    }

    public function testimonials() {
        return $this->belongsToMany('App\Models\Testimonial', 'testimonial_position_related', 'page_id')->withPivot('position_id','section_id');
    }

    public function testimonialsForSection($section = 1)
    {
        return $this->testimonials()->wherePivot('section_id', $section)->get();
    }

}
