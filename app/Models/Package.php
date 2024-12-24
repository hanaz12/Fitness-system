<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    // تحديد الحقول المسموح بتعبئتها
    protected $fillable = [
       'admin_id',
       'name',
       'price',
       'duration',
       'description',
       'discount',
       'coach_id',
       'admin_id',
       'status'
    ];
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
    public function trainees()
{
    return $this->hasMany(Trainee::class, 'package_id');
}

}
