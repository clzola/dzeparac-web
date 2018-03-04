<?php

namespace App\Http\Controllers\Api\Parent;

use App\Child;
use App\Task;
use App\Wish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    public function complete(Child $child, Wish $wish, Task $task) 
    {
        $task->parent_completed = true;
        $task->save();
        return ["data" => $task];
    }

    public function incomplete(Child $child, Wish $wish, Task $task) 
    {
        $task->parent_completed = false;
        $task->save();
        return ["data" => $task];
    }

    public function create(Request $request, Child $child, Wish $wish) 
    {
        return [
            "data" => Task::create([
                "name" => $request->get("name"),
                "wish_id" => $wish->id,
                "child_id" => $child->id,
            ]),
        ];
    }

    public function completedTasks(Child $child)
    {
        $tasks = Task::whereChildCompleted(true)->whereParentCompleted(false)->with("wish")->orderBy('wish_id')->get();
        return ["data" => $tasks];
    }

    public function markManyAsCompleted(Request $request, Child $child) 
    {
        $tasks = $request->get("tasks");
        Task::whereIn("id", $tasks)->update(['parent_completed' => true]);
        return [ "data" => $tasks ];
    }
}
