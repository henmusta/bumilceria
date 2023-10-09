<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend as Backend;
use App\Http\Controllers\Api as Api;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('backend.login');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('backend')->name('backend.')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::post('/', [LoginController::class, 'login'])->name('login');
});

Route::prefix('api')->name('api.')->group(function(){
    Route::resource('api_users', Api\Api_UsersController::class);
    Route::get('api_login/login', [Api\Api_LoginController::class, 'login'])->name('api_login.login');
    Route::resource('api_login', Api\Api_LoginController::class);
});

Route::middleware('auth:henmus')->group(function(){
    Route::prefix('backend')->name('backend.')->group(function(){
      Route::post('resetpassword', [Backend\UserController::class, 'resetpassword'])->name('users.resetpassword');
      Route::post('changepassword', [Backend\UserController::class, 'changepassword'])->name('users.changepassword');
      Route::post('users/offline', [Backend\UserController::class, 'offline'])->name('users.offline');
      Route::get('users/select2', [Backend\UserController::class, 'select2'])->name('users.select2');
      Route::post('users/import', [Backend\UserController::class, 'import'])->name('users.import');
      Route::resource('users', Backend\UserController::class);
      Route::get('roles/select2', [Backend\RoleController::class, 'select2'])->name('roles.select2');
      Route::resource('roles', Backend\RoleController::class);
      Route::resource('permissions', Backend\PermissionController::class);
      Route::get('menupermissions/select2', [Backend\MenuPermissionController::class, 'select2'])->name('menupermissions.select2');
      Route::resource('menupermissions', Backend\MenuPermissionController::class)->except('create', 'edit', 'show');
      Route::resource('menu', Backend\MenuManagerController::class)->except('create', 'show');
      Route::post('menu/changeHierarchy', [Backend\MenuManagerController::class, 'changeHierarchy'])->name('menu.changeHierarchy');
      Route::resource('settings', Backend\SettingsController::class);


            Route::get('dashboard/countadmin', [Backend\DashboardController::class, 'countadmin'])->name('dashboard.countadmin');
            Route::resource('dashboard', Backend\DashboardController::class);

       //provinsi
       Route::get('provinsi/select2', [Backend\ProvinsiController::class, 'select2'])->name('provinsi.select2');
       Route::resource('provinsi', Backend\ProvinsiController::class);
       //kabupaten
       Route::get('kabupaten/select2', [Backend\KabupatenController::class, 'select2'])->name('kabupaten.select2');
       Route::resource('kabupaten', Backend\KabupatenController::class);
       //kecamatan
       Route::get('kecamatan/select2', [Backend\KecamatanController::class, 'select2'])->name('kecamatan.select2');
       Route::resource('kecamatan', Backend\KecamatanController::class);

       Route::get('wilayah/select2', [Backend\WilayahController::class, 'select2'])->name('wilayah.select2');
       Route::resource('wilayah', Backend\WilayahController::class);

       Route::get('puskesmas/select2', [Backend\PuskesmasController::class, 'select2'])->name('puskesmas.select2');
       Route::resource('puskesmas', Backend\PuskesmasController::class);


       Route::resource('lb3ibuhamil', Backend\Lb3IbuHamilController::class);

       Route::resource('lb3ibubersalin', Backend\Lb3IbuBersalinController::class);

       Route::resource('lb3rtk', Backend\Lb3RtkController::class);

       Route::resource('lb3bayi', Backend\Lb3BayiController::class);

       Route::resource('lb3brtk', Backend\Lb3BrtkController::class);

       Route::resource('lb3balita', Backend\Lb3BalitaController::class);

       Route::resource('lki', Backend\LkiController::class);

       Route::resource('lbtt', Backend\LbttController::class);
       Route::resource('laporan', Backend\LaporanController::class);

    });
  });
