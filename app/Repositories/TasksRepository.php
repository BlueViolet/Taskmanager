<?php

namespace App\Repositories;

use App\Models\Task;

class TasksRepository
{
    public function create($request)
    {
        return Task::create([
            'name' => $request->name,
            'completion' => (int) false,
            'project_id' => $request->project
        ]);
    }
    
    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function check($task)
    {
        $task->completion = (int) true;
        $task->save();

        return $task;
    }
}