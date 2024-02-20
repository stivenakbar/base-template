<?php

namespace App\Http\Controllers;

use App\DataTables\SiteSettingDataTable;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index(SiteSettingDataTable $datatable)
    {
        return $datatable->render("pages.admin.site-setting.index");
    }
}
