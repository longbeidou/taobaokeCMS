<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->unique('id');
            $table->index('id');
            $table->char('name', 30);                   // 分类的名称
            $table->integer('order')->default('0');     // 分类排列顺序
            $table->integer('is_show')->default(1);     // 是否显示
            $table->char('font_icon', 250)->nullable();  // 字体图标
            $table->char('image_small', 200);          // 小图片地址
            $table->char('image_magic_left', 200);          // 魔方排列左边最大的图片地址
            $table->char('image_magic_top', 200);          // 魔方排列上边小正方形图片地址
            $table->char('image_magic_buttom', 200);          // 魔方排列右边长方形图片地址
            $table->string('link_pc', 400);                     // pc端的链接
            $table->integer('is_show_pc')->default('1');      // pc端分类是否显示，1表示显示，0表示不显示
            $table->string('link_wx', 400);                     // wx端的链接
            $table->integer('is_show_wx')->default('1');      // wx端分类是否显示，1表示显示，0表示不显示
            $table->string('link_wechat', 400);                 // wechat端的链接
            $table->integer('is_show_wechat')->default('1');  // wechat端分类是否显示，1表示显示，0表示不显示
            $table->string('link_qq', 400);                     // QQ端的链接
            $table->integer('is_show_qq')->default('1');      // QQ端分类是否显示，1表示显示，0表示不显示

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorys');
    }
}
