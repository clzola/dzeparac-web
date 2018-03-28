<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Task;
use Dzeparac\User;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class ChildStatusController extends Controller
{
	/**
	 * @param User $child
	 *
	 * @return array
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function status(User $child)
	{
		$this->authorize('showChild', $child);

		$wishes = $child->wishes()->where('is_fulfilled', false)->get();
		$tasksQuery = Task::query()->whereIn('id', $wishes->pluck('id')->all());

		return [
			'wishes_count' => $wishes->count(),
			'tasks_count' => $tasksQuery->count(),
			'finished_tasks_count' => $tasksQuery->where('is_finished', true)
			                                     ->where('is_completed', false)
			                                     ->count()
		];
	}
}
