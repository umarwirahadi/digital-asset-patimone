<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $table    ='products';
    protected $fillable = [
        'category_id',
        'package_id',
        'code',
        'name',
        'quantity',
        'description',
        'brand',
        'model',
        'delivery_date',
        'delivery_no',
        'delivery_from',
        'tags',
        'is_warranty',
        'warranty_start_date',
        'warranty_end_date',
        'file_path',
        'remarks',
        'status',
        'created_by',
        'updated_by'
    ];

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

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }

    public function getFilePathLocationAttribute(){        
        return asset('statics/files/'.$this->file_path);      
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
