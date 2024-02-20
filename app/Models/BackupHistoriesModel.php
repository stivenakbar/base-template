<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupHistoriesModel extends Model
{
    use HasFactory;

    public $table = 'backup_histories';
    protected $fillable = [
        'name',
    ];
}
