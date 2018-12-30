<template>
    <div class="card mb-3" v-if="steps.length">
        <slot name="card_header"></slot>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item" v-for="step in steps">
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
</template>

<script>
    import { Hub } from '../event-bus.js';

    export default {
        props: {
            steps: Array,
            route: String
        },
        data(){
            return {

            }
        },
        methods: {
            stepToggle(step){
                axios.patch(`${this.route}/${step.id}`, {completion: !step.completion})
                     .then((res)=>{
                    step.completion = !step.completion;
                }).catch((err)=>{
                    alert(`很抱歉，发生错误，\n 错误码：${err.response.status} \n 错误信息：${err.response.data.message} \n `);
                });
            },
            removeStep(step){
                axios.delete(`${this.route}/${step.id}`).then((res)=>{
                    Hub.$emit('remove', step);
                }).catch((err)=>{
                    alert(`很抱歉，发生错误，\n 错误码：${err.response.status} \n 错误信息：${err.response.data.message} \n `);
                })
            },
            editStep(step){
                this.removeStep(step);
                Hub.$emit('edit', step);
            },
        }
    }
</script>