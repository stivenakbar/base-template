<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\RolesController;
use App\Livewire\Pages\Admin\MenuSorting;
use App\Livewire\Pages\Admin\User\Permission;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\User\UserListController;
use App\Http\Controllers\User\GenerateApiController;
use App\Notifications\PaymentSuccessfullNotification;
use App\Http\Controllers\User\GenerateTokenController;
use App\Livewire\Pages\Admin\BackuupDatabase\BackupModal;
use App\Livewire\Pages\Admin\PushNotification;
use App\Livewire\Pages\Admin\User\GenerateApi\ApiModal;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');
Route::get('/end-impersonation', [ImpersonateController::class, 'leaveImpersonation'])->name('leaveImpersonation');

Route::middleware("auth")->prefix("admin")->name("admin.")->group(function () {
    Route::view('/dashboard', "pages.admin.dashboard")->name("dashboard");
    Route::resource('/user-list', UserListController::class);
    Route::resource('/generate-token', GenerateTokenController::class);
    Route::resource('/role', RolesController::class);
    Route::resource('/system-setting', SystemSettingController::class);
    Route::resource('/menu', MenusController::class);
    Route::resource('/site-setting', SiteSettingController::class);
    Route::resource('/generate-api', GenerateApiController::class);
    Route::get('/generate-end-point/{tableName}', [ApiController::class, 'generateApi'])->name('generate-api');
    Route::get('/permission', Permission::class);
    Route::get('/menu-sorting', MenuSorting::class);
    Route::get('/backup', BackupModal::class)->name('backups');
    Route::get('/impersonate/{user}', [ImpersonateController::class, 'impersonate'])->name('impersonate');
    Route::get("push-notification", PushNotification::class)->name("push-notification");
});

Route::middleware("auth")->prefix("user")->name("user.")->group(function () {
    Route::view('/dashboard', "pages.admin.dashboard")->name("dashboard");
});


Route::get("test-notif", function () {
    Auth::user()->notify(new PaymentSuccessfullNotification("admin", 1000));
});

Route::get('login/google/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');


Route::get('login/google/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

require __DIR__ . '/auth.php';
require __DIR__ . '/menu.php';



