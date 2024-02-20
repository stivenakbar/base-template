<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\User\GenerateTokenTable;

class GenerateTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin-generate-token');
    }

    public function index(GenerateTokenTable $dataTable)
    {
        return $dataTable->render("pages.admin.users.token.index");
    }
}
