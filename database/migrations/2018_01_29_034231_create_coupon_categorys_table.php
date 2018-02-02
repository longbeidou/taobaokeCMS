<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_categorys', function (Blueprint $table) {
          $table->engine = 'MyISAM';

          $table->increments('id');
          $table->unique('id');
          $table->index('id');
          $table->string('category_name', 30);      // 分类的名称
          $table->string('self_where');             // 自定义条件
          $table->char('image_small', 200);       // 小图片地址
          $table->char('font_icon', 50)->nullable();       // 字体图标
          $table->integer('order')->default('0');   // 分类排列顺序
          $table->integer('is_show')->default('1'); // 分类是否显示，1表示显示，0表示不显示

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
        Schema::dropIfExists('coupon_categorys');
    }
}
