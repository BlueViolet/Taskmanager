<template>
    <div class="row justify-content-center">
        <div class="col-4 mr-3">
            <step-list :steps="inProcess" :route="route">
                <template slot="card_header">
                    <div class="card-header">
                        待完成步骤({{ inProcess.length }})：
                        <button class="btn btn-sm btn-success pull-right" @click="completeAll">
                            完成所有
                        </button>
                    </div>
                </template>
            </step-list>

            <step-create :route="route" @add="sync"></step-create>
        </div>
        
        <div class="col-4">
            <step-list :steps="processed" :route="route">
                <template slot="card_header">
                    <div class="card-header">
                        已完成步骤({{ processed.length }})：
                        <button class="btn btn-sm btn-danger pull-right" @click="clearAll">
                            清除已完成
                        </button>
                    </div>
                </template>
            </step-list>
        </div>
    </div>
</template>

<script>
    import StepCreate from './step-create.vue';
    import StepList from './step-list.vue';
    import { Hub } from '../event-bus.js';

    export default {
        props:{
            route: String,
            initSteps: Array
        },
        components:{
            'StepCreate': StepCreate,
            'StepList': StepList
        },
        data(){
            return {
                steps: [
                    // {name: 'hello world!', completion: false}
                ]
            }
        },
        created(){
            this.steps = this.initSteps;
            Hub.$on('remove', this.removeStep)
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
            sync(step){
                this.steps.push(step);
            },
            removeStep(step){
                let i = this.steps.indexOf(step);
                this.steps.splice(i, 1);
            },
            completeAll(){
                axios.post(`${this.route}/complete`).then((res)=>{
                    this.inProcess.forEach((step)=>{
                        step.completion = true;
                    })
                }).catch((err)=>{
                    alert(`很抱歉，发生错误，\n 错误码：${err.response.status} \n 错误信息：${err.response.data.message} \n `);
                });
            },
            clearAll(){
                axios.delete(`${this.route}/clear`).then((res)=>{
                    this.steps = this.inProcess;
                }).catch((err)=>{
                    alert(`很抱歉，发生错误，\n 错误码：${err.response.status} \n 错误信息：${err.response.data.message} \n `);
                });
            }
        }
    }
</script>

<style>

</style>
