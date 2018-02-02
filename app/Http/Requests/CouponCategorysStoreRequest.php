<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponCategorysStoreRequest extends FormRequest
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
            'image_small' => 'required|image',
            'group1.0.word' => 'required'
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
         'image_small.required' => '请上传图片文件',
         'image_small.image' => '请上传正确格式的图片',
         'group1.0.word.required' => '请填写关键字'
       ];
    }
}
