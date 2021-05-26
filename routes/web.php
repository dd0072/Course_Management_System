<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//后台路由分组
Route::prefix('admin')->group(function () {

    //管理员登录
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'check'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    //需要保护的路由列表
    Route::middleware(['adminLoginCheck'])->group(function () {
        //后台中心首页
        Route::get('index', [IndexController::class, 'index'])->name('admin.index');
    });

    //管理员管理模块
    Route::prefix('adminuser')->group(function () {
        //列表
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.adminuser');
        //添加/编辑
        Route::get('add/{adminuser?}', [AdminUserController::class, 'add'])->name('admin.adminuser.add');
        Route::post('add/{adminuser?}', [AdminUserController::class, 'save'])->name('admin.adminuser.add');
        //软删除
        Route::get('remove/{adminuser}', [AdminUserController::class, 'remove'])->name('admin.adminuser.remove');
        //状态切换
        Route::get('state/{adminuser}', [AdminUserController::class, 'state'])->name('admin.adminuser.state');
    });

    //系统设置模块
    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting');
        Route::post('/', [SettingController::class, 'save'])->name('admin.setting');
    });
});
