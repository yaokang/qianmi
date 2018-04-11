$(function(){
    /*时间选择事件start*/
    $('#ordertime').on('click',function(){
        var address_id = $("#address_id").val();
        if(address_id){
            $('.modal-ordertime').modal('show');
            $('.modal-open').height($(window).height()-92);
            getTimes();
        }else{
            MessageBox.error('请先选择配送地址');
        }
    });
    /*时间选择事件end*/
    
    /*支付方式选择事件start*/  
    $('#orderpay').on('click', function(){
        var address_id = $("#address_id").val();
        if(address_id){
            $('.modal-orderpay').modal('show');
            $('.modal-open').height($(window).height()-92);
            getPayment();
        }else{
            MessageBox.error('请先选择配送地址');
        }
    });
    /*支付方式选择事件end*/  

    /*积分使用事件start*/
    $('#myonoffswitch').change(function(){
        $(this).attr('disabled',true);
        var checkbox_obj=$('#myonoffswitch'),
            _val = checkbox_obj.val();
        if(_val==='0'){
            var fun = 'useJf';
            var checkbox_obj_val = '1';
        }else{
            var fun = 'cancelUseJf';
            var checkbox_obj_val = '0';
        }
        var jf_money = $("#order_use_jf").val();
        useJf(fun,jf_money,checkbox_obj,checkbox_obj_val);
    });
    $("#order_use_jf").blur('input propertychange', function() {
       var checkbox_obj=$('#myonoffswitch');
       var jf_money = $(this).val();
       useJf("useJf",jf_money,checkbox_obj,"1");
    });
    /*积分使用事件end*/

    /*发票事件start*/
    $('#myonoffswitch2').change(function(){
        $(this).attr('disabled',true);
        var checkbox_obj=$('#myonoffswitch2'),
            _val = checkbox_obj.val();
        if(_val==='0'){
            var fun = 'useInvoice';
            var checkbox_obj_val = '1';
            var fp = '个人';
        }else{
            var fun = 'cancelInvoice';
            var checkbox_obj_val = '0';
            var fp = ''
        }
        useInvoice(fun,fp,checkbox_obj,checkbox_obj_val);
    });

    /*发票事件end*/

    /*订单提交start*/
    orderVerify();
    /*订单提交end*/

    /*余额支付验证码start*/
    var pay_parent_id = $("#pay_parent_id").val();
    if(pay_parent_id==5){
        balancePlay();
    }
    /*余额支付验证码end*/

    /*错误提示start*/
    var order_error = $("#order_error").val();
    if(order_error){
        MessageBox.error(order_error);
    }
    
    /*错误提示end*/
});

/*时间选择事件*/
function getTimes(){
    if($('.table-ordertime-unselect').length){
        var objEvt = $._data($('.modal-ordertime input[name="radiodelivery"]')[0], "events");
        if (!objEvt){
            $('.modal-ordertime input[name="radiodelivery"]').on('change', function(){
                var data_obj= $(this).parents('.table-ordertime-unselect').find(".s_tr");
                var time_obj= $(this).parents('.s_td');
                choseSendTime(data_obj,time_obj);
            });
        }
    }else{
        /*选中状态start*/
        var datakey = $("#shtime").val();
        var timekey = $("#stime").val();
        $("tbody tr[datakey = '"+datakey+"']").find("td[timekey = '"+timekey+"'] div").addClass('active');
        $("tbody tr[datakey = '"+datakey+"']").find("td[timekey = '"+timekey+"'] input").attr('checked',true);
        /*选中状态end*/
        /*修改事件start*/
        var objEvt = $._data($('.modal-ordertime input[name="ordertime"]')[0], "events");
        if (!objEvt){
            $('.modal-ordertime input[name="ordertime"]').on('change', function(){
                var data_obj= $(this).parents('.s_tr');
                var time_obj= $(this).parents('.s_td');
                choseSendTime(data_obj,time_obj);
            });
        }
        /*修改事件end*/
    }            
    $('.modal-ordertime .m-dialog-close').on('click', function(){
        $(this).parents('.modal-ordertime').modal('hide');
    })
}

