<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_name', 'slug', 'home', 'image'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $slug = Str::slug($category->category_name);
            $count = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        static::updating(function ($category) {
            $slug = Str::slug($category->category_name);
            $count = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
