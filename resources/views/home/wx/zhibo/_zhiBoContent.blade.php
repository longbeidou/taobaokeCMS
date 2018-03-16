<div id="msg_end" style="height:0px; overflow:hidden"></div>
<script type="text/javascript">
  setInterval('addCoupons()',10*1000);
  function addCoupons()
  {
    <?php $show_from ? $code = 1 : $code = 0; ?>
    mui.ajax('{{route('home.zhibo.random')}}',{
    	data:{
        show_from: {{ $code }}
    	},
    	dataType:'json',//服务器返回json格式数据
    	type:'post',//HTTP请求类型
    	timeout:10000,//超时时间设置为10秒；
    	headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
      },
    	success:function(data){
    		//服务器返回响应，根据响应结果，分析是否登录成功；
        coupons(data);
    	},
    	error:function(xhr,type,errorThrown){
    		//异常处理；
    		console.log(type);
    	}
    });
  }

  function coupons(data)
  {
    str = '<div class="mui-row">'
    	str += '<div class="mui-col-xs-12" style="text-align: center; margin: 10px 0px 5px;">'
    		str += '<span style="color: #555555; font-size: 14px;">'+data.time+'</span>'
    	str += '</div>'
    	str += '<!--图片-->'
    	str += '<div class="mui-col-xs-12">'
    		// str += '<a href="#">'
    			str += '<div class="mui-row" style="padding-right: 10px;">'
    				str += '<div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">'
    					str += '<img src="/img/kefu.jpg" height="40px" style="border-radius: 20px;" alt="" />'
    				str += '</div>'
    				str += '<div class="mui-col-xs-5" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px; margin-bottom: 10px;">'
    					str += '<div style="position: absolute; top: 10px; left: -30px; width: 0px; height: 0px; border-width: 15px; border-style: solid; border-color: transparent #FFFFFF transparent transparent;"></div>'
    					str += '<div style="text-align: center; padding: 5px;">'
    						str += '<img src="'+data.img_src+'" width="100%" />'
    					str += '</div>'
    				str += '</div>'
    			str += '</div>'
    		// str += '</a>'
    	str += '</div>'
    	str += '<!--文字信息-->'
    	str += '<div class="mui-col-xs-12" style="margin-bottom: 10px;">'
    			str += '<div class="mui-row" style="padding-right: 10px;">'
    				str += '<div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">'
    					str += '<img src="/img/kefu.jpg" height="40px" style="border-radius: 20px;" alt="" />'
    				str += '</div>'
    				str += '<div class="mui-col-xs-10" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px;">'
    					str += '<div style="position: absolute; top: 10px; left: -30px; width: 0px; height: 0px; border-width: 15px; border-style: solid; border-color: transparent #FFFFFF transparent transparent;"></div>'
    					str += '<div>'
    						str += '<p style="padding: 5px; font-size: 14px; margin-bottom: -10px;">'
    							str += '原价'+data.price+'元,【券后只要'+data.price_now+'元】<br>'
    							str += data.goods_name
    						str += '</p>'
    						str += '<hr style="border: 1px dotted #555555;" />'
    						str += '<div class="mui-row" style="padding-bottom: 5px;">'
    							str += '<div class="mui-col-xs-6">'
    								str += '<span style="color: red; font-size: 16px; margin-left: 10px;">·领券省'+data.save_money+'元</span>'
    							str += '</div>'
    							str += '<div class="mui-col-xs-6">'
    								str += '<div style="border: 1px solid red; border-radius: 20px; width: 110px; background-color: red; color: #FFFFFF; font-size: 18px; font-weight: 800;">'
                      str += '<a class="a-can-do" style="color:#FFFFFF;" href="'+data.url+'">'
                        str += '<span class="mui-icon mui-icon-plus" style="color: red; background-color: #FFFFFF; border-radius: 20px;"></span>领券购买'
                      str += '</a>'
    								str += '</div>'
    							str += '</div>'
    						str += '</div>'
    					str += '</div>'
    				str += '</div>'
    			str += '</div>'
    	str += '</div>'
    str += '</diV>'

    mui('#content')[0].insertAdjacentHTML('beforeend', str);
    msg_end.scrollIntoView();
  }
</script>
