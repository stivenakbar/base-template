<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalTokenModel extends PersonalAccessToken
{
    use HasFactory;

    protected $table = "personal_access_tokens";
    protected $guarded =[
        "id",
        "created_at",
        "updated_at"
    ];

    protected $casts = [
        'abilities' => 'array',
    ];

    protected $fillable = [
        'id',
        'tokenable_type',
        'tokenable_id',
        'name',
        'token',
        'plain_text_token',
        'abilities',
        'last_used_at',
        'expires_at',
    ];

}
