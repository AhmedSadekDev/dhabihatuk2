<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }
    public function title()
    {
        if (app()->getLocale() == "ar") {
            return $this->name_ar;
        }
        return $this->name_en;
    }
    public function desc()
    {
        if (app()->getLocale() == "ar") {
            return $this->desc_ar;
        }
        return $this->desc_en;
    }
    public function images()
    {
        return $this->hasMany(Images::class, 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
