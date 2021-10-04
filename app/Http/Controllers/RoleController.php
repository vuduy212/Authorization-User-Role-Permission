<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->role->search($request->all());
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('role.create'))
        {
            return redirect(route('roles.index'));
        }
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $this->role->saveRole($request);
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        if(Gate::denies('role.view'))
        {
            return redirect(route('roles.view'));
        }
        $permissions = Permission::all();

        return view('admin.roles.show')->with([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if(Gate::denies('role.update'))
        {
            return redirect(route('roles.index'));
        }
        $permissions = Permission::all();

        return view("admin.roles.edit")->with([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);

        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if(Gate::denies('role.update'))
        {
            return redirect(route('roles.index'));
        }
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index');
    }
}
