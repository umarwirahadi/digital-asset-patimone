<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\RequisitionDetail
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RequisitionDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequisitionDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequisitionDetail query()
 * @mixin \Eloquent
 */
class RequisitionDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'requisition_details';

    protected $fillable = [
        'requisition_id',
        'description_item',
        'category',
        'preferred_brand',
        'unit',
        'quantity',
        'photo',
        'request_date',
        'supplied_date',
        'request_status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

/*     public function getPhotoAttribute($value)
    {
        if (is_array($value)) {
                    return array_map(function ($item) {
                        return asset('storage/' . $item);
                    }, $value);
                }
        if ($value == null) {
            return asset('images/no-image.png');
        }
        return asset('storage/' . $value);
    } */



}
