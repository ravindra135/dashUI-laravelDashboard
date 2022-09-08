<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:SuperAdmin|Permission access|Permission create|Permission edit|Permission delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:SuperAdmin|Permission create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:SuperAdmin|Permission edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:SuperAdmin|Permission delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::whereNotIn('name', ['AdminPanel access'])->get();
        return view('admin.permissions.index', compact('permissions'));
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
    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $input['name'] = Str::ucfirst($request->name);

        Permission::create($input);
        $flasher->addSuccess('Permission "'.$request->name. '" Added', 'Dash UI');
        return redirect(route('admin.permissions.index'));
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
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
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

        $request->validate([
            'name' => 'required',
        ]);
        $input['name'] = Str::ucfirst($request->name);

        Permission::findOrFail($id)->update($input);
        $flasher->addInfo('Permission "'.$request->name. '" Updated', 'Dash UI');
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, FlasherInterface $flasher)
    {
        $permission->delete();
        $flasher->addWarning('Permission Deleted', 'Dash UI');
        return redirect(route('admin.permissions.index'));
    }
}
