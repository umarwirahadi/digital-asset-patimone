<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Package extends Model
{
    protected $table    ='packages';
    protected $fillable = ['package_name', 'short_name','description','created_by','updated_by','status','is_show'];
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

    public function scopeIsShow($query)
    {
        return $query->where('is_show', 'yes');
    }
}
