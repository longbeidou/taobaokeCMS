<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
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
          'name' => 'required|min:1|max:90',
          'link' => 'required',
          'order' => 'required|numeric',
          'is_show' => 'required',
          'image' => 'image',
          'flat' => 'required',
        ];
    }

    public function messages ()
    {
       return [
         'name.required' => 'banner简介必填',
         'name.min' => 'banner简介最少由1个字符组成',
         'name.max' => 'banner简介最多有30个汉字组成',
         'link.required' => '请填写网址链接',
         'order.required' => '请填写排序',
         'order.numeric' => '请用数字填写排序选项',
         'is_show.required' => '请选择是否展示',
         'image.image' => '请给 banner 上传正确格式的图片',
         'flat.required' => '请选择banner展示的平台'
       ];
    }
}
