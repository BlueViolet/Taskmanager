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
            'project_id' => $request->project_id
        ]);
    }

    public function check($task)
    {
        $task->completion = (int) true;
        $task->save();

        return $task;
    }

    public function todos()
    {
        return auth()->user()->tasks()->where('completion',0)->paginate(15);
    }

    public function dones()
    {
        return auth()->user()->tasks()->where('completion',1)->paginate(15);
    }

    public function todoCount()
    {
        return auth()->user()->tasks()->where('completion',0)->count();
    }

    public function doneCount()
    {
        return auth()->user()->tasks()->where('completion',1)->count();
    }

    public function totalCount()
    {
        return auth()->user()->tasks()->count();
    }
}