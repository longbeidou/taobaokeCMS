<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('id');
            $table->unique('id');
            $table->index('id');
            $table->char('goods_id',15);      //商品id
            $table->char('goods_name',120); //商品名称
            $table->string('image');          //商品主图
            $table->string('info_link');      //商品详情页链接地址
            $table->string('cate');           //商品一级类目
            $table->string('taobaoke_click_link');  //淘宝客链接
            $table->decimal('price',7,2);     //商品价格(单位：元)
            $table->integer('sales');     //商品月销量
            $table->decimal('rate',5,2);  //收入比率(%)
            $table->decimal('money',5,2); //佣金
            $table->string('seller_wangwang');   //卖家旺旺
            $table->string('seller_id');      //卖家id
            $table->string('shop_name')->nullable();//店铺名称
            $table->char('flat',6);       //平台类型
            $table->string('coupon_id');     //优惠券id
            $table->integer('coupon_total'); //优惠券总量
            $table->integer('coupon_last');  //优惠券剩余量
            $table->string('coupon_info');   //优惠券面额
            $table->date('coupon_begin_date');    //优惠券开始时间
            $table->date('coupon_end_date');      //优惠券结束时间
            $table->string('coupon_link');   //优惠券链接
            $table->string('coupon_promote_link');  //商品优惠券推广链接
            $table->decimal('price_now',7,2)->nullable();  //商品的现价(单位：元)
            $table->decimal('rate_sales',5,2)->nullable(); //商品的优惠幅度（单位：%）
            $table->char('is_recommend',1)->default('1'); //商品是否推荐，1表示推荐，0表示不推荐
            $table->char('is_show',1)->default('1'); //商品是否推荐，1表示显示，0表示不显示
            $table->char('tao_kou_ling',20)->nullable();   //淘口令
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
        Schema::dropIfExists('coupons');
    }
}
