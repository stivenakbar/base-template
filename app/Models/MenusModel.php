<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusModel extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $fillable = [
        'name',
        'url',
        'module',
        'order',
        'slug',
        'is_active',
        'parent_id',
        'icon',
        'location',
        'role'
    
    ];

    public function childrens(){
        return $this->hasMany(MenusModel::class, "parent_id","id");
    }
}
