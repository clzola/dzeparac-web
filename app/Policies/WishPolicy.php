<?php

namespace Dzeparac\Policies;

use Dzeparac\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishPolicy
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

	/**
	 * @param User $user
	 * @param User $child
	 *
	 * @return bool
	 */
    public function wishes(User $user, User $child)
    {
    	return $user->is_parent && $child->is_child && $child->parent_id === $user->id;
    }
}
