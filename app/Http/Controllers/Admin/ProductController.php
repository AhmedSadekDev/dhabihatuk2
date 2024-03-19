<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImagesTrait;
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::get();
        return view('admin.products.create', compact('categories'));
    }
    public function store(AddRequest $request)
    {
        $product = Product::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'price' => $request->price,
            'count' => $request->count,
            'category_id' => $request->category_id,
        ]);
        foreach ($request->images as $image) {
            $imageName = random_int(1111, 9999) . 'product.' . $image->extension();
            $this->uploadImage($image, $imageName, 'products');
            $product->images()->create([
                'image' => $imageName,
            ]);
        }

        return redirect()->route('products')->with('success', __('messages.add_product'));
    }
    public function verify(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update([
            'status' => ($product->status == 1) ? 0 : 1,
        ]);
        session()->flash('message', ($product->status == 1) ? __('messages.show_product') : __('messages.hide_product'));
        return redirect()->back();
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    public function update(UpdateRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'price' => $request->price,
            'count' => $request->count,
            'category_id' => $request->category_id,
        ]);
        if ($request->images) {
            $product->images()->delete();
            foreach ($request->images as $image) {
                $imageName = random_int(1111, 9999) . 'product.' . $image->extension();
                $this->uploadImage($image, $imageName, 'products');
                $product->images()->create([
                    'image' => $imageName,
                ]);
            }
        }
        return redirect()->route('products')->with('success', __('messages.edit_product'));
    }
    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->images()->delete();
        $product->delete();
        return back()->with('success', __('messages.delete_product'));
    }
}
