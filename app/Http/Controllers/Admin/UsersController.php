<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {

        $search = $request->input('search');

        $users = null;
        if($search) {
            $users = $user->getUsersBySearch($search)->paginate(config('settings.paginate_admin'));
        }
        else {
            $users = User::paginate(config('settings.paginate_admin'));
        }

        /** @var String $title */
        $this->title = __("admin.users_title");

        /** @var String $content */
        $content = view('administrator::include.users')->with(['users' => $users, 'title' => $this->title, 'search' => $search])->render();
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
        /** @var String $title */
        $this->title = "Create User";

        /** @var Role $roles */
        $roles = Role::all();

        /** @var String $content */
        $content = view('administrator::include.users-form')->with(['title' => $this->title,'roles' => $roles])->render();
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
    public function store(UserRequest $request)
    {
        /** @var User $user */
        $user = new User();
        //store model
        $user->fill($request->except('_token','role_id','password'));
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->roles()->attach($request->input('role_id'));


        /** @return Redirect */
        return \Redirect::route('users.index')
            ->with(
                [
                    'message' => \trans('admin.users_create_success_message'),
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
    public function edit(User $user)
    {
        /** @var String $title */
        $this->title = "Create User";

        $roles = Role::all();

        /** @var String $content */
        $content = view('administrator::include.users-form')->with(['title' => $this->title,'roles' => $roles,'user' => $user])->render();
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
    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->except('_token', 'password', 'role_id'));
        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if($user->save()) {
            $user->roles()->sync($request->input('role_id'));

            /** @return Redirect */
            return \Redirect::route('users.index')
                ->with(
                    [
                        'message' => \trans('admin.users_update_success_message'),
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
    public function destroy(User $user)
    {
        $user->status = 3;
        $user->save();

        /** @return Redirect */
        return \Redirect::route('users.index')
            ->with(
                [
                    'message' => \trans('admin.users_delte_success_message'),
                    'status' => 'success',
                ]
            );
    }

}
