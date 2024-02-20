<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function impersonate($userId)
    {
        $this->middleware('permission:admin-user-list');
        $user = User::find($userId);
        Auth::user()->impersonate($user);

        return redirect()->route('user.dashboard');
    }

    public function leaveImpersonation()
    {
        if (Auth::user()->isImpersonated()) {
            Auth::user()->leaveImpersonation();

            return redirect()->route('admin.user-list.index');
        }
    }
}
