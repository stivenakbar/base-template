<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function __construct(){
        $this->middleware('permission:admin-role');
    }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render("pages.admin.users.role.index");
    }
    
}