/*选择配送时间*/
function choseSendTime(data_obj,time_obj){
    var data = {
        'send_date':data_obj.attr('datakey'),
        'send_time':time_obj.attr('timekey')
    };
    $.post('/ajax/order/choseSendtime',data,function(result_data){
        resp = eval('('+result_data+')');
        if(resp['code']=='200'){
            a=data_obj.attr('datavalue');
            b=time_obj.attr('timevalue');
            $("#shtime").val(data_obj.attr('datakey'));
            $("#stime").val(time_obj.attr('timekey'));
            $('.input-group').removeClass('active');
            $('.modal-ordertime').modal('hide');
            $('#ordertime>span').text(a+' '+b); 
            /*更新运费start*/
            $('#method_money').text('¥'+resp['msg'].method_money);
            $('#method_money').attr('money',resp['msg'].method_money);
            /*更新运费end*/
            /*更新积分使用金额start*/
            updateJfMoney(resp['msg'].order_jf_limit,resp['msg'].jf_money);
            /*更新积分使用金额end*/
            orderMoney();
        }else{
            MessageBox.error(resp.msg);
        }
    });
}

/*更新积分使用*/
function updateJfMoney(order_jf_limit,jf_money){
    $("#order_jf_limit").text(order_jf_limit);
    if(jf_money>0){
        var use_jf_money = jf_money;
         $('#use_jf_money').attr('money',use_jf_money);
         $('#use_jf_money font').text(use_jf_money);
    }else{
        var use_jf_money = order_jf_limit;
    }
    $('#order_use_jf').attr('orderusejf',use_jf_money);
    $('#order_use_jf').val(use_jf_money);
   
    
}

/*选择支付方式*/
function chosePayment(pay_parent_id,pay_id,payment_name){
    var data = {
        'pay_parent_id':pay_parent_id,
        'pay_id':pay_id
    };
    $.post('/ajax/order/chosePayment',data,function(result_data){
        resp = eval('('+result_data+')');
        if(resp['code']=='200'){
            $('.modal-orderpay').modal('hide');
            $('#orderpay>span').text(payment_name);
            $('#pay_discount').text('¥'+resp['msg'].pay_discount);
            $('#pay_discount').attr('money',resp['msg'].pay_discount);
            $("#pay_parent_id").val(pay_parent_id);
            if(pay_parent_id==5){
                
                balancePlay();
            }else{
                if($("#order-submit").attr('disabled')=='disabled'){
                    $("#order-submit").removeAttr('disabled').removeClass('btn-default').addClass('btn-warning');
                }
                $("#pay_send_code").hide();
            }
            updateJfMoney(resp['msg'].order_jf_limit,resp['msg'].jf_money);
            orderMoney();
            if(resp['msg'].has_invoice=='0'){
                $("#fp_li").hide();
                if($('#myonoffswitch2').val()==1){
                    $("#myonoffswitch2").click();
                }
            }else if(resp['msg'].has_invoice=='1'){
                $("#fp_li").show();
            }
        }else{
            if(resp['code']=='700'){
                MessageBox.confirm(resp.msg,toBindMobile);
            }else if(resp['code']=='600'){
                MessageBox.confirm(resp.msg,toAddMoney);
            }else{
                MessageBox.error(resp.msg);    
            }
            
        }
    });
}

function toBindMobile(){
    window.location.href="/user/mobile";
}

function toAddMoney(){
    window.location.href="/user";   
}

/*支付方式选择事件*/
function getPayment(){
    var objEvt = $._data($('.modal-orderpay input[name="radiopay"]')[0], "events");
    if (!objEvt){
        $('.modal-orderpay input[name="radiopay"]').on('change',function(){
            var pay_parent_id = $(this).parent().find(".pay_parent_id").val();
            var pay_id = $(this).parent().find(".pay_id").val();
            //var payment_name = $(this).parent().find(".payment_name").val()+'-'+$(this).parent().find(".pay_name").val();
            var payment_name = $(this).parent().find(".payment_name").val();
            chosePayment(pay_parent_id,pay_id,payment_name);
        });
    }
    $('.modal-orderpay .m-dialog-close').on('click', function(){
        $(this).parents('.modal-orderpay').modal('hide');
    })
}

/*使用积分*/
function useJf(fun,jf_money,checkbox_obj,checkbox_obj_val){
    var data = {
        'jf':jf_money
    };
    $("#order-submit").attr('disabled','disabled');
    MessageBox.loading();
    $.post('/ajax/order/'+fun,data,function(result_data){
        MessageBox.unloading();
        $("#order-submit").removeAttr('disabled');
        $("#myonoffswitch").attr('disabled',false);
        resp = eval('('+result_data+')');
        if(resp['code']=='200'){
            checkbox_obj.val(checkbox_obj_val);
            if(checkbox_obj_val=='1'){
                $("#use_jf_money").text("¥"+jf_money);
                $("#use_jf_money").attr('money',jf_money);
                $("#order_use_jf").attr('orderusejf',jf_money);
            }else if(checkbox_obj_val=='0'){
                $("#use_jf_money").text("¥0");
                $("#use_jf_money").attr('money',0);
            }
            orderMoney();
        }else{
            $("#order_use_jf").val($("#order_use_jf").attr('orderusejf'));
            MessageBox.error(resp.msg);
        }
    });
}

