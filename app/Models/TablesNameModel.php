<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablesNameModel extends Model
{
    use HasFactory;
    protected $table = 'tables_name';
    protected $fillable = [
        'name',
        'api_list'
    ];

    protected $casts = [
        'api_list' => 'json',
    ];
}
