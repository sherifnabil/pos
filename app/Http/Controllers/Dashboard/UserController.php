<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Validation\Rule;
use Storage;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function($query) use($request){

            return $query->when($request->search, function($q) use ($request){

                return $q->where('first_name', 'like', '%' . $request->search .'%')
                        ->orWhere('last_name', 'like', '%' . $request->search .'%');

            });
        })->latest()->paginate(5);

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
            'email'                     =>   'required|email:unique:users',
            'image'                     =>   'required|image|mimes:jpg,png,jpeg,gif',
            'permissions'               =>   'required|min:1',
            'password'                  =>   'required|min:6|confirmed',
            'password_confirmation'     =>   'required',
        ]);
        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);

        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $request_data['password'] = bcrypt($request->password);
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));

    }


    public function update(Request $request, User $user)
    {
        $this->validate(request(),[
            'first_name'                =>   'required',
            'last_name'                 =>   'required',
            'email'                     =>   ['required' , Rule::unique('users')->ignore($user->id),],
            'permissions'               =>   'required|min:1',
            'image'                     =>   'sometimes|nullable',

        ]);
        $request_data = $request->except([ 'permissions', 'image']);

        if ($request->image) {

            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('//user_images/' . $user->image);

            }//end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of external ifs

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
      }


    public function destroy(User $user)
    {
        if($user->image != '4.png'){
            Storage::disk('public_uploads')->delete('//user_images/' . $user->image );
        }
        $user->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}//end of controller
