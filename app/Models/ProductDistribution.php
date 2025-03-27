<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
