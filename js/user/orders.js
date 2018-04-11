$(function() {
	scrollbottomadd();
	listOrderCancle();
	listOrderPay();
	listOrderConfirm();
})

var userOrdersEnd = false;
//滚动到底部加载
function scrollbottomadd(){
	var totalheight = 0;     //定义一个总的高度变量
	function loadDynamicdata(){ 
		totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());     //浏览器的高度加上滚动条的高度 
		if ($(document).height() <= totalheight)    //当文档的高度小于或者等于总的高度的时候，开始动态加载数据
		{ 
			var curr_area,curr_status_class;
			var type = parseInt($("#order_curr_type").val());
			var page = parseInt($("#order_curr_page").val())+1;
			switch(type){
				case 1:
					curr_area = '#undone';
					curr_status_class = 'm-ordering';
					break;
				case 2:
					curr_area = '#done';
					curr_status_class = 'm-ordersuc';
					break;
				case 3:
					curr_area = '#cancal';
					curr_status_class = 'm-ordercanl';
					break;
				default:
					return false;
					break;
			}
			$.ajax({
				type:"POST",
				url:'/ajax/user/orders',
				data: {
					type: type,
					page: page
				},
				beforeSend:function(){
					$(window).unbind('scroll', foo); 
					$('.ajax_loading').show() //显示加载时候的提示
				},
				success:function(data){
					if(data.code==200){
						var list_html = '<ul class="list-unstyled">';
						var list = data.msg;
						var list_status_html = '';
						if(list.length==0){
							MessageBox.errorFadeout("已经最后一页啦");
							userOrdersEnd = true;
						}
						$.each(list,function(k,val){
 							list_status_html = '<div class="m-orderfun">';
 							if(val.can_cancel=='true'){
 								list_status_html = list_status_html+'<button type="button" class="btn btn-default btn-sm btn-order-cancal">取消订单</button>';
 							}
 							if(val.can_pay=='true'){
 								list_status_html = list_status_html+'<button type="button" class="btn btn-default btn-sm">立即支付</button>';
 							}
 							if(val.can_confirm_receive=='true'){
 								list_status_html = list_status_html+'<button type="button" class="btn btn-default btn-sm btn-order-confirm">确定收货</button>';
 							}
 							list_status_html = list_status_html+'</div>';

							list_html = list_html+'<li>'+
								'<div class="m-orderinfo"><span class="pull-right '+curr_status_class+'">'+val.order_status+'</span>订单编号：'+val.order_name+'</div>'+
								'<a href="/user/orderdetail/'+val.order_name+'">'+
								'<img class="lazy pull-left" data-original="'+val.item[0].thum_photo+'" src="/images/DefaultImg@2x.png" alt>'+
								'<div class="m-cartlist-info"><h3>'+val.item[0].product_name+'</h3><h4>规格：'+val.item[0].gg_name+'</h4></div></a>'+
								'<div class="m-ordertotal"><span>共 <strong>'+val.item.length+'</strong> 件商品 </span><span>实付款<strong>￥'+val.money+'</strong></span></div>'+
								list_status_html+'</li>'; 
						});
						list_html = list_html+'</ul>';
						$(curr_area+" > .m-cartlist").append(list_html); //将ajxa请求的数据追加到内容里面       

						var order_curr_page = parseInt($("#order_curr_page").val()) + 1;
						$("#order_curr_page").val(order_curr_page);
						lazyloadImg();
					}
					setTimeout(function(){$(window).bind('scroll', foo)},800); 
					$('.ajax_loading').hide() //请求成功,隐藏加载提示
				},
				dataType: 'json'
			});
		} 
	} 

	var foo = function(){
		if(!userOrdersEnd){
			loadDynamicdata();
		}
	}
	$(window).bind('scroll', foo); 
}

