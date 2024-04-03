<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResources;
use App\Http\Traits\GeneralTrait;
use App\Models\Cart;
use App\Models\Locations;
use App\Models\Order;
use App\Models\OrderDetials;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        App::setLocale(request()->header('lang'));
    }
    public function makeOrder(Request $request)
    {
        try {
            $rules = [
                'address_id' => 'required|exists:locations,id',
                'time_id' => 'required|exists:delivay_times,id',
                'time' => 'required',
                'date' => 'required',
                'notes' => 'nullable',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $address = Locations::find($request->address_id);
            $total = 0;
            $carts = Cart::where(['user_id' => $request->user()->id])->latest()->get();
            foreach ($carts as $cart) {
                $total += $cart->count * $cart->product->price;
            }
            $setting = Setting::first();
            $addition = $total * ($setting->addition / 100);
            $paid = $total + $addition + $setting->delivary;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $order = Order::create([
                'random_code' => $randomString,
                'address' => $address->address,
                'lat' => $address->lat,
                'long' => $address->long,
                'time' => $request->time,
                'date' => $request->date,
                'notes' => $request->notes,
                'user_id' => $request->user()->id,
                'time_id' => $request->time_id,
                'total' => $paid,
                'delivary' => $setting->delivary,
                'addition' => $addition,
            ]);
            foreach ($carts as $cart) {
                OrderDetials::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'count' => $cart->count,
                    'total' => $cart->count * $cart->product->price,
                    'wrapping_id' => $cart->wrapping_id,
                    'chopping_id' => $cart->chopping_id,
                    'notes' => $cart->notes,
                ]);
                $cart->delete();
            }
            return $this->returnSuccess(200, __('api.makeOrder'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function myOrders()
    {
        try {
            $Previousorders = Order::where('user_id', request()->user()->id)->where('status', 2)->orWhere('status', 3)->latest()->get();
            $Currentorders = Order::where('user_id', request()->user()->id)->where('status', 1)->orWhere('status', 4)->orWhere('status', 5)->latest()->get();
            return $this->returnData("data", ['Previousorders' => OrderResources::collection($Previousorders), 'Currentorders' => OrderResources::collection($Currentorders)], 'تم استرجاع الداتا');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function reOrder(Request $request)
    {
        try {
            $order = Order::find($request->order_id);
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $total = 0;
            foreach ($order->details as $detial) {
                $total += $detial->count * $detial->product->price;
            }
            $setting = Setting::first();
            $addition = $total * ($setting->addition / 100);
            $paid = $total + $addition + $setting->delivary;
            $orderNew = Order::create([
                'random_code' => $randomString,
                'address' => $order->address,
                'lat' => $order->lat,
                'long' => $order->long,
                'time' => $order->time,
                'date' => $order->date,
                'notes' => $order->notes,
                'time_id' => $order->time_id,
                'user_id' => $request->user()->id,
                'total' => $paid,
                'delivary' => $setting->delivary,
                'addition' => $addition,
            ]);
            foreach ($order->details as $cart) {
                OrderDetials::create([
                    'order_id' => $orderNew->id,
                    'product_id' => $cart->product_id,
                    'count' => $cart->count,
                    'total' => $cart->count * $cart->product->price,
                    'wrapping_id' => $cart->wrapping_id,
                    'chopping_id' => $cart->chopping_id,
                    'notes' => $cart->notes,
                ]);
            }
            return $this->returnSuccess(200, __('api.makeOrder'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function deleteOrder(Request $request)
    {
        try {
            $order = Order::find($request->order_id);
            if ($order) {
                $order->update([
                    'status' => 3,
                    'deleteReason' => $request->deleteReason
                ]);
            }
            return $this->returnSuccess(200, __('api.deleteOrder'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
}
