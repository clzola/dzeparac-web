<?php

namespace Dzeparac\Policies;

use Dzeparac\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
    public function index(User $user)
    {
    	return true;
    }
}
