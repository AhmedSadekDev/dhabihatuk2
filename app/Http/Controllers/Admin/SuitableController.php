<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suitable\AddRequest;
use App\Http\Requests\Suitable\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Suitable;
use Illuminate\Http\Request;

class SuitableController extends Controller
{
    use ImagesTrait;
    private $suitableModel;
    public function __construct(Suitable $suitable)
    {
        $this->suitableModel = $suitable;
    }
    public function index($status)
    {
        $suitables = $this->suitableModel->where('status', $status)->latest()->paginate(10);
        return view('admin.suitables.index', compact('suitables', 'status'));
    }
    public function addSuitable()
    {
        return view('admin.suitables.create');
    }
    public function store(AddRequest $request)
    {
        $imageName = time() . 'suitables.' . $request->image->extension();
        $this->uploadImage($request->image, $imageName, 'suitables');

        $this->suitableModel->create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'lat' => $request->lat,
            'long' => $request->long,
            'address' => $request->address,
            'time' => $request->time,
            'date' => $request->date,
            'image' => $imageName,
            'show' => ($request->show) ? 1 : 0,
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('suitables', 0))->with('message', __('messages.add_suitable'));
    }

    public function edit($id)
    {
        $suitable = $this->suitableModel->findOrFail($id);
        return view('admin.suitables.edit', compact('suitable'));
    }
    public function update(UpdateRequest $request)
    {
        $suitable = $this->suitableModel->findOrFail($request->suitable_id);
        if ($request->image) {
            $imageName = time() . 'suitables.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'suitables');
        } else {
            $imageName = $suitable->image;
        }
        $suitable->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'lat' => $request->lat,
            'long' => $request->long,
            'address' => $request->address,
            'time' => $request->time,
            'date' => $request->date,
            'image' => $imageName,
        ]);

        return redirect(route('suitables', $suitable->status))->with('message', __('messages.edit_suitable'));
    }
    public function verify(Request $request)
    {
        $new = $this->suitableModel->findOrFail($request->suitable_id);

        $new->update([
            'show' => ($new->show == 1) ? 0 : 1,
        ]);

        return back()->with('success', ($new->show == 1) ? __('messages.show_suitable') : __('messages.hide_suitable'));
    }

    public function delete(Request $request)
    {
        $this->suitableModel::where('id', $request->new_id)->delete();
        return back()->with('message', __('messages.delete_suitable'));
    }

    public function accepet($id)
    {
        $this->suitableModel::where('id', $id)->update(['status' => 1]);
        return back()->with('message', __('messages.accepet_suitable'));
    }
    public function rejecet($id)
    {
        $this->suitableModel::where('id', $id)->update(['status' => 2]);
        return back()->with('message', __('messages.rejecet_suitable'));
    }
}
