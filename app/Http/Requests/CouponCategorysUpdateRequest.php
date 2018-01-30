<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponCategorysUpdateRequest extends FormRequest
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
          'category_name' => 'required|min:1|max:30',
          'order' => 'required|numeric',
          'is_show' => 'required',
          'imgage_small' => 'image'
        ];
    }

    public function messages ()
    {
       return [
         'category_name.required' => '优惠券分类名称必填',
         'category_name.min' => '优惠券分类名称最少由1个字符组成',
         'category_name.max' => '优惠券分类名称最多有10个汉字组成',
         'order.required' => '请填写排序',
         'order.numeric' => '请用数字填写排序选项',
         'is_show.required' => '请选择是否展示分类',
         'imgage_small.image' => '请上传正确格式的图片'
       ];
    }
}
