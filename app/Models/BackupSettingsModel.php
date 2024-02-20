<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupSettingsModel extends Model
{
    use HasFactory;
    public $table = 'backup_settings';
    protected $fillable = [
        'type',
        'day_of_week',
        'day_of_month',
        'time_of_day',
        'created_at',
        'updated_at',
    ];
}
