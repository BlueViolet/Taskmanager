@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo" 
                    role="tab" aria-controls="todo" aria-selected="true">
                    待办事项
                    <span class="badge badge-pill badge-danger">{{ count($todos) }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" 
                    role="tab" aria-controls="done" aria-selected="false">
                    已完成
                    <span class="badge badge-pill badge-success">{{ count($dones) }}</span>
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="todo" 
                role="tabpanel" aria-labelledby="todo-tab">
                @if(count($todos)>0)
                    <table class="table table-striped">
                        @foreach($todos as $task)
                            <tr>
                                <td class="col-9">
                                        <span class="badge badge-secondary mr-3">{{ $task->updated_at->diffForHumans() }}</span>
                                    {{ $task->name }}
                                </td>
                                <td class="col-1">@include('tasks._checkForm')</td>
                                <td class="col-1">@include('tasks._editForm')</td>
                                <td class="col-1">@include('tasks._deleteForm')</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="pull-right">
                        {{ $todos->links() }}
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="done" 
                role="tabpanel" aria-labelledby="done-tab">
            
                @if(count($dones)>0)
                    <table class="table table-striped">
                        @foreach($dones as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="pull-right">
                        {{ $dones->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection