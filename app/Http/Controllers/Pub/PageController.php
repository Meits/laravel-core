<?php

namespace App\Http\Controllers\Pub;

use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends SiteController
{

    /**
     * Show the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($alias = 'home')
    {

        /** @var Page $page */
        $page = Page::where('alias',$alias)->with('datas')->firstOrFail();

        $this->title = $page->title;
        $this->description = $page->description;

        /** @var String $templateStr */
        $templateStr = 'index';

        /** @var String $pageContent */
        $pageContent = "";

        if($page->related_entity) {
            $templateStr = $page->related_entity;

            switch ($page->related_entity) {
                case 'faq':
                    /** @var Array $items */
                    $items = [];
                    $items = Faq::all();

                    $pageContent = view('public::include.content.faq-items')->with(['items' => $items])->render();
                    break;
            }
        }

        if(!(view()->exists('public::include.pages-'. $templateStr))){
            $templateStr = 'index';
        }


        /** @var String $template */
        $template = 'public::include.pages-'. $templateStr;

        /** @var String $content */
        $content = view($template)->with(['page' => $page,'title'=>$this->title,'pageContent'=>$pageContent])->render();
        $this->vars = array_add($this->vars, 'content', $content);

        //render output
        return $this->renderOutput();
    }
}
