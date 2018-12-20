<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Task;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        return $task->steps()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsStep  $modelsStep
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsStep $modelsStep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsStep  $modelsStep
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsStep $modelsStep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsStep  $modelsStep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsStep $modelsStep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsStep  $modelsStep
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsStep $modelsStep)
    {
        //
    }
}
