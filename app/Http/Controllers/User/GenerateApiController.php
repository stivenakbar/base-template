<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\User\GenerateApiTable;

class GenerateApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin-generate-api');
    }

    public function index(GenerateApiTable $dataTable)
    {
        return $dataTable->render("pages.admin.users.generate-api.index");
    }
}
