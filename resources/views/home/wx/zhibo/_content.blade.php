@inject('zhibo', 'App\Presenters\ZhiBoPresenter')
@inject('image', 'App\Presenters\ImageSrcShowFrom')
@foreach($coupons as $key => $coupon)
<div class="mui-row">
	<div class="mui-col-xs-12" style="text-align: center; margin: 10px 0px 5px;">
		<span style="color: #555555; font-size: 14px;">{{ $zhibo->daoJiShi($key, count($coupons), 1) }}</span>
	</div>
	<!--图片-->
	<div class="mui-col-xs-12">
		<!-- <a href="#"> -->
			<div class="mui-row" style="padding-right: 10px;">
				<div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">
					<img src="/img/logo.jpg" height="40px" style="border-radius: 20px;" alt="" />
				</div>
				<div class="mui-col-xs-5" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px; margin-bottom: 10px;">
					<div class="dialogue-triangle"></div>
					<div style="text-align: center; padding: 5px;">
						<img src="{{ $image->imageSrc($coupon, $show_from) }}" width="100%" />
					</div>
				</div>
			</div>
		<!-- </a> -->
	</div>
	<!--文字信息-->
	<div class="mui-col-xs-12" style="margin-bottom: 10px;">
			<div class="mui-row" style="padding-right: 10px;">
				<div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">
					<img src="/img/logo.jpg" height="40px" style="border-radius: 20px;" alt="" />
				</div>
				<div class="mui-col-xs-10" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px;">
					<div class="dialogue-triangle"></div>
					<div>
						<p style="padding: 5px; font-size: 14px; margin-bottom: -10px;">
							原价{{ $coupon->price }}元,【券后只要{{ $coupon->price_now }}元】<br>
							{{ $coupon->goods_name }}
						</p>
						<hr style="border: 1px dotted #555555;" />
						<div class="mui-row" style="padding-bottom: 5px;">
							<div class="mui-col-xs-6">
								<span style="color: red; font-size: 16px; margin-left: 10px;">·领券省{{ $coupon->price-$coupon->price_now }}元</span>
							</div>
							<div class="mui-col-xs-6">
								<div style="border: 1px solid red; border-radius: 20px; width: 110px; background-color: red; color: #FFFFFF; font-size: 18px; font-weight: 800;">
                  <a class="a-can-do" style="color:#FFFFFF;" href="{{ route('home.couponInfo', $coupon->id) }}">
                    <span class="mui-icon mui-icon-plus" style="color: red; background-color: #FFFFFF; border-radius: 20px;"></span>领券购买
                  </a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</diV>
@endforeach
