<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;

class ProjectsController extends Controller
{
    protected $repo;

    public function __construct(ProjectsRepository $repo)
    {
        $this->middleware('auth');  
        $this->repo = $repo;
    }

    public function store(Request $request)
    {
        $this->repo->create($request);
    }

    
}
