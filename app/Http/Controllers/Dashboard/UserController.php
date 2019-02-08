<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {

        $this->validate(request(),[
            'first_name'                =>   'required',
            'last_name'                 =>   'required',
            'email'                     =>   'required|email',
            'password'                  =>   'required|min:6|confirmed',
            'password_confirmation'     =>   'required',
        ]);
        $request_data = $request->except(['password', 'password_confirmation', 'permissions']);
        $request_data['password'] = bcrypt($request->password);
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit');

    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}//end of controller
