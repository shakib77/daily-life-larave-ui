<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'institute_name',
        'daily_cost',
        'monthly_cost',
        'pocket_money',
        'monthly_edu_expenses',
        'monthly_income',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
