<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Socials\AddSocialRequest;
use App\Http\Requests\Socials\UpdateSocialRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    use ImagesTrait;

    private $socialModel;

    public function __construct(Social $socialModel)
    {
        $this->socialModel = $socialModel;
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function index()
    {
        $socials = $this->socialModel->select('id', 'link', 'icon', 'displayed', 'name')->paginate(10);
        return view('admin.socials.index', compact('socials'));
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function create()
    {
        return view('admin.socials.create');
    }

    public function store(AddSocialRequest $request)
    {
        if ($request->icon) {
            $imageName = time() . 'socials.' . $request->icon->extension();
            $this->uploadImage($request->icon, $imageName, 'socials');
        } else {
            $imageName = null;
        }

        $this->socialModel->create([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $imageName,
            'displayed' => ($request->show) ? 1 : 0,
        ]);

        session()->flash('success', __('messages.add_social'));
        return redirect(route('socials.index'));
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function edit($id)
    {
        $social = $this->socialModel->findOrFail($id);

        return view('admin.socials.edit', compact('social'));
    }

    public function update(UpdateSocialRequest $request)
    {
        $social = $this->socialModel->findOrFail($request->social_id);
        if ($request->icon) {
            $imageName = time() . 'socials.' . $request->icon->extension();
            $this->uploadImage($request->icon, $imageName, 'socials');
        } else {
            $imageName = $social->icon;
        }

        $social->update([
            'link' => $request->link,
            'icon' => $imageName,
            'name' => $request->name,
        ]);

        session()->flash('success', __('messages.edit_social'));
        return redirect(route('socials.index'));
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function display(Request $request)
    {
        $social = $this->socialModel->findOrFail($request->social_id);

        $social->update([
            'displayed' => ($social->displayed == 1) ? 0 : 1,
        ]);

        session()->flash('success', ($social->displayed == 1) ? __('messages.show_social') : __('messages.hide_social'));
        return redirect()->back();
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function destroy(Request $request)
    {
        $social = $this->socialModel->findOrFail($request->social_id);
        $social->delete();
        $this->deleteImage($social->icon);

        session()->flash('success', __('messages.delete_social'));
        return redirect()->back();
    }
}
