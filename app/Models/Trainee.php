<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'password',
        'email',
        'phone',
        'first_name',
        'last_name',
        'gender',
        'age',
        'height',
        'weight',
        'address',
        'medical_history',
        'package_id',
        'admin_id',
        'plan_id'
    ];

//     public function package()
// {
//     return $this->belongsTo(Package::class);
// }

// public function plan()
// {
//     return $this->belongsTo(Plan::class);
// }
// في موديل Trainee
public function package()
{
    return $this->belongsTo(Package::class, 'package_id');
}

public function plan()
{
    return $this->belongsTo(Plan::class, 'plan_id');
}

}
