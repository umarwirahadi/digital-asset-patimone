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
        static::deleting(function ($model) {
            if ($model->details()->count() > 0) {
                throw new \Exception('You cannot delete this requisition because it has related requisition details.');               
            }            
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

   /*  public function getRequisitionFileAttribute()
    {
        if ($this->requisition_file == null) {
            return asset('statics/files/default.pdf');
        }
        if (!file_exists(public_path('statics/files/' . $this->requisition_file))) {
            return asset('statics/files/default.pdf');
        }
        return asset('statics/files/' . $this->requisition_file);
    } */

    public function getStatusLabelAttribute()
    {
        $status_label = [
            '0' => 'Draft',
            '1' => 'Sent',
            '2' => 'Approved',
            '3' => 'Rejected',
            '4' => 'Completed',
            '5' => 'Cancelled',
            '6' => 'In Progress',
            '7' => 'Pending',
        ];
        return $status_label[$this->status] ?? 'Unknown';        
    }

    public function getStatusClassAttribute()
    {
        $status_class = [
            '0' => 'badge bg-secondary',
            '1' => 'badge bg-primary',
            '2' => 'badge bg-success',
            '3' => 'badge bg-danger',
            '4' => 'badge bg-info',
            '5' => 'badge bg-warning',
            '6' => 'badge bg-dark',
            '7' => 'badge bg-light',
        ];
        return $status_class[$this->status] ?? 'badge bg-danger';
    }
   

}
