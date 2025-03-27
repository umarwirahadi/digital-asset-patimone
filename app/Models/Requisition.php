<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Requisition
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Requisition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisition query()
 * @mixin \Eloquent
 */
class Requisition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'requisitions';

    protected $fillable = [
        'requisition_no',
        'requisition_type',
        'requisition_priority',
        'requisition_month',
        'requisition_year',
        'requisition_description',
        'requisition_file',
        'requisition_date',
        'requisition_remark',
        'date_supplied_by_contractor',
        'remark_by_contractor',
        'date_received_by_engineer',
        'remark_by_engineer',
        'status',
        'created_by',
        'updated_by',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    public function details()
    {
        return $this->hasMany(RequisitionDetail::class, 'requisition_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function getRequisitionFileAttribute()
    {
        if ($this->requisition_file == null) {
            return asset('statics/files/default.pdf');
        }
        if (!file_exists(public_path('statics/files/' . $this->requisition_file))) {
            return asset('statics/files/default.pdf');
        }
        return asset('statics/files/' . $this->requisition_file);
    }

}
