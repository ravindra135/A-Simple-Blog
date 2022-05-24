<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
//        User::create($request->all());
//        return back();

        $input = $request->all();

        if($file = $request->file('photo_id')) {

            $name = time() . '_' . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        } else {

            $default = Photo::where(['file'=>'def_avatar.png'])->first();
            $input['photo_id'] = $default->id;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);

        Session::flash('user_created', '' . $input['name'] . ' has Been Created');

        return redirect(route('users.index'));
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

        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == '') {

            $input = $request->except('password');

        } else {

            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photo_id')) {

            $name = time() . '_' . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        $user->update($input);

        Session::flash('user_created', 'Profile of ' . $user->name . ' has Been Updated');

        return redirect(route('users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path() . $user->photo->file);
        $user->photo->delete();
        $user->delete();

        Session::flash('user_deleted', '' . $user->name . ' has Been Deleted');

        return redirect(route('users.index'));
    }
}
