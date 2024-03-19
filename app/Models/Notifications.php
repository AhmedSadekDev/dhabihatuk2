<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifications extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function title()
    {
        if (app()->getLocale() == "ar") {
            return $this->title_ar;
        }
        return $this->title_en;
    }
    public function message()
    {
        if (app()->getLocale() == "ar") {
            return $this->message_ar;
        }
        return $this->message_en;
    }
}
