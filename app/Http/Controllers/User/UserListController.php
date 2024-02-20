<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\User\UserDataTable;

class UserListController extends Controller
{

    public function __construct(){
        $this->middleware('permission:admin-user-list');
    }
    
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render("pages.admin.users.userlist.index");
    }
}
