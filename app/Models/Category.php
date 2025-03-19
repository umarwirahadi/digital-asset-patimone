<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $table    ='categories';
    protected $fillable = ['category_name', 'description','created_by','updated_by','status'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->created_by = Auth::user()->id;
        });

        static::updating(function ($category) {
            $category->updated_by = Auth::user()->id;
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
