<?php

namespace Database\Seeders;

use App\Models\RolesModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(public_path('json/role.json'));
        $data = json_decode($json, true);
        foreach ($data as $value) {
            Role::create($value);
        }
        $roleAdmin = RolesModel::where('name', 'admin')->first();

        $abilities = [];
        $tables = \DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableName = current((array) $table);
            foreach (['select', 'insert', 'update', 'delete'] as $action) {
                $abilities[] = $tableName . '-' . $action;
            }
        }
        array_push($abilities, '*');
        $roleAdmin->createTokenWithPlainText('admin-token', $abilities);
    }
}
