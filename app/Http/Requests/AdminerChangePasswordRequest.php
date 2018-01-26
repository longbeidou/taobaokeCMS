<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminerChangePasswordRequest extends FormRequest
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
            'password' => 'required',
            'password_new' => 'required|min:6|max:30',
            'password_re' => 'required|min:6|max:30',
        ];
    }

    public function messages()
    {
      return [
        'password_new.required' => '原始密码必填',
        'password_new.min' => '新密码最少由6个字符组成',
        'password_new.max' => '新密码最多有30个字符组成',
        'password_re.required' => '确认密码必填',
        'password_re.min' => '确认密码最少由6个字符组成',
        'password_re.max' => '确认密码最多有30个字符组成',
      ];
    }
}
