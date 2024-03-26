<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wrapping\AddRequest;
use App\Http\Requests\Wrapping\UpdateRequest;
use App\Models\Wrapping;
use Illuminate\Http\Request;

class WrappingController extends Controller
{
    public function index()
    {
        $Wrappings = Wrapping::latest()->paginate(10);
        return view('admin.wrapping.index', compact('Wrappings'));
    }
    public function addWrapping()
    {
        return view('admin.wrapping.create');
    }
    public function store(AddRequest $request)
    {
        Wrapping::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => ($request->show) ? 1 : 0,
        ]);
        return redirect()->route('Wrapping')->with('success', __('messages.addWrapping'));
    }

    public function edit($id)
    {
        $wrapping = Wrapping::findOrFail($id);
        return view('admin.wrapping.edit', compact('wrapping'));
    }
    public function update(UpdateRequest $request)
    {
        $Wrapping = Wrapping::findOrFail($request->Wrapping_id);
        $Wrapping->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);
        return redirect()->route('Wrapping')->with('success', __('messages.editWrapping'));
    }
    public function delete(Request $request)
    {
        $Wrapping = Wrapping::findOrFail($request->Wrapping_id);
        $Wrapping->delete();
        return back()->with('success', __('messages.deleteWrapping'));
    }
    public function verify(Request $request)
    {
        $Wrapping = Wrapping::findOrFail($request->Wrapping_id);
        $Wrapping->update([
            'status' => ($Wrapping->status == 1) ? 0 : 1,
        ]);
        return back()->with('success', ($Wrapping->status == 1) ? __('messages.showWrapping') : __('messages.hideWrapping'));
    }
}
