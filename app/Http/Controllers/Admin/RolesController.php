<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\Url\UrlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Role::class);

        /** @var Collection $roles */
        $roles = Role::all();

        /** @var String $title */
        $this->title = trans("admin.roles_page_title");

        /** @var String $content */
        $content = view('administrator::include.roles')->with(['roles' => $roles, 'title' => $this->title])->render();
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
        $this->authorize('create', Role::class);

        /** @var String $title */
        $this->title = trans("admin.roles_create_title");

        /** @var String $content */
        $content = view('administrator::include.roles-form')->with(['title' => $this->title])->render();
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
    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);

        /** @var Role $role */
        $role = new Role();
        //store model
        $role->fill($request->except('_token','alias'));
        if(!$request->alias) {
            $urlService = new UrlService(new Role());
            $role->alias = $urlService->getAlias($request->title);
        }
        $role->save();

        /** @return Redirect */
        return \Redirect::route('roles.index')
            ->with(
                [
                    'message' => \trans('admin.roles_create_success_message'),
                    'status' => 'success',
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', Role::class);

        /** @var String $title */
        $this->title = trans("admin.roles_update_title");

        /** @var String $content */
        $content = view('administrator::include.roles-form')->with(['title' => $this->title,'role' => $role])->render();
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
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', Role::class);

        $role->fill($request->except('_token', 'alias'));
        if($role->save()) {

            /** @return Redirect */
            return \Redirect::route('roles.index')
                ->with(
                    [
                        'message' => \trans('admin.roles_update_success_message'),
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
    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);

        $role->delete();

        /** @return Redirect */
        return \Redirect::route('roles.index')
            ->with(
                [
                    'message' => \trans('admin.roles_delte_success_message'),
                    'status' => 'success',
                ]
            );
    }
}
