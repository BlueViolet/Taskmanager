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

    public function delete($id)
    {
        $task = $this->find($id);
        $task->delete();
    }
    
    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function update($request, $id)
    {
        $task = $this->find($id);
        $task->update([
            'name' => $request->name,
            'project_id' => $request->project
        ]);
    }

    public function check($task)
    {
        $task->completion = (int) true;
        $task->save();

        return $task;
    }
}