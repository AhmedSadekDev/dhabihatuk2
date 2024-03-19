<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AddRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Imports\UsersImport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    use ImagesTrait;
    private $userModel, $roleModel;
    public function __construct(User $employee, Role $role)
    {
        $this->userModel = $employee;
        $this->roleModel = $role;
    }
    public function index()
    {
        $users = $this->userModel->RoleIdUser()->latest()->paginate(10);
        return view('admin.users.clients', compact('users'));
    }
    public function searchUser(Request $request)
    {
        $users = $this->userModel->where('name', 'LIKE', '%' . $request->search . '%')->RoleIdUser()->paginate(10);
        return view('admin.users.clients', compact('users'));
    }

    public function addUser()
    {
        return view('admin.users.create');
    }

    public function store(AddRequest $request)
    {
        if ($request->image) {
            $imageName = time() . 'user.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'users');
        } else {
            $imageName = null;
        }
        $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'role_id' => 4
        ]);

        return redirect(route('users'))->with('message', __('messages.adduser'));
    }

    public function verify(Request $request)
    {
        $admin = $this->userModel->findOrFail($request->user_id);

        $admin->update([
            'status' => ($admin->status == 1) ? 0 : 1,
        ]);

        session()->flash('message', ($admin->status == 1) ? __('messages.verify_user') : __('messages.notverify_user'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = $this->userModel->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateRequest $request)
    {
        $employee = $this->userModel::findOrFail($request->user_id);
        if ($request->image) {
            $imageName = time() . 'user.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'users');
        }
        ($request->password) ? $password = Hash::make($request->password) : $password = $employee->password;
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $password,
            'image' => ($request->image) ? $imageName : "",
        ]);
        return redirect(route('users'))->with('message', __('messages.edit_user'));
    }

    public function delete(Request $request)
    {
        $this->userModel::where('id', $request->user_id)->delete();
        return back()->with('message', __('messages.delete_user'));
    }

    public function accepet($id)
    {
        $this->userModel::where('id', $id)->update(['status' => 1]);
        return back()->with('message', __('messages.accepet_user'));
    }
    public function rejecet($id)
    {
        $this->userModel::where('id', $id)->update(['status' => 2]);
        return back()->with('message', __('messages.rejecet_user'));
    }

    public function importExcel(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            // Get the uploaded file
            $file = $request->file('file');

            // Process the Excel file
            Excel::import(new UsersImport, $file);

            return back()->with('success', __('messages.addExcel'));
        } catch (\Throwable $th) {
            return back()->with('error', __('messages.wrong'));
        }

    }
}
