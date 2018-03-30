<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Dzeparac\Task;
use Dzeparac\Wish;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
    	$child = \Auth::user();

        $wishes = $child->wishes()
                        ->fulfilled(false)
                        ->with('tasks')
                        ->get();

        $tasks = [
            "tasks" => [],
            "finished" => [],
            "completed" => [],
        ];

        foreach ($wishes as $wish) {
            foreach ($wish->tasks as $task) {
                $task->setRelation("wish", $wish);

                if( !$task->child_completed )
                    $tasks["tasks"][] = $task;
                else if ($task->child_completed && !$task->parent_completed)
                    $tasks["finished"][] = $task;
                else if ($task->child_completed && $task->parent_completed)
                    $tasks["completed"][] = $task;
            }
        }

        return $tasks;
    }


	/**
	 * @param Task $task
	 *
	 * @return void
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function finish(Task $task)
    {
    	$this->authorize('finish', $task);

        $task->is_finished = true;
        $task->save();
    }


	/**
	 * @param Task $task
	 *
	 * @return void
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function undoFinish(Task $task)
    {
	    $this->authorize('undoFinish', $task);

        $task->is_finished = false;
        $task->save();
    }
}
