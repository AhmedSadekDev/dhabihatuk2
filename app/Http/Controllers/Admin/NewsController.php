<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\AddRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use ImagesTrait;
    private $newModel;
    public function __construct(News $new)
    {
        $this->newModel = $new;
    }
    public function index($status)
    {
        $news = $this->newModel->where('status', $status)->latest()->paginate(10);
        return view('admin.news.index', compact('news', 'status'));
    }
    public function addNews()
    {
        return view('admin.news.create');
    }
    public function store(AddRequest $request)
    {
        $imageName = time() . 'new.' . $request->image->extension();
        $this->uploadImage($request->image, $imageName, 'news');

        $this->newModel->create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'image' => $imageName,
            'show' => ($request->show) ? 1 : 0,
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('news', 0))->with('message', __('messages.add_new'));
    }

    public function edit($id)
    {
        $new = $this->newModel->findOrFail($id);
        return view('admin.news.edit', compact('new'));
    }

    public function update(UpdateRequest $request)
    {
        $new = $this->newModel->findOrFail($request->new_id);
        if ($request->image) {
            $imageName = time() . 'new.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'news');
        } else {
            $imageName = $new->image;
        }

        $new->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'image' => $imageName,
        ]);

        return redirect(route('news', $new->status))->with('message', __('messages.edit_new'));
    }
    public function verify(Request $request)
    {
        $new = $this->newModel->findOrFail($request->new_id);

        $new->update([
            'show' => ($new->show == 1) ? 0 : 1,
        ]);

        return back()->with('success', ($new->show == 1) ? __('messages.show_new') : __('messages.hide_new'));
    }

    public function delete(Request $request)
    {
        $this->newModel::where('id', $request->new_id)->delete();
        return back()->with('message', __('messages.delete_new'));
    }

    public function accepet($id)
    {
        $this->newModel::where('id', $id)->update(['status' => 1]);
        return back()->with('message', __('messages.accepet_new'));
    }
    public function rejecet($id)
    {
        $this->newModel::where('id', $id)->update(['status' => 2]);
        return back()->with('message', __('messages.rejecet_new'));
    }
}
