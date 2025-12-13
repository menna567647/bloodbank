<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read roles')->only(['index']);
        $this->middleware('can:create roles')->only(['create', 'store']);
        $this->middleware('can:update roles')->only(['edit', 'update']);
        $this->middleware('can:delete roles')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $data['guard_name'] = 'web';
        $role = Role::create($data);
        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.index')->with("message", __("messages.CREATEDSUCCESSFULLY"));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data = $request->validated();
        $data['guard_name'] = 'web';

        $role = Role::findOrFail($id);
        $role->update($data);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with("message", __("messages.UPDATEDSUCCESSFULLY"));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Role = Role::findOrFail($id);
        $Role->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
