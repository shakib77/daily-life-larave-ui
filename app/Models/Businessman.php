<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Businessman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'daily_cost',
        'monthly_cost',
        'monthly_income',
        'employee_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
