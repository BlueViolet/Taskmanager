<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('projects')->where(function($query){
                    return $query->where('user_id', request()->user()->id);
                })
            ],
            'thumbnail' => 'image|dimensions:min_width=260,min_height=100|max:2048'
        ];
    }

    public function messages(){
        return [
            'name.required' => '项目名称不能为空！',
            'name.unique' => '项目名称不能重复！',
            'thumbnail.image' => '只能上传图片文件！',
            'thumbnail.dimensions' => '图片最小尺寸为260X100',
            'thumbnail.max' => '图片文件大小不得超过2M'
        ];
    }
}
