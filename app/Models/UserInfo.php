<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'profession_type',
        'financial_condition',
    ];


    const PROFESSION_TYPE = [
        1 => 'Student',
        2 => 'Businessman',
        3 => 'Service Holder',
    ];

    /*const PROFESSION_TYPE_KEY = [
        STUDENT => 1,
        BUSINESSMAN => 2,
        SERVICE_HOLDER => 3,

    ];*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
