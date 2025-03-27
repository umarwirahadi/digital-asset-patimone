<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $category_id
 * @property int $package_id
 * @property string|null $code
 * @property string $name
 * @property int $quantity
 * @property string $unit
 * @property string|null $description
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $delivery_date
 * @property string|null $delivery_no
 * @property string|null $delivery_from
 * @property string|null $tags
 * @property string $is_warranty
 * @property string|null $warranty_start_date
 * @property string|null $warranty_end_date
 * @property string|null $file_path
 * @property string|null $remarks
 * @property string $status
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductDistribution> $distributions
 * @property-read int|null $distributions_count
 * @property-read mixed $file_path_location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductImage> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Package|null $package
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeliveryFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeliveryNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsWarranty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWarrantyEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWarrantyStartDate($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $table    ='products';
    protected $fillable = [
        'category_id',
        'package_id',
        'code',
        'name',
        'quantity',
        'unit',
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

    public function distributions(){
        return $this->hasMany(ProductDistribution::class,'product_id','id');
    }
}
