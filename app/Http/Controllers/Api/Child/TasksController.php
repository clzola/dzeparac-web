<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Dzeparac\Task;
use Dzeparac\Wish;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class TasksController extends Controller
{
    /** @var Child */
    private $child;


    /**
     * TasksController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->child = $request->get("user");
    }


    /**
     * @return array
     */
    public function index()
    {
        $wishes = $this->child->wishes()->where('flag_fulfilled', false)->with('tasks')->get();

        $tasks = [
            "tasks" => [],
            "finished" => [],
            "completed" => [],
        ];

        foreach ($wishes as $wish) {
            foreach ($wish->tasks as $task) {
                $task->setRelation("wish", new Wish(["name" => $wish->name]));

                if( !$task->child_completed )
                    $tasks["tasks"][] = $task;
                else if ($task->child_completed && !$task->parent_completed)
                    $tasks["finished"][] = $task;
                else if ($task->child_completed && $task->parent_completed)
                    $tasks["completed"][] = $task;
            }
        }

        return ["data" => $tasks];
    }


    /**
     * @param Task $task
     * @return array
     */
    public function markAsCompleted(Task $task)
    {
        $task->child_completed = true;
        $task->save();
        return ["data" => $task];
    }


    /**
     * @param Task $task
     * @return array
     */
    public function markAsNotCompleted(Task $task)
    {
        $task->child_completed = false;
        $task->save();
        return ["data" => $task];
    }
}
