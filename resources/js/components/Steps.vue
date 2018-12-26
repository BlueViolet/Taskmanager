<template>
    <div class="row justify-content-center">
        <div class="col-4 mr-3">
            <div class="card mb-3" v-if="inProcess.length">
                <div class="card-header">
                    待完成步骤({{ inProcess.length }})：
                    <button class="btn btn-sm btn-success pull-right" @click="completeAll">
                        完成所有
                    </button>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in inProcess">
                            <span @dblclick="editStep(step)">
                                {{ step.name }}
                            </span>
                            <button type="button" class="btn btn-danger btn-sm pull-right" @click="removeStep(step)">
                                <i class="fa fa-close"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm pull-right mr-2" @click="stepToggle(step)">
                                <i class="fa fa-check"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <label v-show="!newStep">要完成当前任务，需要哪些步骤？</label>
                        <input type="text" class="form-control" ref="newStep" v-model="newStep" @keyup.enter="addStep">
                    </div>
                    <button class="btn btn-sm btn-success pill-right" v-if="newStep" @click="addStep">添加步骤</button>
                </div>
            </div>
        </div>
        
        <div class="col-4">
            <div class="card" v-if="processed.length">
                <div class="card-header">
                    已完成步骤({{ processed.length }})：
                    <button class="btn btn-sm btn-danger pull-right" @click="clearAll">
                        清除已完成
                    </button>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in processed">
                            <span @dblclick="editStep(step)">
                                {{ step.name }}
                            </span>
                            <button type="button" class="btn btn-danger btn-sm pull-right" @click="removeStep(step)">
                                <i class="fa fa-close"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm pull-right mr-2" @click="stepToggle(step)">
                                <i class="fa fa-check"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'route'
        ],
        data(){
            return {
                steps: [
                    // {name: 'hello world!', completion: false}
                ],
                newStep: ''
            }
        },
        created(){
            this.fetchSteps();
        },
        computed:{
            inProcess(){
                return this.steps.filter((step)=>{
                    return !step.completion
                })
            },
            processed(){
                return this.steps.filter((step)=>{
                    return step.completion
                })
            }
        },
        methods:{
            fetchSteps(){
                axios.get(this.route).then((res)=>{
                    this.steps = res.data;
                });
            },
            addStep(){
                this.steps.push({name: this.newStep, completion: false});
                this.newStep = '';
            },
            stepToggle(step){
                step.completion = !step.completion;
            },
            removeStep(step){
                let i = this.steps.indexOf(step);
                this.steps.splice(i, 1);
            },
            editStep(step){
                this.removeStep(step);
                this.newStep = step.name;
                this.$refs.newStep.focus();
            },
            completeAll(){
                this.inProcess.forEach((step)=>{
                    step.completion = true;
                })
            },
            clearAll(){
                this.steps = this.inProcess;
            }
        }
    }
</script>

<style>

</style>
