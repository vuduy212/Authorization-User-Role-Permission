<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Services\PermissionsService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionsService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = $this->permissionService->search($request);
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
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
