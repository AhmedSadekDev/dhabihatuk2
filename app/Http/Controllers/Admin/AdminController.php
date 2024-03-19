<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\AddRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Cemeteries;
use App\Models\Contact;
use App\Models\DeadInformation;
use App\Models\Grave;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use ImagesTrait;
    private $employeeModel, $roleModel, $missionModel, $companyModel;
    public function __construct(User $employee, Role $role)
    {
        $this->employeeModel = $employee;
        $this->roleModel = $role;
    }
    public function index()
    {
        $admins = $this->employeeModel->where(function ($query) {
            $query->where('role_id', '!=', 1)->where('role_id', '!=', 2);
        })->count();
        $employees = $this->employeeModel->where('role_id', 2)->count();
        $dead_information = 0;
        $graves = 0;
        $contact = Contact::count();
        return view('admin.index', compact('admins', 'employees', 'dead_information', 'graves', 'contact'));
    }
    public function indexAdmins()
    {
        $admins = $this->employeeModel->RoleIdAdmin()->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    public function addAdmin()
    {
        return view('admin.admins.create');
    }

    public function store(AddRequest $request)
    {
        $this->employeeModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        return redirect(route('admins'))->with('message', __('messages.add_admin'));
    }

    public function verify(Request $request)
    {
        $admin = $this->employeeModel->findOrFail($request->admin_id);

        $admin->update([
            'status' => ($admin->status == 1) ? 0 : 1,
        ]);

        session()->flash('message', ($admin->status == 1) ? __('messages.verify_admin') : __('messages.not_active_admin'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $admin = $this->employeeModel->findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
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
        return redirect(route('admins'))->with('message', __('messages.update_admin'));
    }

    public function delete(Request $request)
    {
        $this->employeeModel::where('id', $request->admin_id)->delete();
        return back()->with('message', __('messages.delete_admin'));
    }
}
