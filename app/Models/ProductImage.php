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
        return $this->hasOne(Product::class,'product_id');
    }

    public function getproduct_urlAttribute(){        
        return asset('statics/files/'.$this->product_url);      
    }
}
