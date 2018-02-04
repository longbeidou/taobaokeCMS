<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandsStoreRequest extends FormRequest
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
          'name' => 'required|min:1|max:30',
          'order' => 'required|numeric',
          'is_show' => 'required',
          'keywords' => 'required',
          'brand_category_id' => 'required|numeric',
          'image' => 'required|image',
        ];
    }

    public function messages ()
    {
       return [
         'name.required' => '品牌名称名称必填',
         'name.min' => '品牌名称名称最少由1个字符组成',
         'name.max' => '品牌名称名称最多有10个汉字组成',
         'order.required' => '请填写排序',
         'order.numeric' => '请用数字填写排序选项',
         'is_show.required' => '请选择是否展示分类',
         'keywords.required' => '关键词必须填写才能提交',
         'brand_category_id.required' => '请选择好品牌分类后提交',
         'brand_category_id.numeric' => '请刷新页面重新选择品牌分类后提交',
         'image.required' => '请上传文件后提交',
         'image.image' => '上传图片的格式有误，请上传正确格式的图片'
       ];
    }
}
