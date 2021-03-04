<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Authenticatable是授权功能的引用
class User extends Authenticatable
{
    //消息通知的引用
    use Notifiable;

    //关联好users表
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //防止批量赋值安全漏洞的字段白名单
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    //当使用$user-toArray()或 $user-toJson()时隐藏这些字段
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *  指定模型数据类型
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //生成用户头像
    public function gravatar($size='100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }
}
