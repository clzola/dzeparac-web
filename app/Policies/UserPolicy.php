<?php

namespace Dzeparac\Policies;

use Dzeparac\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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

	/**
	 * @param User $user
	 *
	 * @return bool
	 */
    public function children(User $user)
    {
    	return $user->is_parent;
    }

	/**
	 * @param User $user
	 *
	 * @return bool
	 */
    public function addChild(User $user)
    {
    	return $user->is_parent;
    }

	/**
	 * @param User $user
	 * @param User $child
	 *
	 * @return bool
	 */
    public function updateChild(User $user, User $child)
    {
    	return $user->is_parent && $child->is_child && $child->parent_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param User $child
	 *
	 * @return bool
	 */
    public function showChild(User $user, User $child)
    {
	    return $user->is_parent && $child->is_child && $child->parent_id === $user->id;
    }
}
