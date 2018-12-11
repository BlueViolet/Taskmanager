<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name','thumbnail'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
