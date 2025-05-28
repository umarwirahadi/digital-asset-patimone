<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table    ='options';
    protected $fillable = ['option_name', 'option_value', 'option_type', 'option_group', 'description', 'is_active'];
    protected $casts = [
        'is_active' => 'boolean',
        'option_value' => 'string',
        'option_type' => 'string',
        'option_group' => 'string',
    ];


    
}
