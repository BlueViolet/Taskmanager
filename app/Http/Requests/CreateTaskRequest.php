<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    protected $errorBag = 'create';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'project'=>[
                'required',
                'integer',
                Rule::exists('projects','id')->where(function($query){
                    $query->whereIn('id',$this->user()->projects()->pluck('id'));
                })
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '任务名称不能为空',
            'name.max' => '任务名称最大长度不能超过255字符',
            'project.required'=>'项目不能为空',
            'project.integer'=>'项目为应该为整数',
            'project.exists'=>'项目id无效（当前用户无此项目）'
        ];
    }
}
