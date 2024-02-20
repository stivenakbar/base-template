<?php

namespace App\Http\Controllers;

use App\DataTables\MenusDataTable;
use Illuminate\Http\Request;

class MenusController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:admin-menu');
    }

    public function index(MenusDataTable $datatable)
    {
        return $datatable->render("pages.admin.menus.index");
        
    }
}
