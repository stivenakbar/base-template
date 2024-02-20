<?php

namespace Database\Seeders;

use App\Models\SiteSettingModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(public_path('json/site-setting.json'));
        $siteSettings = json_decode($json, true);
        foreach ($siteSettings as $siteSetting) {
            SiteSettingModel::create($siteSetting);
        }
    }
}
