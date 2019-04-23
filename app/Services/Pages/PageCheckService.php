<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 09-Nov-18
 * Time: 10:10
 */

namespace App\Services\Pages;


use Illuminate\Support\Facades\Facade;

class PageCheckService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pageCheck';
    }
}