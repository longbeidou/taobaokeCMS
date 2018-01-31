<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorysStoreRequest extends FormRequest
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
            'image_small' => 'image',
            'image_magic_left' => 'image',
            'image_magic_top' => 'image',
            'image_magic_buttom' => 'image',
            'is_show_pc' => 'required',
            'is_show_wx' => 'required',
            'is_show_wechat' => 'required',
            'is_show_qq' => 'required'
        ];
    }

    public function messages ()
    {
       return [
         'name.required' => '栏目分类名称必填',
         'name.min' => '栏目分类名称最少由1个字符组成',
         'name.max' => '栏目分类名称最多有10个汉字组成',
         'order.required' => '请填写排序',
         'order.numeric' => '请用数字填写排序选项',
         'is_show.required' => '请选择是否展示分类',
         'image_small.image' => '请给 导航小图片 上传正确格式的图片',
         'image_magic_left.image' => '请给 魔方左侧大图片 上传正确格式的图片',
         'image_magic_top.image' => '请给 魔方右侧正方形图片 上传正确格式的图片',
         'image_magic_buttom.image' => '请给 魔方右侧长方形图片 上传正确格式的图片',
         'is_show_pc.image' => '请选择PC端显示状态后再提交！',
         'is_show_wx.image' => '请选择移动端显示状态后再提交！',
         'is_show_wechat.image' => '请选择微信端显示状态后再提交！',
         'is_show_qq.image' => '请选择QQ端显示状态后再提交！',
       ];
    }
}
