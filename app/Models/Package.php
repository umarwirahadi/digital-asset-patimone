<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Package
 *
 * @property int $id
 * @property string $package_name
 * @property string $short_name
 * @property string|null $description
 * @property string|null $status
 * @property string|null $is_show
 * @property int $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package isShow()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package wherePackageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    protected $table    ='packages';
    protected $fillable = ['package_name', 'short_name','description','created_by','updated_by','status','is_show'];
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

    public function scopeIsShow($query)
    {
        return $query->where('is_show', 'yes');
    }
}
