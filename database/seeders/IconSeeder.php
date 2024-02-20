<?php

namespace Database\Seeders;

use App\Models\IconsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(public_path('json/icon.json'));
        $icons = json_decode($json, true);
        foreach ($icons as $icon) {
            IconsModel::create($icon);
        }
    }
}
