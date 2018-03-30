<?php

namespace Dzeparac\Policies;

use Dzeparac\User;
use Dzeparac\Wish;
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

	/**
	 * @param User $user
	 *
	 * @return bool
	 */
    public function create(User $user)
    {
    	return $user->is_child;
    }

	/**
	 * @param User $user
	 * @param Wish $wish
	 *
	 * @return bool
	 */
	public function show(User $user, Wish $wish)
    {
    	return $user->is_child && $wish->child_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param Wish $wish
	 *
	 * @return bool
	 */
	public function update(User $user, Wish $wish)
	{
		return $user->is_child && $wish->child_id === $user->id;
	}
}
