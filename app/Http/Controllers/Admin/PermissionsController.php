<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends AdminController
{
    /**
     * AdminController constructor.
     */
    public function __construct() {
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $roles */
        $roles = Role::all();

        /** @var Collection $permissions */
        $permissions = Permission::all();

        /** @var String $title */
        $this->title = __("admin.pages_permissions_title");

        /** @var String $content */
        $content = view('administrator::include.permissions')->with(['roles' => $roles, 'priv' => $permissions, 'title' => $this->title])->render();
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
    public function store(Request $request)
    {
        //
        $this->authorize('create', Role::class);

        $data = $request->except('_token');

        $roles = Role::all();

        foreach($roles as $value) {
            if(isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            }

            else {
                $value->savePermissions([]);
            }
        }

        // redirect back to page
        return \back()
            ->with(
                [
                    'message' => \trans('admin.pages_update_success_message'),
                    'status' => 'success',
                ]
            );
    }

}
