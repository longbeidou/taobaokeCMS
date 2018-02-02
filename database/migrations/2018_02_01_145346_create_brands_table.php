<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->unique('id');
            $table->index('id');
            $table->char('name', 30);                   // 品牌分类的名称
            $table->integer('order')->default('0');     // 品牌分类排列顺序
            $table->integer('is_show')->default(1);     // 是否显示
            $table->char('image', 200);                 // 小图片地址
            $table->integer('total')->nullable();       // 包含的品牌总数
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
        Schema::dropIfExists('brands');
    }
}
