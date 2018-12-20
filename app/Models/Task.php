<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name','completion','project_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function steps()
    {
        return $this->hasMany('App\Models\Step');
    }
}
