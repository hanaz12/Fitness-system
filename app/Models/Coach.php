<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'password',
        'email',
        'phone',
        'first_name',
        'last_name',
         'admin_id',
        'address',
        'salary',
        'status'
    ];
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
