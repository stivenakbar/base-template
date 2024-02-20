<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettingModel extends Model
{
    use HasFactory;
    protected $table = "site_setting";
    protected $fillable = [
        "name",
        "value",
        "description",
    ];
}
