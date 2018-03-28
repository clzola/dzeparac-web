<?php

namespace Dzeparac\Policies;

use Dzeparac\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryEntryPolicy
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
    public function history(User $user, User $child)
    {
    	return $user->is_parent && $child->is_child && $child->parent_id === $user->id;
    }
}
