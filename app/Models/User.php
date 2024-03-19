<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return env('APP_URL') . "Admin/images/users/" . $this->attributes['image'];
        }
        return env('APP_URL') . "uploads/defaults/default.png";
    }
    public function scopeRoleId($query)
    {
        return $query->where('role_id', '!=', 1)->where('role_id', '!=', 2)->where('role_id', '!=', 4);
    }
    public function scopeRoleIdUser($query)
    {
        return $query->where('role_id', 4);
    }
    public function scopeRoleIdAdmin($query)
    {
        return $query->where('role_id', 2);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        $data = json_decode($role->permissions);

        foreach ($data as $permission) {
            if (is_array($permissions) && in_array($permission, $permissions)) {
                return true;
            } elseif (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }
        return false;
    }
}
