<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    protected $guarded = false; //todo need change to fillable

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
