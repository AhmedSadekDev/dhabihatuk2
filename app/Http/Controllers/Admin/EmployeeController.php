<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\AddRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use ImagesTrait;
    private $employeeModel, $roleModel;
    public function __construct(User $employee, Role $role)
    {
        $this->employeeModel = $employee;
        $this->roleModel = $role;
    }
    public function index()
    {
        $users = $this->employeeModel->RoleId()->paginate(10);
        return view('admin.employee.index', compact('users'));
    }

    public function searchEmployee(Request $request)
    {
        $users = $this->employeeModel->where('name', 'LIKE', '%' . $request->search . '%')->RoleId()->paginate(10);
        return view('admin.employee.index', compact('users'));
    }

    public function addEmployee()
    {
        $roles = $this->roleModel->Roles()->get();
        return view('admin.employee.create', compact('roles'));
    }

    public function store(AddRequest $request)
    {
        $this->employeeModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect(route('employee'))->with('message', __('messages.addEmployee'));
    }

    public function verify(Request $request)
    {
        $admin = $this->employeeModel->findOrFail($request->admin_id);

        $admin->update([
            'status' => ($admin->status == 1) ? 0 : 1,
        ]);

        session()->flash('message', ($admin->status == 1) ? __('messages.verify_employee') : __('messages.notverify_employee'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $employee = $this->employeeModel->findOrFail($id);
        $roles = $this->roleModel->Roles()->get();
        return view('admin.employee.edit', compact('employee', 'roles'));
    }

    public function update(UpdateRequest $request)
    {
        $employee = $this->employeeModel::findOrFail($request->admin_id);
        ($request->password) ? $password = Hash::make($request->password) : $password = $employee->password;
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $password,
        ]);
        return redirect(route('employee'))->with('message', __('messages.update_employee'));
    }

    public function delete(Request $request)
    {
        $this->employeeModel::where('id', $request->admin_id)->delete();
        return back()->with('message', __('messages.delete_employee'));
    }
}
