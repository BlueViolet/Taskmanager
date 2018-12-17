<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    protected $repo;

    public function __construct(ProjectsRepository $repo)
    {
        $this->middleware('auth');  
        $this->repo = $repo;
    }

    public function index()
    {
        $projects = $this->repo->list();
        return view('welcome',compact('projects'));
    }

    public function store(CreateProjectRequest $request)
    {
        $this->repo->create($request);
        return back();
    }

    public function show($id)
    {
        $project = $this->repo->find($id);
        $todos = $this->repo->todos($project);
        $dones = $this->repo->dones($project);
        $projects = request()->user()->projects()->pluck('name','id');
        return view('projects.show',compact('project','todos','dones','projects'));
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $this->repo->update($request,$id);
        return back();
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return back();
    }

    
}
