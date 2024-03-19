<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\ImagesTrait;
use App\Models\Otp;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use GeneralTrait, ImagesTrait;

    public function __construct()
    {
        App::setLocale(request()->header('lang'));
    }
    public function register(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string',
                'email' => 'nullable|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password' => 'required',
                'lat' => 'required',
                'long' => 'required',
                'address' => 'required',
                'image' => 'nullable|file|mimes:png,jpg,jpeg',
                'twitter' => 'nullable|url'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $role = Role::where('name_en', 'User')->first(['id']);
            if ($request->image) {
                $imageName = time() . 'user.' . $request->image->extension();
                $this->uploadImage($request->image, $imageName, 'users');
            } else {
                $imageName = null;
            }

            $verify = rand(11111, 99999);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'lat' => $request->lat,
                'long' => $request->long,
                'address' => $request->address,
                'image' => $imageName,
                'twitter' => $request->twitter,
                'role_id' => $role->id
            ]);
            Otp::create([
                'otp' => $verify,
                'phone' => $request->phone
            ]);
            return $this->returnData('data', ['phone' => $user->phone, 'code' => $verify], __('api.regiser'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function verifyCodePassword(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
                'otp' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $otp = Otp::where(['otp' => $request->otp, 'phone' => $request->phone])->first();
            if (!$otp) {
                return $this->returnError(403, __('api.codeNotFound'));
            }
            Otp::where(['otp' => $request->otp, 'phone' => $request->phone])->delete();
            User::where(['phone' => $request->phone])->update(['verify' => 1]);
            return $this->returnSuccess(200, __('api.verifyCodePassword'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function verifyCode(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
                'otp' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $otp = Otp::where(['otp' => $request->otp, 'phone' => $request->phone])->first();
            if (!$otp) {
                return $this->returnError(403, __('api.codeNotFound'));
            }
            Otp::where(['otp' => $request->otp, 'phone' => $request->phone])->delete();
            User::where(['phone' => $request->phone])->update(['verify' => 1]);
            return $this->returnSuccess(200, __('api.registerSuccess'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $verify = rand(11111, 99999);
            Otp::create([
                'otp' => $verify,
                'phone' => $request->phone
            ]);
            return $this->returnData('data', ['phone' => $request->phone, 'code' => $verify], __('api.regiser'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function changePassword(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
                'password' => 'required_with:confirm_password|same:confirm_password'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            User::where('phone', $request->phone)->update(['password' => Hash::make($request->password)]);
            return $this->returnSuccess(200, __('api.changePassword'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function resendCode(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $verify = rand(11111, 99999);
            Otp::create([
                'otp' => $verify,
                'phone' => $request->phone
            ]);
            return $this->returnData('data', ['phone' => $request->phone, 'code' => $verify], __('api.regiser'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function login(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
                'password' => 'required',
                'device_token' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            if (auth()->attempt(['phone' => $request->phone, 'password' => $request->password])) {
                $user = User::where('phone', $request->phone)->first();
                if (!$user->verify) {
                    $verify = rand(11111, 99999);
                    Otp::create([
                        'otp' => $verify,
                        'phone' => $request->phone
                    ]);
                    return $this->returnData('data', ['phone' => $request->phone, 'code' => $verify, 'isActive' => false], __('api.regiser'));
                }
                if (!$user->status) {
                    return $this->returnError(403, __('api.notactivateAccount'));
                }
                $token = $user->createToken("API TOKEN")->plainTextToken;
                $token = "Bearer " . $token;
                $user->update(['token' => $token, 'device_token' => $request->device_token]);
                return $this->returnData("data", ["user" => new UserResource($user), 'isActive' => true], __('api.login'));
            }
            return $this->returnError(403, __('api.passwordOrPhoneIsWrong'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function logout()
    {
        try {
            $user = request()->user();
            User::where('id', request()->user()->id)->update(['device_token' => null]);
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            return $this->returnSuccess(200, __('api.logout'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function deleteAccount()
    {
        try {
            $user = request()->user();
            User::where('id', request()->user()->id)->delete();
            return $this->returnSuccess(200, __('api.deleteAccount'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function getProfileData()
    {
        try {
            $user = User::where('phone', request()->user()->phone)->first();
            return $this->returnData("data", ["user" => new UserResource($user)], __('api.returnData'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string',
                'email' => 'nullable|email|unique:users,email,' . $request->user()->id,
                'phone' => 'required|unique:users,phone,' . $request->user()->id,
                'lat' => 'required',
                'long' => 'required',
                'address' => 'required',
                'image' => 'nullable|file|mimes:png,jpg,jpeg',
                'twitter' => 'nullable|url'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $user = User::where('phone', $request->user()->phone)->first();
            if ($request->image) {
                $imageName = time() . 'user.' . $request->image->extension();
                $this->uploadImage($request->image, $imageName, 'users');
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'lat' => $request->lat,
                'long' => $request->long,
                'address' => $request->address,
                'image' => ($request->image) ? $imageName : '',
                'twitter' => $request->twitter,
            ]);
            return $this->returnData("data", ["user" => new UserResource($user)], __('api.updateProfile'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $rules = [
                'current_password' => 'required',
                'password' => 'required_with:confirm_password|same:confirm_password'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $user = User::where('id', $request->user()->id)->first();
            if (!Hash::check($request->current_password, $user->password)) {
                return $this->returnError('403', __('api.notCorrecetPassword'));
            }
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return $this->returnSuccess(200, __('api.changePassword'));
        } catch (\Throwable $e) {
            return $this->returnError(403, $e->getMessage());
        }
    }
}
