<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLogin;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //登录表单
    public function index()
    {
        return view('admin.login');
    }

    //登录验证
    public function check(AdminLogin $request)
    {
        $data = $request->validated();
        $data['state'] = AdminUser::NORMAL;
        // $is = Auth::guard('admin')->attempt($data);
        if (!Auth::guard('admin')->attempt($data)) {
            return back()->withErrors(['username' => '帐号不可用']);
        }
        return redirect()->route('admin.index');
    }

    //退出
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
