<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'title'=>'required|min:5|max:200',
            'description'=>'required|min:5',
            'labels' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'标题不能为空',
            'title.min'=>'标题不能少于5个字符',
            'description.required'=>'内容不能为空',
            'description.min'=>'内容不能少于5个字符',
            'labels.required' => '标签不能为空，多个标签用空格分隔',
        ];
    }
}