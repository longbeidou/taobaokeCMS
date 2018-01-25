<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminerInfomationRequest extends FormRequest
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
            'name' => 'required|min:6|max:30',
            'email' => 'email|required|unique:adminers,email'
        ];
    }

    public function messages ()
    {
       return [
         'name.required' => '用户名必填',
         'name.min' => '用户名最少由6个字符组成',
         'name.max' => '用户名最多有30个字符组成',
         'email' => '请输入有效的邮箱',
         'email.required' => '邮箱必填',
         'email.unique' => '系统中已经存在相同的邮箱，请重新输入'
       ];
    }
}
