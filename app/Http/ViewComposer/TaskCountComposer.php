<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Repositories\TasksRepository;

class TaskCountComposer
{
    protected $repo;

    public function __construct(TasksRepository $repo)
    {
        $this->repo = $repo;
    }

    public function compose(View $view)
    {
        if(auth()->user()){
            $view->with([
                'total' => $this->repo->totalCount(),
                'todoCount' => $this->repo->todoCount(),
                'doneCount' => $this->repo->doneCount()
            ]);
        }
    }
}