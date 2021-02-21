<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyDetailsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(User $user)
    {
        $users = $user->roleuser()->pluck('role_id')->toarray();
        foreach ($users as $key => $role_id) {
            if ($role_id == 2)
            return true;
   
        }   
    }
}
