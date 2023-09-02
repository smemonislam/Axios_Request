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
    protected $fillable = ['name', 'slug', 'home', 'icon'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $slug = Str::slug($category->name);
            $count = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
