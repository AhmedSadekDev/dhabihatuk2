<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddSettingRequest;
use App\Http\Traits\ImagesTrait;
use App\Models\Setting;

class SettingController extends Controller
{
    use ImagesTrait;

    private $settingModel;

    public function __construct(Setting $settingModel)
    {
        $this->settingModel = $settingModel;
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function index()
    {
        return view('admin.settings.index');
    }

    /*-----------------------------------------------------------------------------------------------*/

    public function store(AddSettingRequest $request)
    {
        $setting = $this->settingModel->first();
        if ($setting) {
            if ($request->logo) {
                $imageName = time() . 'setting.' . $request->logo->extension();
                $this->uploadImage($request->logo, $imageName, 'setting');
            } else {
                $imageName = $setting->logo;
            }
            if ($request->familyImage) {
                $familyImage = time() . 'setting.' . $request->familyImage->extension();
                $this->uploadImage($request->familyImage, $familyImage, 'setting');
            } else {
                $familyImage = $setting->familyImage;
            }
            $setting->update([
                'name_ar' => $request->name_ar,
                'phone' => $request->phone,
                'email' => $request->email,
                'firebase' => $request->firebase,
                'ios' => $request->ios,
                'andriod' => $request->andriod,
                'verision' => $request->verision,
                'mentanceMessage' => $request->mentanceMessage,
                'mentanceMode' => ($request->verified) ? 1 : 0,
                'logo' => $imageName,
                'familyImage' => $familyImage,

            ]);
        } else {
            if ($request->logo) {
                $imageName = time() . 'setting.' . $request->logo->extension();
                $this->uploadImage($request->logo, $imageName, 'setting');
            } else {
                $imageName = null;
            }
            if ($request->familyImage) {
                $familyImage = time() . 'setting.' . $request->familyImage->extension();
                $this->uploadImage($request->familyImage, $familyImage, 'setting');
            } else {
                $familyImage = $setting->familyImage;
            }
            $setting = $this->settingModel->create([
                'name_ar' => $request->name_ar,
                'phone' => $request->phone,
                'email' => $request->email,
                'firebase' => $request->firebase,
                'ios' => $request->ios,
                'andriod' => $request->andriod,
                'verision' => $request->verision,
                'mentanceMessage' => $request->mentanceMessage,
                'mentanceMode' => ($request->verified) ? 1 : 0,
                'logo' => $imageName,
                'familyImage' => $familyImage,
            ]);
        }

        session()->flash('success', __('messages.change_settings'));
        return redirect()->back();
    }


}
