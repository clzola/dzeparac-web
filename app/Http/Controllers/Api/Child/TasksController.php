<?php

namespace App\Http\Controllers\Api\Child;

use App\Child;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $wishes = $this->child->wishes()->where('fulfilled', false)->with('tasks')->get();

        $tasks = [];
        foreach ($wishes as $wish) {
            foreach ($wish->tasks as $task)
                $tasks[] = $task;
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
