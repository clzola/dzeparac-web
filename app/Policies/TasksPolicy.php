<?php

namespace Dzeparac\Policies;

use Dzeparac\Task;
use Dzeparac\User;
use Dzeparac\Wish;
use Illuminate\Auth\Access\HandlesAuthorization;

class TasksPolicy
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
	 * @param Wish $wish
	 *
	 * @return bool
	 */
    public function create(User $user, Wish $wish)
    {
    	return $user->is_parent && $wish->child->parent_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param Task $task
	 *
	 * @return bool
	 */
    public function finish(User $user, Task $task)
    {
    	return $user->is_child && $task->child_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param Task $task
	 *
	 * @return bool
	 */
    public function complete(User $user, Task $task)
    {
    	return $user->is_parent && $task->child->parent_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param Task $task
	 *
	 * @return bool
	 */
    public function undoFinish(User $user, Task $task)
    {
    	return !$task->is_completed && $user->is_child && $task->child_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param Task $task
	 *
	 * @return bool
	 */
    public function undoComplete(User $user, Task $task)
    {
    	return !$task->wish->is_fulfilled && $user->is_parent && $task->child->parent_id === $user->id;
    }

	/**
	 * @param User $user
	 * @param Task[] $tasks
	 *
	 * @return bool
	 */
    public function completeMany(User $user, $tasks)
    {
    	if(!$user->is_parent)
    		return false;

    	foreach ($tasks as $task)
    		if($task->child->parent_id !== $user->id)
    			return false;

    	return true;
    }
}
