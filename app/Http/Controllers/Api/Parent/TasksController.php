<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Child;
use Dzeparac\Task;
use Dzeparac\User;
use Dzeparac\Wish;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class TasksController extends Controller
{
	/**
	 * @param User $child
	 * @param Task $task
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function complete(User $child, Task $task)
    {
    	$this->authorize('complete', $task);
    	$task->update(['is_completed', true]);
    }

	/**
	 * @param User $child
	 * @param Task $task
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function undoComplete(User $child, Task $task)
    {
	    $this->authorize('undoComplete', $task);
	    $task->update(['is_completed', false]);
    }

	/**
	 * @param User $child
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function completeMany(User $child)
    {
    	$tasks = Task::query()->whereIn('id', request('tasks'))->get();

    	foreach ($tasks as $task)
    		$this->authorize('complete', $task);

    	Task::query()->whereIn('id', request('tasks'))->update(['is_completed' => true]);
    }
}
