<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //列表
    public function index(AdminUser $adminuser)
    {
        $adminusers = $adminuser->orderBy('id', 'desc')->get();
        $data = [
            'adminusers' => $adminusers,
        ];
        return view('admin.adminuser.index', $data);
    }

    //添加/编辑
    public function add(AdminUser $adminuser)
    {
        $data = [
            'adminuser' => $adminuser,
        ];
        return view('admin.adminuser.add', $data);
    }

    //保存
    public function save(AdminUserRequest $request, AdminUser $adminuser)
    {
        //超级管理员只能本人操作
        $this->authorizeForUser(Auth::guard('admin')->user(), 'modify', $adminuser);

        $data = $request->validated();

        if ($adminuser->id) {
            //编辑
            if ($data['password']) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $adminuser->update($data);
        } else {
            //添加
            $data['password'] = Hash::make($data['password']);
            $data['state'] = AdminUser::NORMAL;
            $adminuser->create($data);
        }

        alert('管理员操作成功');
        return redirect()->route('admin.adminuser');
    }

    //删除
    public function remove(AdminUser $adminuser)
    {
        //超级管理员禁止删除
        $this->authorizeForUser(Auth::guard('admin')->user(), 'remove', $adminuser);

        $adminuser->delete();
        alert('操作成功');
        return back();
    }

    //状态切换
    public function state(AdminUser $adminuser)
    {
        //超级管理员禁止状态切换
        $this->authorizeForUser(Auth::guard('admin')->user(), 'remove', $adminuser);

        $new_state = ($adminuser->state == AdminUser::NORMAL) ? AdminUser::BAN : AdminUser::NORMAL;
        $adminuser->state = $new_state;
        $adminuser->save();
        alert('操作成功');
        return back();
    }
}
