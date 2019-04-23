<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 10-Apr-19
 * Time: 09:34
 */

namespace App\Services\Sitemap;


use App\Models\Page;
use Illuminate\Support\Facades\App;
use Laravelium\Sitemap\Sitemap;

class SitemapService
{
    public function renderXml() {

        // create new sitemap object
        /** @var Sitemap $sitemap */
        $sitemap = App::make('sitemap');

        /** @var Page $pages */
        $pages = Page::all();
        foreach ($pages as $page) {
            $sitemap->add(route('public-pages',['alias' => $page->alias]), $page->updated_at, '1.0', 'daily');
        }

        //render content
        return $sitemap->render('xml');
    }
}