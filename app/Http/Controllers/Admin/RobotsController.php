<?php

namespace App\Http\Controllers\Admin;

use App\Services\File\FileContentService;
use File;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RobotsController extends  AdminController
{
    private $fileService;

    /**
     * RobotsController constructor.
     */
    public function __construct(FileContentService $fileservice)
    {
        $this->fileService = $fileservice;
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var String $content */
        $content = $this->fileService->getFileContent(public_path('robots.txt'));

        /** @var String $title */
        $this->title = __("admin.robots_page_title");

        /** @var String $content */
        $content = view('administrator::include.robots')->with(['content' => $content, 'title' => $this->title])->render();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save content file
        $this->fileService->setFileContent(public_path('robots.txt'), $request->input('content'));

        /** @return Redirect */
        return \Redirect::route('robots.index')
            ->with(
                [
                    'message' => \trans('admin.robots_update_success_message'),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
