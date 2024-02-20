<?php

namespace Database\Seeders;

use App\Models\AccessModel;
use App\Models\MenusModel;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AccesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $access = ['create', 'read', 'update', 'delete'];
        foreach ($roles as $role) {
            $menus = MenusModel::where('role', $role->name)->get();
            foreach ($menus as $menu) {
                
                $role->givePermissionTo($menu->module);
                foreach ($access as $acc) {
                    $role->givePermissionTo($menu->module . '-' . $acc);   
                }
            }

            $menus = MenusModel::where('role', 'all')->get();
            foreach ($menus as $menu) {
                $role->givePermissionTo($menu->module);
                foreach ($access as $acc) {
                    $role->givePermissionTo($menu->module . '-' . $acc);   
                }
            }
        }
        
    }
}
