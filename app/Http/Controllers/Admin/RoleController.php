<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AddRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleModel;
    public function __construct(Role $role)
    {
        $this->roleModel = $role;
    }
    public function index()
    {
        $roles = $this->roleModel::where('id', '!=', 4)->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function addRole(Role $role)
    {
        $permissions = $role->getPermissions();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(AddRequest $request, Role $role)
    {
        $permissions = config('trans_ar.premissions');
        $data = $role->getPermissionsEn();
        $permission_arData = $role->getPermissionsAr($data, $permissions, $request);

        $this->roleModel::create([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'permissions' => json_encode($request->permissions),
            'permission_ar' => $permission_arData,
        ]);

        return redirect(route('roles'))->with('message', __('messages.addRole'));
    }

    public function edit($id, Role $role)
    {
        $role = $this->roleModel::findOrFail($id);
        $roles = $role->getPermissions();
        $permissions = $role->getRoles();
        return view('admin.roles.edit', compact('role', 'roles', 'permissions'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $permissions = config('trans_ar.premissions');
        $data = $role->getPermissionsEn();
        $permission_arData = $role->getPermissionsAr($data, $permissions, $request);
        $this->roleModel::where('id', $request->role_id)->update([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'permissions' => json_encode($request->permissions),
            'permission_ar' => $permission_arData,
        ]);

        return redirect(route('roles'))->with('message', __('messages.updateRole'));
    }

    public function delete(Request $request)
    {
        $this->roleModel::where('id', $request->admin_id)->delete();
        return back()->with('message', __('messages.deleteRole'));
    }
}
