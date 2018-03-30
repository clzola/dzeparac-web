<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Child;
use Dzeparac\Http\Requests\Api\Parent\CreateTaskRequest;
use Dzeparac\Task;
use Dzeparac\User;
use Dzeparac\Wish;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class TasksController extends Controller
{
	/**
	 * @param CreateTaskRequest $request
	 * @param Wish $wish
	 *
	 * @return \Illuminate\Database\Eloquent\Model|Task
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function store(CreateTaskRequest $request, Wish $wish)
	{
		$this->authorize('create', [Task::class, $wish]);
		$task = new Task($request->all());
		$task->wish_id = $wish->id;
		$task->child_id = $wish->child_id;
		return $task;
	}

	/**
	 * @param Task $task
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function complete(Task $task)
    {
    	$this->authorize('complete', $task);
    	$task->update(['is_completed', true]);
    }

	/**
	 * @param Task $task
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function undoComplete(Task $task)
    {
	    $this->authorize('undoComplete', $task);
	    $task->update(['is_completed', false]);
    }

	/**
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function completeMany()
    {
    	$tasks = Task::query()->whereIn('id', request('tasks'))->get();

    	foreach ($tasks as $task)
    		$this->authorize('complete', $task);

    	Task::query()->whereIn('id', request('tasks'))->update(['is_completed' => true]);
    }
}
