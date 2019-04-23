<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 09-Nov-18
 * Time: 10:10
 */

namespace App\Services\Pages;


use Route;

class PageCheck
{
    /**
     * Check type static page
     *
     * @return bool
     */
    public static function isPage($str_dt = 'home')
    {
        //check page by route name and route parameters

        if (Route::currentRouteName() == 'public-pages' && Route::current()->parameter('alias') == $str_dt) {
            return true;
        }
        return false;
    }

    public static function checkRouteName($routeName = 'home')
    {
        //check page by route name and route parameters

        if (Route::currentRouteName() == $routeName) {
            return true;
        }
        return false;
    }
}