<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    protected $fillable = [
        'title',
        'text',
        'type',
    ];

    /**
     * @param $type
     * @return string
     */
    public function getScripts($type) {
        $result = "";

        foreach ($this->where('type',(string)$type)->get() as $script) {

            $result .= "\n<!-- Start ".$script->title." -->\n";
            $result .= $script->text;
            $result .= "\n<!-- End ".$script->title." -->\n";
        }

        return $result;
    }
}
