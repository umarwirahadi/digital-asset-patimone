<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductDistribution
 *
 * @property int $id
 * @property int $product_id
 * @property int $product_number
 * @property string|null $product_label
 * @property string|null $employee_id
 * @property string $distribute_date
 * @property string|null $distribute_time
 * @property string|null $serial_number
 * @property string|null $location
 * @property string|null $condition
 * @property string|null $status
 * @property string|null $handed_over_by
 * @property string|null $received_by
 * @property string|null $files
 * @property string|null $remark
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read mixed $file_path
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereDistributeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereDistributeTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereHandedOverBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereProductLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereProductNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereReceivedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDistribution whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class ProductDistribution extends Model
{
    use HasFactory;
    protected $table = 'product_distribution';
    protected $fillable = [
        'product_id',
        'product_number',
        'product_label',
        'employee_id',
        'distribute_date',
        'distribute_time',
        'serial_number',
        'location',
        'condition',
        'status',
        'handed_over_by',
        'received_by',
        'files',
        'remark',
        'created_by',
        'updated_by'
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($productDistribution) {
            $productDistribution->created_by = auth()->user()->id;
        });

        static::updating(function ($productDistribution) {
            $productDistribution->updated_by = auth()->user()->id;
        });
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function getFilePathAttribute(){
        
        if($this->file == null){
            return asset('statics/files/default.pdf');
        }
        if(!file_exists(public_path('statics/files/'.$this->file))){
            return asset('statics/files/default.pdf');
        }
        return asset('statics/files/'.$this->file);
    }
   
    
    

}