function switchOrder(type){
	$("#order_curr_type").val(type);
	$("#order_curr_page").val(1);
	var curr_area,curr_status_class;
	type = parseInt(type);
	switch(type){
		case 2:
			userOrdersEnd = false;
			curr_area = '#done';
			curr_status_class = 'm-ordersuc';
			break;
		case 3:
			userOrdersEnd = false;
			curr_area = '#cancal';
			curr_status_class = 'm-ordercanl';
			break;
		default:
			userOrdersEnd = false;
			return false;
			break;
	}
	$.ajax({
				type:"POST",
				url:'/ajax/user/orders',
				data: {
					type: type,
					page: 1
				},
				beforeSend:function(){
					$(curr_area+" > .m-cartlist ul").remove();
					$(curr_area+" > .text-center").remove();
					MessageBox.loading();
				},
				success:function(data){
					if(data.code==200){
						var list_html = '<ul class="list-unstyled">';
						var list = data.msg;
						$.each(list,function(k,val){
							list_html = list_html+'<li>'+
								'<div class="m-orderinfo"><span class="pull-right '+curr_status_class+'">'+val.order_status+'</span>订单编号：'+val.order_name+'</div>'+
								'<a href="/user/orderdetail/'+val.order_name+'">'+
								'<img class="lazy pull-left" data-original="'+val.item[0].thum_photo+'" src="/images/DefaultImg@2x.png" alt>'+
								'<div class="m-cartlist-info"><h3>'+val.item[0].product_name+'</h3><h4>规格：'+val.item[0].gg_name+'</h4></div></a>'+
								'<div class="m-ordertotal"><span>共 <strong>'+val.item.length+'</strong> 件商品 </span><span>实付款<strong>￥'+val.money+'</strong></span></div>'+
								'</li>'; 
						});
						list_html = list_html+'</ul>';
						$(curr_area+" > .m-cartlist").append(list_html); //将ajxa请求的数据追加到内容里面       
					}else{
						$(curr_area).append('<div class="text-center"><span class="glyphicon fdayicon fdayicon-userorder"></span><h4>亲，您没有该状态下的订单信息哦~</h4></div>');
					}
					MessageBox.unloading();
					lazyloadImg();
				},
				dataType: 'json'
			});
}

function cancleOrder() {
	$.ajax({
		type: "POST",
		url: '/ajax/user/orderCancle',
		data: {
			order_name:order_name ,
		},
		success: function(data) {
			if(data.code==200){
				MessageBox.show('恭喜您，订单取消成功');
			}else{
				MessageBox.show(data.msg);
			}
		},
		dataType: 'json'
	});
}

// 取消订单
function listOrderCancle(){
	$("#undone").delegate('.btn-order-cancal','click',function(){
		var order_name = $(this).attr('data-order');
		MessageBox.confirm('亲，您真的要取消吗~',function(){
			$.ajax({
				type: "POST",
				url: '/ajax/user/orderCancle',
				data: {
					order_name:order_name ,
				},
				success: function(data) {
					if(data.code==200){
						location.reload();
						//$("#undone").load(location.href + ' #undone>*');
					}else{
						MessageBox.error('取消失败，请稍后再试');
					}
				},
				dataType: 'json'
			});
		});
	});
}

// 支付订单
function listOrderPay(){
	$("#undone").delegate('.btn-order-pay','click',function(){	
		var order_name = $(this).attr('data-order');
		$(this).text("支付跳转中...");
		$(this).attr('disabled',true);
        window.location.href="/order/payDesk/"+order_name;
		//data = {
		//	'order_name':order_name
		//};
        //$.post('/ajax/order/orderPay',data,function(result_data){
		//    resp = eval('('+result_data+')');
		//
		//    if(resp['code']=='200'){
		//        window.location.href = resp['msg'];
		//        $("#undone .btn-order-pay").attr('disabled',false);
		//    }else{
		//    	$("#undone .btn-order-pay").text("立即支付");
		//    	$("#undone .btn-order-pay").attr('disabled',false);
		//        MessageBox.error(resp.msg);
		//    }
		//});
		
	});
}

// 完成订单
function listOrderConfirm(){
	$("#undone").delegate('.btn-order-confirm','click',function(){
		var order_name = $(this).attr('data-order');
		MessageBox.confirm('是否确认完成？',function(){
			$.ajax({
				type: "POST",
				url: '/ajax/user/orderConfirm',
				data: {
					order_name:order_name ,
				},
				success: function(data) {
					if(data.code==200){
						location.reload();
						//$("#undone").load(location.href + ' #undone>*');
					}else{
						MessageBox.error('确认失败，请稍后再试');
					}
				},
				dataType: 'json'
			});
		});
	});
}