/*订单发票*/
function useInvoice(fun,fp,checkbox_obj,checkbox_obj_val){
    var data = {
        'fp':fp
    };
    $.post('/ajax/order/'+fun,data,function(result_data){
        $("#myonoffswitch2").attr('disabled',false);
        resp = eval('('+result_data+')');
        if(resp['code']=='200'){
            checkbox_obj.val(checkbox_obj_val);
            if(checkbox_obj_val=='1'){
                var fp_name='个人';
            }else if(checkbox_obj_val=='0'){
                var fp_name='请选择';
            }
            $("#fp").val(resp['msg'].fp);
            $("#integral-fp span").text(fp_name);
            updateJfMoney(resp['msg'].order_jf_limit,resp['msg'].jf_money);
            orderMoney();
        }else{
            MessageBox.error(resp.msg);
        }
    });
}

/*商品金额计算*/
function orderMoney(){
    var goods_amount = $("#goods_amount").attr("money");
    var method_money = $("#method_money").attr("money");
    var pmt_goods    = $("#pmt_goods").attr("money");
    var use_jf_money = $("#use_jf_money").attr("money");
    var card_money   = $("#card_money").attr("money");
    var pay_discount = $("#pay_discount").attr("money");
    var ordermoney = parseFloat(goods_amount)+parseFloat(method_money)-parseFloat(pmt_goods)-parseFloat(use_jf_money)-parseFloat(card_money)-parseFloat(pay_discount);

    $("#order_money span").text(ordermoney.toFixed(2));
}

/*订单提交*/
function orderVerify(){
    $('#order-submit').on('click',function(){
        MessageBox.loading();
        $("#order-submit").attr('disabled','disabled');
        var pay_parent_id = $("#pay_parent_id").val();
        if(pay_parent_id==5){
            var data = {
                "verification_code":$("#identcode").val()
            };
        }else{
            var data = {};
        }
        $.post('/ajax/order/createOrder',data,function(result_data){
            $("#order-submit").removeAttr('disabled');
            MessageBox.unloading();
            resp = eval('('+result_data+')');
            if(resp['code']=='200'){
                if(pay_parent_id == 4)
                {
                    window.location.href="/order/succ/"+resp['msg'];
                }
                else
                {
                    window.location.href="/order/payDesk/"+resp['msg'];
                }
				localStorage['cartcount'] = 0;
            }else{
                x=$('<div class="alert alert-danger m-order-tips" role="alert">'+resp['msg']+'</div>'),
                $('.m-component-foot').before(x);
                if(pay_parent_id==5){
                    $('.m-order-tips.alert-danger').css({'bottom':102})
                }
            }
        });

        $('#m-order').on('click',function(){
            $('.m-order-tips').fadeOut(200);
        });
    });
}

/*余额支付验证码*/
function balancePlay(){
    $("#pay_send_code").show();
    var $submit=$('#order-submit'),
        $code=$('#identcode'),
        $btn=$('#TestGetCode');
        if($code.val()==''){
            $submit.attr('disabled','true').removeClass('btn-warning').addClass('btn-default');
        }
        $code.on('keydown', function(){
            $submit.removeAttr('disabled').removeClass('btn-default').addClass('btn-warning');
        });
        
        $btn.on('click', function(){
            var $this = $(this);
            var usermobile = $("#usermobile").val();
            data = {
                'mobile':usermobile
            }
            $.post('/ajax/login/sendVerCode',data,function(result_data){
                resp = eval('('+result_data+')');
                if(resp['code']=='200'){
                    $this.find('span:eq(0)').hide().end().find('span:eq(1)').removeClass('hide').end().attr({'disabled':''});
                    $code.removeAttr('disabled'); 
                    countdown();        
                }else{
                    MessageBox.error(resp.msg);
                }
            });
            
        });
}

/*余额支付验证码*/
function countdown(){
    var delay = $('#timeout').text();
    var t = setTimeout("countdown()", 1000);
    if (delay > 0) {
        delay--;
        $('#timeout').text(delay);
    } else {
        clearTimeout(t); 
        $('#TestGetCode').find('span:eq(0)').show().end().find('span:eq(1)').addClass('hide').end().removeAttr('disabled');
        $('#timeout').text(30);   
    }    
}
    