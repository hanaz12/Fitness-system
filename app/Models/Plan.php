<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'coach_id',
        'plan_name',
        'description',
        'trainee_id'
    ];

    // علاقة مع موديل Coach
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
}
