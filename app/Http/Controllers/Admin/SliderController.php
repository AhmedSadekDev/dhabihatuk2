<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sliders\AddRequest;
use App\Http\Requests\Sliders\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImagesTrait;
    private $sliderModel;
    public function __construct(Slider $slider)
    {
        $this->sliderModel = $slider;
    }
    public function index()
    {
        $sliders = $this->sliderModel->latest()->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function addSlider()
    {
        return view('admin.sliders.create');
    }
    public function store(AddRequest $request)
    {
        $imageName = time() . 'slider.' . $request->image->extension();
        $this->uploadImage($request->image, $imageName, 'sliders');

        $this->sliderModel->create([
            'title_ar' => $request->name_ar,
            'title_en' => $request->name_en,
            'image' => $imageName,
            'status' => ($request->show) ? 1 : 0,
        ]);

        return redirect(route('sliders'))->with('message', __('messages.add_slider'));
    }

    public function edit($id)
    {
        $slider = $this->sliderModel->findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }
    public function update(UpdateRequest $request)
    {
        $slider = $this->sliderModel->findOrFail($request->slider_id);
        if ($request->image) {
            $imageName = time() . 'slider.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'sliders');
        } else {
            $imageName = $slider->image;
        }
        $slider->update([
            'title_ar' => $request->name_ar,
            'title_en' => $request->name_en,
            'image' => $imageName,
        ]);
        return redirect(route('sliders'))->with('message', __('messages.edit_slider'));
    }
    /*-----------------------------------------------------------------------------------------------*/

    public function verify(Request $request)
    {
        $slider = $this->sliderModel->findOrFail($request->slider_id);

        $slider->update([
            'status' => ($slider->status == 1) ? 0 : 1,
        ]);

        return back()->with('success', ($slider->status == 1) ? __('messages.show_slider') : __('messages.hide_slider'));
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function delete(Request $request)
    {
        $slider = $this->sliderModel->findOrFail($request->slider_id);
        $slider->delete();

        return back()->with('success', __('messages.delete_slider'));
        ;
    }
}
