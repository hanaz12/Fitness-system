<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    // تحديد الحقول المسموح بتعبئتها
    protected $fillable = [
        'email',
        'user_name',
        'phone',
        'address',
        'admin_moderator_id',
        'salary',
        'first_name',
        'last_name',
        'password',
        'status'
    ];


    // إخبار Eloquent بعدم التعامل مع التواريخ (created_at و updated_at)
    public $timestamps = false;
}
