<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
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
            'name' => 'required|unique:projects',
            'thumbnail' => 'image|dimensions:min_width=260,min_height=100'
        ];
    }

    public function messages(){
        return [
            'name.required' => '项目名称不能为空！',
            'name.unique' => '项目名称不能重复！',
            'thumbnail.image' => '只能上传图片文件！',
            'thumbnail.dimensions' => '图片最小尺寸为260X100'
        ];
    }
}
