<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Serviceholder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'daily_cost',
        'monthly_cost',
        'monthly_income',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
