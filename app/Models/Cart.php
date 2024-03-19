<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function wrapping()
    {
        return $this->belongsTo(Wrapping::class, 'wrapping_id');
    }
    public function chopping()
    {
        return $this->belongsTo(Chopping::class, 'chopping_id');
    }
}
