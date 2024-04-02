<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Cart;
use App\Models\Locations;
use App\Models\Order;
use App\Models\OrderDetials;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use GeneralTrait;
    public function makeOrder(Request $request)
    {
        try {
            $rules = [
                'address_id' => 'required|exists:locations,id',
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
                'total' => $paid,
                'delivary' => $setting->delivary,
                'addition' => $addition,
                'notes' => $request->notes
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
}
