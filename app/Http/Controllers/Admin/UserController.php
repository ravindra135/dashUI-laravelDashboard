<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasRoles;

    function __construct()
    {
        $this->middleware('role_or_permission:SuperAdmin|User access|User create|User edit|User delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:SuperAdmin|User create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:SuperAdmin|User edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:SuperAdmin|User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            foreach ($user->roles as $role){
                if ($role->name == 'SuperAdmin' ) {
                    $adminId = $user->id;
                }
            }
        }

        $users = User::whereNotIn('id', [$adminId])->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request, FlasherInterface $flasher)
    {
        $inputs = $request->all();
        $user = User::create($inputs);

        if($inputs['role'] != 0 ) {
            $user->syncRoles($request->role);
        } else {
            $user->assignRole('User');
        }

        $flasher->addSuccess('User Created', 'Dash UI');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);

        // If User Role is SuperAdmin it will be Redirected;
        foreach ($user->roles as $role){
            if ($role->name == 'SuperAdmin' || auth()->user()->hasRole($role->name)) {
                $flasher->addError('Not Allowed', 'Dash UI');
                return redirect(route('admin.users.index'));
            }
        }

        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);
        $user->username = $request->usermname;
        $userRole = $request->role;
        $inputs = $request->all();

        if($user->isDirty('username')) {
            $user->update([
                'username' => $request->username
            ]);
        }

        $user->syncRoles($userRole);

        $user->update($inputs);
        $flasher->addSuccess('User "'.$user->name.'" updated.', 'Dash UI');
        return redirect(route('admin.users.index'));
    }

    public function passUpdate(Request $request, $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|confirmed|min:5'
        ]);
        $user->password = $request->password;

        if($user->isDirty('password')) {
            $hashPass = bcrypt($request->password);
            $user->update([
                'password' => $hashPass
            ]);
            $flasher->addSuccess('Password Updated');
        }

        return redirect(route('admin.users.index'));
    }

    public function othersUpdate(Request $request, $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);

        $request->validate([
           'phone'      => 'required|numeric|min:11',
        ]);

        $inputs = $request->all();
        $user->phone = $inputs['phone'];

        if ($user->isDirty('phone')) {
            $user->update($inputs);
        } else {
            $user->update([
                'location'  =>  $inputs['location'],
                'about'     =>  $inputs['about']
            ]);
        }

        $flasher->addSuccess('Profile Updated', 'Dash UI');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlasherInterface $flasher, User $user)
    {
        // If User Role is SuperAdmin it will be Redirected;
        foreach ($user->roles as $role){
            if ($role->name == 'SuperAdmin' || auth()->user()->hasRole($role->name)) {
                $flasher->addError('Not Allowed', 'Dash UI');
                return redirect(route('admin.users.index'));
            }
        }

        $user->delete();
        $flasher->addInfo('User Deleted Successfully', 'Dash UI');
        return redirect()->back();
    }
}
