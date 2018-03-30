<?php

namespace Dzeparac\Policies;

use Dzeparac\HistoryEntry;
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
	 * @param HistoryEntry $entry
	 *
	 * @return bool
	 */
	public function show(User $user, HistoryEntry $entry)
	{
		return $user->is_child && $entry->child_id === $user->id;
	}

    /**
	 * @param User $user
	 * @param HistoryEntry $entry
	 *
	 * @return bool
	 */
    public function update(User $user, HistoryEntry $entry)
    {
    	return $user->is_child && $entry->child_id === $user->id;
    }
}
