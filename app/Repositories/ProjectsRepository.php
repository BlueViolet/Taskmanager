<?php

namespace App\Repositories;

use Image;
use App\Models\Project;

class ProjectsRepository
{
    public function list()
    {
        return request()->user()->projects()->get();
    }

    public function create($request){
        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thumbs($request)
        ]);
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }

    public function update($request, $id)
    {
        $project = $this->find($id);
        $project->name = $request->name;
        if($request->hasFile('thumbnail')){
            $project->thumbnail = $this->thumbs($request);
        }
        $project->save();
    }

    public function delete($id)
    {
        $project = $this->find($id);
        $project->delete();
    }

    public function thumbs($request)
    {
        if($request->hasFile('thumbnail')){
            $thumb = $request->thumbnail;
            $name = $thumb->hashName();
            $thumb->storeAs('public/thumbs/original', $name);
            
            $path = storage_path('app/public/thumbs/cropped/'.$name);
            Image::make($thumb)->resize(360, 200)->save($path);
            return $name;
        }
    }
}