<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;

class ProjectsController extends Controller
{
    protected $repo;

    public function __construct(ProjectsRepository $repo)
    {
        $this->middleware('auth');  
        $this->repo = $repo;
    }

    public function store(CreateProjectRequest $request)
    {
        $this->repo->create($request);
    }

    
}
