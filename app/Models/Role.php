<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }
    public function scopeRoles($query)
    {
        return $query->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 4);
    }
    public function getPermissions()
    {
        if (app()->getLocale() == "ar") {
            return config('global_ar.premissions');
        }
        return config('global_en.premissions');
    }
    public function getName()
    {
        if (app()->getLocale() == "ar") {
            return $this->name;
        }
        return $this->name_en;
    }
    public function getRoles()
    {
        return json_decode($this->permissions);
    }
    public function permissionsRoles()
    {
        if (app()->getLocale() == "ar") {
            return json_decode($this->permission_ar);
        }
        return json_decode($this->permissions);
    }

    public function getPermissionsEn()
    {
        $data = [];
        $permissions = config('trans_ar.premissions');
        foreach ($permissions as $key => $permission) {
            array_push($data, $key);
        }
        return $data;
    }
    public function getPermissionsAr($data, $permissions, $request)
    {
        $permission_ar = [];
        foreach ($request->permissions as $key) {
            $search = array_search($key, $data);
            if ($search) {
                array_push($permission_ar, $permissions[$key]);
            }
        }
        return json_encode($permission_ar, JSON_UNESCAPED_UNICODE);
    }
}
