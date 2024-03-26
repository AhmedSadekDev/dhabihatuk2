<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chopping\AddRequest;
use App\Http\Requests\Chopping\UpdateRequest;
use App\Models\Chopping;
use Illuminate\Http\Request;

class ChoppingController extends Controller
{
    public function index()
    {
        $choppings = Chopping::latest()->paginate(10);
        return view('admin.chopping.index', compact('choppings'));
    }
    public function addChopping()
    {
        return view('admin.chopping.create');
    }
    public function store(AddRequest $request)
    {
        Chopping::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => ($request->show) ? 1 : 0,
        ]);
        return redirect()->route('Chopping')->with('success', __('messages.addChopping'));
    }

    public function edit($id)
    {
        $chopping = Chopping::findOrFail($id);
        return view('admin.chopping.edit', compact('chopping'));
    }
    public function update(UpdateRequest $request)
    {
        $chopping = Chopping::findOrFail($request->chipping_id);
        $chopping->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);
        return redirect()->route('Chopping')->with('success', __('messages.editChopping'));
    }
    public function delete(Request $request)
    {
        $chopping = Chopping::findOrFail($request->chopping_id);
        $chopping->delete();
        return back()->with('success', __('messages.deleteChopping'));
    }
    public function verify(Request $request)
    {
        $chopping = Chopping::findOrFail($request->chopping_id);
        $chopping->update([
            'status' => ($chopping->status == 1) ? 0 : 1,
        ]);
        return back()->with('success', ($chopping->status == 1) ? __('messages.showChopping') : __('messages.hideChopping'));
    }
}
