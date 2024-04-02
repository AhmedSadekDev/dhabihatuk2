<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d h:i a');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function details()
    {
        return $this->hasMany(OrderDetials::class, 'order_id');
    }
    public function getStatus()
    {
        if ($this->status == 1) {
            return __('admin.newOrder');
        }
        if ($this->status == 2) {
            return __('admin.delivaryOrder');
        }
        if ($this->status == 3) {
            return __('admin.cancelOrder');
        }
    }
}
