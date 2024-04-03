<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class LocationCotroller extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        App::setLocale(request()->header('lang'));
    }
    public function getLocations(Request $request)
    {
        try {
            $locations = Locations::where('user_id', $request->user()->id)->get(['id', 'address', 'lat', 'long', 'default']);
            return $this->returnData("data", ['locations' => $locations], 'تم استرجاع الداتا بنجاح');
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function addLocation(Request $request)
    {
        try {
            $rules = [
                'address' => 'required',
                'lat' => 'required',
                'long' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $location = Locations::create([
                'user_id' => $request->user()->id,
                'address' => $request->address,
                'lat' => $request->lat,
                'long' => $request->long,
                'default' => 1
            ]);
            Locations::where('user_id', $request->user()->id)->where('id', '<>', $location->id)->update(['default' => 0]);
            return $this->returnSuccess(200, __('api.addLocation'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
    public function deleteLocation(Request $request)
    {
        try {
            $rules = [
                'location_id' =>'required|exists:locations,id'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $location = Locations::where('id', $request->location_id)->withoutTrashed()->first();
            ($location) ? $location->delete() : '';
            return $this->returnSuccess(200, __('api.deleteLocation'));
        } catch (\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }
}
