<?php

namespace App\Http\Controllers\Pub;

use App\Models\Page;
use App\Models\Script;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    //var for template
    protected $vars = array();
    //var for title page
    protected $title = FALSE;

    protected $description = FALSE;
    //var for template
    protected $template = FALSE;

    protected $script = null;

    public function __construct(Script $script) {

        $this->script = $script;
        $this->template = 'public::pages';
    }

    /**
     * @return $this
     */
    protected function renderOutput() {

        //add title
        $this->vars = array_add($this->vars,'title', $this->title);
        //add description
        $this->vars = array_add($this->vars,'description', $this->description);

        $this->vars = array_add($this->vars,'headScripts', $this->script->getScripts(1));
        $this->vars = array_add($this->vars,'bodyScripts', $this->script->getScripts(2));
        //render view
        return view($this->template)->with($this->vars);
    }
}
