<?php

namespace App\Repositories;

use Image;
use App\Models\Project;

class ProjectsRepository
{
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
            Image::make($thumb)->resize(200, 90)->save($path);
            return $name;
        }
    }
}