<?php

namespace App\Policies;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //删除、状态切换
    public function remove(AdminUser $adminUser, $targetAdminUser)
    {
        if ($targetAdminUser->id == 1) {
            return Response::deny('您没有权限进行操作');
        }
        return true;
    }

    //只允许本人编辑
    public function modify(AdminUser $adminUser, $targetAdminUser)
    {
        if ($targetAdminUser->id == 1) {
            if ($adminUser->id <> $targetAdminUser->id) {
                return Response::deny('您没有权限进行操作');
            }
        }
        return true;
    }
}
