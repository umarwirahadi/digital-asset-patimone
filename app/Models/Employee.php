<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Employee
 *
 * @property int $id
 * @property int|null $position_id
 * @property string|null $code
 * @property string $full_name
 * @property string|null $birth_date
 * @property string|null $sex
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $city
 * @property string|null $mobilization
 * @property string|null $demobilization
 * @property string $status
 * @property string|null $photo
 * @property string|null $remark
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $photo_url
 * @property-read \App\Models\Position|null $position
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDemobilization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereMobilization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Employee extends Model
{
    protected $table    ='employees';
    protected $fillable = [
                        'position_id',
                        'code',
                        'full_name',
                        'birth_date',
                        'sex',
                        'phone',
                        'email',
                        'address',
                        'city',
                        'mobilization',
                        'demobilization',
                        'status',
                        'photo',
                        'remark',
                        'created_by',
                        'updated_by',
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

    public function position(){
        return $this->belongsTo(Position::class,'position_id');
    }

    public function getPhotoUrlAttribute(){
        if (is_null($this->photo) || !file_exists(public_path('statics/img/'.$this->photo))) {
            return asset('statics/dist/assets/img/avatar.png');
        }
        return asset('statics/img/'.$this->photo);  
    }
}
