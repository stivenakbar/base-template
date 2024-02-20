<?php

use App\Models\SiteSettingModel;
use App\Models\SystemSettingModel;

if (! function_exists('get_setting')) {
    function get_setting($name)
    {
        $setting = SystemSettingModel::where('name', $name)->first();
        dd($setting);
        if ($setting) {
            return $setting->value;
        }
    }
}

if (! function_exists('get_site')) {
    function get_site($name)
    {
        $setting = SiteSettingModel::where('name', $name)->first();
        if ($setting) {
            return $setting->value;
        }
    }
}
?>