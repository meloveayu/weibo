<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function update(User $currentUser,User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function destroy(User $currentUser,User $user)
    {
        //当前用户是管理员且删除的不是自己
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

    public function follow(User $currentUser,User $user)
    {
        return $currentUser->id !== $user->id;
    }
}
