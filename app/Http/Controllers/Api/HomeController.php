<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ChoppingResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\WrappingResource;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\ImagesTrait;
use App\Models\About;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Chopping;
use App\Models\Contact;
use App\Models\NotificationDetials;
use App\Models\Notifications;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Terms;
use App\Models\Wrapping;
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

    public function categoryProducts()
    {
        try {
            $products = Product::where(['status' => 1, 'category_id' => request()->category_id])->latest()->get();
            return $this->returnData("data", ['products' => ProductResource::collection($products)], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function productDetials(Request $request)
    {
        try {
            $product = Product::find($request->product_id);
            return $this->returnData("data", ['product' => new ProductResource($product)], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function Wrapping()
    {
        try {
            $Wrapping = Wrapping::where('status', 1)->latest()->get();
            return $this->returnData("data", ['Wrapping' => WrappingResource::collection($Wrapping)], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function Chopping()
    {
        try {
            $Choppings = Chopping::where('status', 1)->latest()->get();
            return $this->returnData("data", ['Choppings' => ChoppingResource::collection($Choppings)], 'تم استرجاع الداتا بنجاح');
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
}
