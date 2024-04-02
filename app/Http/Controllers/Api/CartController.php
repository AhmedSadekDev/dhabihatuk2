<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResources;
use App\Http\Traits\GeneralTrait;
use App\Models\Cart;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use GeneralTrait;
    public function addToCart(Request $request)
    {
        try {
            $rules = [
                'product_id' => 'required|exists:products,id',
                'count' => 'required|numeric|integer',
                'wrapping_id' => 'required|exists:wrappings,id',
                'chopping_id' => 'required|exists:choppings,id',
                'notes' => 'nullable|string',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $cart = Cart::where(['user_id' => $request->user()->id, 'product_id' => $request->product_id])->first();
            if (!$cart) {
                Cart::create([
                    'product_id' => $request->product_id,
                    'count' => $request->count,
                    'wrapping_id' => $request->wrapping_id,
                    'chopping_id' => $request->chopping_id,
                    'notes' => $request->notes,
                    'user_id' => $request->user()->id,
                ]);
            } else {
                $cart->update([
                    'count' => $request->count,
                    'wrapping_id' => $request->wrapping_id,
                    'chopping_id' => $request->chopping_id,
                    'notes' => $request->notes,
                ]);
            }
            return $this->returnSuccess(200, __('api.addToCart'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function getCart(Request $request)
    {
        try {
            $total = 0;
            $carts = Cart::where(['user_id' => $request->user()->id])->latest()->get();
            foreach ($carts as $cart) {
                $total += $cart->count * $cart->product->price;
            }
            $setting = Setting::first();
            $addition = $total * ($setting->addition / 100);
            $paid = $total + $addition + $setting->delivary;
            return $this->returnData("data", ['carts' => CartResources::collection($carts), 'delivary' => $setting->delivary, 'addition' => $addition, 'total' => $total, 'paid' => $paid], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function removeCart(Request $request)
    {
        try {
            $rules = [
                'cart_id' => 'required|exists:carts,id',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            Cart::where(['id' => $request->cart_id])->delete();
            return $this->returnSuccess(200, __('api.removeCart'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
}
