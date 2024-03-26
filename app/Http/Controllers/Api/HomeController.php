<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SliderResource;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\ImagesTrait;
use App\Models\About;
use App\Models\Category;
use App\Models\Contact;
use App\Models\News;
use App\Models\NotificationDetials;
use App\Models\Notifications;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Suitable;
use App\Models\Terms;
use App\Models\User;
use App\Models\WhoUs;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use GeneralTrait, ImagesTrait;
    private $articleModel, $graveModel, $settingModel, $validateModel, $deadModel;
    public function __construct()
    {
        App::setLocale(request()->header('lang'));
    }
    public function homeScreen()
    {
        try {
            $sliders = Slider::where('status', 1)->latest()->get();
            $categories = Category::where('status', 1)->latest()->get();
            return $this->returnData("data", ['sliders' => SliderResource::collection($sliders), 'categories' => CategoryResource::collection($categories)], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function allNews()
    {
        try {
            $newData = [];
            $news = News::where(['status' => 1, 'show' => 1])->latest()->take(10)->get();
            foreach ($news as $key => $new) {
                $newData[$key]['id'] = $new->id;
                if (app()->getLocale() == "ar") {
                    $newData[$key]['name'] = $new->name_ar;
                    $newData[$key]['desc'] = $new->desc_ar;
                } else {
                    $newData[$key]['name'] = $new->name_en;
                    $newData[$key]['desc'] = $new->desc_en;
                }
                $newData[$key]['image'] = env('APP_URL') . 'Admin/images/news/' . $new->image;
                $newData[$key]["time"] = Carbon::createFromTimeStamp(strtotime($new->updated_at))->locale(request()->header('lang'))->diffForHumans();
                $newData[$key]["dateString"] = Carbon::parse($new->updated_at)->locale(request()->header('lang'))->toHijri()->isoFormat('LLLL') . " " . $new->created_at;
                $newData[$key]['user'] = $new->user->name;
            }
            return $this->returnData("data", ['news' => $newData], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function allSuitables()
    {
        try {
            $suitableData = [];
            $suitables = Suitable::where(['status' => 1, 'show' => 1])->latest()->take(10)->get();
            foreach ($suitables as $key => $suitable) {
                $suitableData[$key]['id'] = $suitable->id;
                if (app()->getLocale() == "ar") {
                    $suitableData[$key]['name'] = $suitable->name_ar;
                    $suitableData[$key]['desc'] = $suitable->desc_ar;
                } else {
                    $suitableData[$key]['name'] = $suitable->name_en;
                    $suitableData[$key]['desc'] = $suitable->desc_en;
                }
                $suitableData[$key]['image'] = env('APP_URL') . 'Admin/images/suitables/' . $suitable->image;
                $suitableData[$key]["time"] = Carbon::createFromTimeStamp(strtotime($suitable->updated_at))->locale(request()->header('lang'))->diffForHumans();
                $suitableData[$key]["dateString"] = Carbon::parse($suitable->updated_at)->locale(request()->header('lang'))->toHijri()->isoFormat('LLLL') . " " . $suitable->created_at;
                $suitableData[$key]['user'] = $suitable->user->name;
                $suitableData[$key]['address'] = $suitable->address;
                $suitableData[$key]['time'] = $suitable->time;
                $suitableData[$key]['date'] = $suitable->date;
            }
            return $this->returnData("data", ['suitable' => $suitableData], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function familyNames()
    {
        try {
            $users = User::where(['status' => 1, 'verify' => 1, 'role_id' => 4])->latest()->get(['id', 'name', 'phone', 'image', 'address']);
            return $this->returnData("data", ["users" => $users], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function getNotifications()
    {
        try {
            $data = [];
            $key = 0;
            $notifications = Notifications::orderBy('status', 'ASC')->get();
            foreach ($notifications as $notification) {
                if ($notification->user_id == request()->user()->id) {
                    $data[$key]['id'] = $notification->id;
                    if (app()->getLocale() == "ar") {
                        $data[$key]['title'] = $notification->title_ar;
                        $data[$key]['message'] = $notification->message_ar;
                    } else {
                        $data[$key]['title'] = $notification->title_ar;
                        $data[$key]['message'] = $notification->message_en;
                    }
                    $data[$key]['date'] = $notification->created_at;
                    $key++;
                } else {
                    if ($notification->all == 1) {
                        $detials = NotificationDetials::where('notification_id', $notification->id)->first();
                        if ($detials) {
                            $data[$key]['id'] = $notification->id;
                            if (app()->getLocale() == "ar") {
                                $data[$key]['title'] = $notification->title_ar;
                                $data[$key]['message'] = $notification->message_ar;
                            } else {
                                $data[$key]['title'] = $notification->title_ar;
                                $data[$key]['message'] = $notification->message_en;
                            }
                            $data[$key]['date'] = $notification->created_at;
                            $key++;
                        }
                    }
                }
            }
            return $this->returnData("data", ["notifications" => $data], 'تم استرجاع الداتا');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function whoUs()
    {
        try {
            $whous = WhoUs::first();
            return $this->returnData("data", ["whoUs" => (app()->getLocale() == "ar") ? $whous->value_ar : $whous->value_en], 'تم استرحاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function about()
    {
        try {
            $about = About::first();
            return $this->returnData("data", ["about" => (app()->getLocale() == "ar") ? $about->value_ar : $about->value_en], 'تم استرحاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function terms()
    {
        try {
            $term = Terms::first();
            return $this->returnData("data", ["term" => (app()->getLocale() == "ar") ? $term->value_ar : $term->value_en], 'تم استرحاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function getSocials()
    {
        try {
            $socials = Social::where('displayed', 1)->get(['id', 'name', 'link', 'icon']);
            foreach ($socials as $social) {
                $social->icon = asset('Admin/images/socials/' . $social->icon);
            }
            return $this->returnData("data", ["socials" => $socials], 'تم استرجاع الداتا');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function sendContact(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'subjecet' => 'required|string',
                'message' => 'required|string',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subjecet,
                'message' => $request->message,
            ]);
            return $this->returnSuccess(200, __('api.sendContact'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function setting()
    {
        try {
            $setting = Setting::first();
            return $this->returnData("data", ["name" => (app()->getLocale() == "ar") ? $setting->name_ar : $setting->name_en, 'email' => $setting->email, 'phone' => $setting->phone, 'family_image' => asset('Admin/images/setting/' . $setting->familyImage), 'logo' => asset('Admin/images/setting/' . $setting->logo)], 'تم استرجلع الداتا');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function addSuitable(Request $request)
    {
        try {
            $rules = [
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'desc_ar' => 'required|string',
                'desc_en' => 'required|string',
                'lat' => 'required|string',
                'long' => 'required|string',
                'address' => 'required|string',
                'date' => 'required|string',
                'time' => 'required|string',
                'image' => 'required|file',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $imageName = time() . 'suitables.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'suitables');
            Suitable::create([
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
                'user_id' => $request->user()->id
            ]);
            return $this->returnSuccess(200, __('api.addSuitable'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function addNew(Request $request)
    {
        try {
            $rules = [
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'desc_ar' => 'required|string',
                'desc_en' => 'required|string',
                'image' => 'required|file',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $imageName = time() . 'new.' . $request->image->extension();
            $this->uploadImage($request->image, $imageName, 'news');
            News::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'desc_ar' => $request->desc_ar,
                'desc_en' => $request->desc_en,
                'image' => $imageName,
                'user_id' => $request->user()->id
            ]);
            return $this->returnSuccess(200, __('api.addNew'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
}
