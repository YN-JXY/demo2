<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class UserPolicy
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

    public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }

    //访问控制，自己只能访问自己，访问别人不可以
    public function AccessControl(User $currentUser,User $user)
    {
        return $currentUser->id === $user->id;
    }

    //只有管理员才可以删除除自身以外的用户
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
