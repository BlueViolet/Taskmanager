@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <steps></steps>
        
    </div>
@endsection