<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettingModel extends Model
{
    use HasFactory;

    protected $table = "system_settings";
    protected $fillable = [
        "name",
        "value",
        "description",
        "is_active"
    ];
    protected $guarded =[
        "id",
        "created_at",
        "updated_at"
    ];
    
}
