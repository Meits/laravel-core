<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AdminController
{
    /**
     * AdminController constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var String $template */
        $this->template = 'administrator::home';

        /** @var String $title */
        $this->title = __("admin.pages_home_title");
        /** @var String $content */
        $content = view('administrator::include.home')->with(['title' => $this->title])->render();
        $this->vars = array_add($this->vars,'content', $content);

        //render output
        return $this->renderOutput();
    }
}
