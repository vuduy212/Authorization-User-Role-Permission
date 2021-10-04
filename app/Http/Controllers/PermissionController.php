<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function __construct(Permission $permissions)
    {
        $this->permissions = $permissions;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = $this->permissions->search($request->all());
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        // if(Gate::denies('permission.view'))
        // {
        //     return redirect(route('permissions.index'));
        // }
        return view('admin.permissions.show')->with([
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::denies('permission.create'))
        // {
        //     return redirect(route('permissions.index'));
        // }
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->permissions->create($request->all());
        return redirect(route('permissions.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        // if(Gate::denies('permission.update'))
        // {
        //     return redirect(route('permissions.index'));
        // }
        return view("admin.permissions.edit")->with([
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permissions)
    {
        $permissions->name = $request->name;
        $permissions->action = $request->action;
        $permissions->save();

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        // if(Gate::denies('permission.delete'))
        // {
        //     return redirect(route('permissions.index'));
        // }
        $permission->delete();

        return redirect()->route('permissions.index');
    }
}
