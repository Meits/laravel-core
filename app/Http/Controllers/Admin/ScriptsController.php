<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ScriptRequest;
use App\Models\Script;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScriptsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Script $scripts */
        $scripts = Script::all();

        /** @var String $title */
        $this->title = __("admin.scripts_page_title");

        /** @var String $content */
        $content = view('administrator::include.scripts')->with(['scripts' => $scripts, 'title' => $this->title])->render();
        $this->vars = array_add($this->vars, 'content', $content);

        //render output
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Script::class);

        /** @var String $title */
        $this->title = __("admin.scripts_create_title");

        /** @var String $content */
        $content = view('administrator::include.scripts-form')->with(['title' => $this->title])->render();
        $this->vars = array_add($this->vars, 'content', $content);

        //render output
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScriptRequest $request)
    {
        $this->authorize('create', Script::class);

        $script = new Script();
        //store model
        $script->fill($request->except('_token'))->save();
        return \Redirect::route('scripts.index')
            ->with(
                [
                    'message' => \trans('admin.scripts_update_success_message'),
                    'status' => 'success',
                ]
            );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Script $script)
    {
        /** @var String $title */
        $this->title = __('admin.scripts_update_title');

        /** @var String $content */
        $content = view('administrator::include.scripts-form')->with(['title' => $this->title,'script' => $script])->render();
        $this->vars = array_add($this->vars, 'content', $content);

        //render output
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScriptRequest $request, Script $script)
    {
        $this->authorize('update', Script::class);

        $script->fill($request->except('_token'));

        if($script->save()) {

            /** @return Redirect */
            return \Redirect::route('scripts.index')
                ->with(
                    [
                        'message' => \trans('admin.scripts_update_success_message'),
                        'status' => 'success',
                    ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Script $script)
    {
        $script->delete();

        /** @return Redirect */
        return \Redirect::route('scripts.index')
            ->with(
                [
                    'message' => \trans('admin.scripts_delte_success_message'),
                    'status' => 'success',
                ]
            );
    }
}
