<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['username', 'password', 'state'];
    const NORMAL = 1; //管理员状态正常
    const BAN = 0; //管理员状态为禁用

    //状态获取器
    public function getStateTextAttribute()
    {
        return config('project.admin.state')[$this->state];
    }
}
