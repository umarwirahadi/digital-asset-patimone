<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table    ='product_images';
    protected $fillable = [
                            'product_id',
                            'product_url',
                            'description',
                        ];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute(){        
        return asset('statics/img/'.$this->product_url);      
    }
}
