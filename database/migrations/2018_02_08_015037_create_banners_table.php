<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->unique('id');
            $table->index('id');
            $table->char('name', 90);                   // banner简介
            $table->char('link', 200);                  // 链接
            $table->integer('order')->default('0');     // 排列顺序
            $table->integer('is_show')->default(1);     // 是否显示, 1表示显示，0表示不显示
            $table->char('flat', 2)->default('wx');     // banner显示的位置，默认是wx，
            $table->char('image', 200);                 // 图片地址
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
        Schema::dropIfExists('banners');
    }
}
