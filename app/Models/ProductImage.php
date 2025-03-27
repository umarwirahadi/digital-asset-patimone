<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $product_url
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
