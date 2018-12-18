@extends('layouts.app')

@section('content')
    <div class="container" id="app-2">
        <h3>{{ $task->name }}</h3>
        
        <ul class="list-group">
            <li class="list-group-item" v-for="step in steps">
                @{{ step.name }}
            </li>
        </ul>

        <input type="text" v-model="newStep" @keyup.enter="addStep">
    </div>
@endsection

@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        var app = new Vue({
            el: '#app-2',
            data: {
                steps: [
                    {name: 'hello world!', completion: false},
                    {name: 'hello wyh', completion: false}
                ],
                newStep: ''
            },
            methods:{
                addStep(){
                    this.steps.push({name: this.newStep, completion: false});
                    this.newStep = '';
                }
            }
        });
    </script>
@endsection