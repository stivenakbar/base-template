<?php

namespace Database\Seeders;

use App\Models\AccessModel;
use App\Models\MenusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = MenusModel::all();
        $access = ['create', 'read', 'update', 'delete'];
        foreach ($menus as $menu) {
            Permission::create(['name' => $menu->module]);
            foreach ($access as $acc) {
                Permission::create(['name' => $menu->module . '-' . $acc]);
                AccessModel::create([
                    'name' => $menu->name .' '.$acc,
                    'module' => $menu->module . '-' . $acc,
                    'menus_id' => $menu->id
                ]);
            }
        }
    }
}
