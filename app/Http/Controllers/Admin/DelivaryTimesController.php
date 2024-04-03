<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delivary\AddRequest;
use App\Http\Requests\Delivary\UpdateRequest;
use App\Models\DelivayTime;
use Illuminate\Http\Request;

class DelivaryTimesController extends Controller
{
    public function index()
    {
        $delivaryTimes = DelivayTime::latest()->paginate(10);
        return view('admin.delivaryTimes.index', compact('delivaryTimes'));
    }
    public function addTime()
    {
        return view('admin.delivaryTimes.create');
    }
    public function store(AddRequest $request)
    {
        DelivayTime::create([
            'from' => $request->from,
            'to' => $request->to,
            'status' => ($request->show) ? 1 : 0,
        ]);
        return redirect()->route('delivay_times')->with('success', __('messages.addTime'));
    }

    public function edit($id)
    {
        $time = DelivayTime::findOrFail($id);
        return view('admin.delivaryTimes.edit', compact('time'));
    }
    public function update(UpdateRequest $request)
    {
        $chopping = DelivayTime::findOrFail($request->time_id);
        $chopping->update([
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return redirect()->route('delivay_times')->with('success', __('messages.editTime'));
    }
    public function delete(Request $request)
    {
        $chopping = DelivayTime::findOrFail($request->time_id);
        $chopping->delete();
        return back()->with('success', __('messages.deleteChopping'));
    }
    public function verify(Request $request)
    {
        $chopping = DelivayTime::findOrFail($request->time_id);
        $chopping->update([
            'status' => ($chopping->status == 1) ? 0 : 1,
        ]);
        return back()->with('success', ($chopping->status == 1) ? __('messages.showTime') : __('messages.hideTimw'));
    }
}
