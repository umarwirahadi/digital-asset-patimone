<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
