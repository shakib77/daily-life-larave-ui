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
    ];


    const PROFESSION_TYPE = [
        1 => 'Student',
        2 => 'Businessman',
        3 => 'Service Holder',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
