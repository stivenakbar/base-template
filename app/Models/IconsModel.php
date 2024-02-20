<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconsModel extends Model
{
    use HasFactory;
    protected $table = 'icons';
    protected $fillable = ['class'];
}
