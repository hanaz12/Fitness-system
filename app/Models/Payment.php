<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // تحديد اسم الجدول إذا كان مختلفًا عن اسم الموديل
    protected $fillable = [
        'trainee_id',
        'amount',
        'method',
        'status',
        'getwayID',
        'getwayName',
        'payNumber',
        'payment_date'
    ];

    // تعريف العلاقة مع الموديل Trainee
    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
