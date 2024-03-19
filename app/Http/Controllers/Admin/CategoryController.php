<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImagesTrait;
    public function index()
    {
        $categories = Category::latest()->paginate();
        return view('admin.categories.index', compact('categories'));
    }
    public function addCategory()
    {
        return view('Admin.categories.create');
    }

    public function store(AddRequest $request)
    {
        $imageName = time() . '_category.' . $request->image->extension();
        $this->uploadImage($request->image, $imageName, 'categories');
        Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'image' => $imageName,
        ]);
        return redirect()->route('categories')->with('success', __('messages.add_category'));
    }

    public function verify(Request $request)
    {
        $category = Category::findOrFail($request->new_id);

        $category->update([
            'status' => ($category->status == 1) ? 0 : 1,
        ]);

        session()->flash('message', ($category->status == 1) ? __('messages.show_category') : __('messages.hide_category'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request)
    {
        $category = Category::findOrFail($request->category_id);
        if ($request->image) {
            $imageName = time() . '_category.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'categories');
        } else {
            $imageName = $category->image;
        }
        $category->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'image' => $imageName,
        ]);
        return redirect()->route('categories')->with('success', __('messages.edit_category'));
    }

    public function delete (Request $request)
    {
        $category = Category::findOrFail($request->new_id);
        $category->delete();
        return redirect()->route('categories')->with('success', __('messages.delete_category'));
    }
}
