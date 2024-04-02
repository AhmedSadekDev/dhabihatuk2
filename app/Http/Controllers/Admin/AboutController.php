<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Terms;
use App\Models\WhoUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.abouts.index', compact('about'));
    }

    public function update(Request $request)
    {
        About::where('id', 1)->update(['value_ar' => $request->value_ar, 'value_en' => $request->value_en]);
        return back()->with('message', __('messages.edit_about'));
    }
    public function terms()
    {
        $term = Terms::first();
        return view('admin.terms.index', compact('term'));
    }

    public function updateterms(Request $request)
    {
        Terms::where('id', 1)->update(['value_ar' => $request->value_ar, 'value_en' => $request->value_en]);
        return back()->with('message', __('messages.edit_terms'));
    }
}
