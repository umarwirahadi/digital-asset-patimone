<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_code',
        'item_name',
        'item_category',
        'status'
    ];
 /*    protected $casts = [
        'status' => 'boolean',
    ]; */
  /*   protected $attributes = [
        'status' => 1,
    ]; */
    public function getStatusAttribute($value)
    {
        return $value == '1' ? 'Active' : 'Deactive';
    }
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'Active' ? 1 : 0;
    }
    public function getStatusLabelAttribute()
    {
        return $this->status == '1' ? 'Active' : 'Deactive';
    }
    public function getStatusClassAttribute()
    {
        return $this->status == 'Active' ? 'badge bg-success' : 'badge bg-danger';
    }
}
