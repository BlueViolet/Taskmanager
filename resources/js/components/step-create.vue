<template>
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <label v-show="!newStep">要完成当前任务，需要哪些步骤？</label>
                <input type="text" class="form-control" ref="newStep" v-model="newStep" @keyup.enter="addStep">
            </div>
            <button class="btn btn-sm btn-success pill-right" v-if="newStep" @click="addStep">添加步骤</button>
        </div>
    </div>
</template>

<script>
    import { Hub } from '../event-bus.js';

    export default {
        props:{
            route: String
        },
        data(){
            return {
                newStep: ''
            }
        },
        created(){
            Hub.$on('edit', this.editStep);
        },
        methods:{
            addStep(){
                axios.post(this.route, { name:this.newStep }).then((res)=>{
                    this.$emit('add',res.data.step);
                    this.newStep = '';
                }).catch((err)=>{
                    alert(`很抱歉，发生错误，\n 错误码：${err.response.status} \n 错误信息：${err.response.data.message} \n `);
                })
            },
            editStep(step){
                this.newStep = step.name;
                this.$refs.newStep.focus();
            }
        }
    }
</script>