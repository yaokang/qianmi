<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';

?>


    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
          <span class="navbar-title">支付订单</span>
        </div>
      </div>
    </nav>
    <section class="m-component-order" id="m-order">
        <div class="container m-ordersuc">
            <div class="text-center m-ordersuc-tips">
                请您于15分钟内完成支付<br/>超时订单将取消
            </div>
            <div class="m-order-item">
                <a href="/user/orderdetail/160802432068" class="m-order-address">
                    订单金额：
                    <span class="order-cash">￥29.90</span>
                </a>
            </div>
                            <div class="m-order-remain zero">
                    <div class="fatherbox">
                        <span class="glyphicon fdayicon fdayicon-account"></span>
                        <p>
                            <span>账号余额抵扣</span>
                            <span class="nowremain">当前余额：0.00元 <em>(余额不支持购买充值卡)</em></span>
                        </p>
                    </div>
                </div>
                        <div class="m-payment-content " id="payment_content">
                <div class="m-order-item">
                        还需支付：
                        <span class="pull-right payelse" id="need_online_pay">￥29.90</span>
                </div>
                <!-- 支付方式-->
                 <ul class="list-unstyled m-payment-list">
                                                               <li ppid="1" payid="0">
                         <div class="m-payment-item">
                             <label for="pay1">
                                 <img src="http://imgws3.fruitday.com/assets/images/bank/app/1_0.png" style="height:20px;margin-right:16px;"/>支付宝
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay" style="display: block;" ></span>
                         </div>
                     </li>
                                          <li ppid="7" payid="0">
                         <div class="m-payment-item">
                             <label for="pay7">
                                 <img src="http://imgqn7.fruitday.com/assets/images/bank/app/7_0.png" style="height:20px;margin-right:16px;"/>微信支付
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay"  ></span>
                         </div>
                     </li>
                                          <li ppid="3" payid="00105">
                         <div class="m-payment-item">
                             <label for="pay3">
                                 <img src="http://imgws2.fruitday.com/assets/images/bank/app/3_00105.png" style="height:20px;margin-right:16px;"/>广发银行信用卡(银联)
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay"  ></span>
                         </div>
                     </li>
                                          <li ppid="3" payid="00106">
                         <div class="m-payment-item">
                             <label for="pay3">
                                 <img src="http://imgqn9.fruitday.com/assets/images/bank/app/3_00106.png" style="height:20px;margin-right:16px;"/>花旗银行(银联)
                                 <p class="activity">每周三专享，满99立减50元 ，每日限前1000名 本周名额已满</p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay"  ></span>
                         </div>
                     </li>
                                          <li ppid="3" payid="00102">
                         <div class="m-payment-item">
                             <label for="pay3">
                                 <img src="http://imgws1.fruitday.com/assets/images/bank/app/3_00102.png" style="height:20px;margin-right:16px;"/>浦发银行信用卡
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay"  ></span>
                         </div>
                     </li>
                                          <li ppid="3" payid="00003">
                         <div class="m-payment-item">
                             <label for="pay3">
                                 <img src="http://imgws1.fruitday.com/assets/images/bank/app/3_00003.png" style="height:20px;margin-right:16px;"/>中国建设银行
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay"  ></span>
                         </div>
                     </li>
                                                           </ul>
            </div>

            <div class="m-ordersuc-paybtn">
              <button type="button" class="btn btn-warning btn-block" id="pay">立即支付</button>
            </div>
            
        </div>    
    </section>

<div class="alert alert-warning m-order-tips" id="pay_send_code" role="alert" style="display:none;">
    <div class="input-group">
        <input type="number" class="form-control" id="identcode" placeholder="输入验证码" disabled />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" id="TestGetCode"><span>点击获取</span><span class="hide">还剩<b id="timeout">30</b>秒</span></button>
            </span>
    </div>
</div>

<input type="hidden" id="usermobile" value="13320908987">
<input type="hidden" id="is_can_balance" name="is_can_balance" value="1">
<input type="hidden" id="user_money" name="user_money" value="0.00">
<input type="hidden" id="money" name="money" value="29.90">
<input type="hidden" id="order_name" name="order_name" value="160802432068">
<input type="hidden" id="pay_parent_id" name="pay_parent_id" value="1">
<input type="hidden" id="is_pay" name="is_pay" value="1">
<input type="hidden" id="need_send_code" name="need_send_code" value="0">
<input type="hidden" id="is_balance" name="is_balance" value="0">

<script src="/js/require.js" data-main="/js/main"></script>
<script src="/js/lib/jquery-1.11.0.min.js"></script>
<script src="/js/statistics.js"></script>
<script src="/js/dsp-zz.js"></script>
<!-- <img src="" width="0" height="0" style="position: absolute;bottom: 0;left: 0;"/> -->
<!-- bi -->
<iframe src="/utrace" style="width: 0;height: 0;"></iframe>

</body></html>

<script>
    $(function(){
        //余额支付
        $('.m-order-remain:not(.zero)').on('click ',function(){
            var is_can_balance = $('#is_can_balance').val();
            var user_money = $('#user_money').val();
            var order_name = $('#order_name').val();

            if(is_can_balance == 0)
            {
                MessageBox.error('余额不支持购买充值卡');
                return;
            }
            else if(user_money <= 0)
            {
                MessageBox.error('余额不足');
                return;
            }
            else if(order_name == '')
            {
                MessageBox.error('订单异常，请返回首页');
                window.location.href = '/';
            }
            else
            {
                if($(this).hasClass('cur') ){
                    //取消使用余额
                    MessageBox.loading();

                    var data = {
                        'order_name':order_name
                    };

                    $.post('/ajax/order/cancelBalance',data,function(result_data){
                        MessageBox.unloading();
                        resp = eval('('+result_data+')');
                        if(resp['code']=='200'){
                            var need_pay = resp['msg']['need_online_pay'];
                            var s_pay_parent_id = resp['msg']['selectPayments']['pay_parent_id'];
                            $('#need_online_pay').html('￥'+need_pay);

                            var order_money = resp['msg']['order_money'];
                            $('#show_money').html(order_money+'元');
                            $('.order-cash').html('￥'+order_money);

                            if(s_pay_parent_id == -1)
                            {
                                $('#is_pay').val(0);
                            }

                            $('#is_balance').val(0);

                            $('#need_send_code').val(resp['msg']['need_send_code']);
                        }else{
                            MessageBox.error(resp.msg);
                        }
                    });
                    $('#payment_content').removeClass('un_pay');
                    $(this).removeClass('cur');

                    $("#pay_send_code").hide();
                }
                else{
                    //使用余额
                    MessageBox.loading();

                    var data = {
                        'order_name':order_name
                    };

                    $.post('/ajax/order/useBalance',data,function(result_data){
                        MessageBox.unloading();
                        resp = eval('('+result_data+')');
                        if(resp['code']=='200'){
                            var need_pay = resp['msg']['need_online_pay'];
                            $('#need_online_pay').html('￥'+need_pay);

                            var order_money = resp['msg']['order_money'];
                            $('#show_money').html(order_money+'元');
                            $('.order-cash').html('￥'+order_money);

                            if(need_pay == 0)
                            {
                                $('#payment_content').addClass('un_pay');
                                $('.m-payment-list li').children().children('span').hide();
                            }

                            $('#is_pay').val(1);
                            $('#is_balance').val(1);

                            $('#need_send_code').val(resp['msg']['need_send_code']);
                        }else{
                            MessageBox.error(resp.msg);
                        }
                    });

                    $(this).addClass('cur');
                }
            }
        });

        //支付方式
        $('.m-payment-list li').on('click',function(){
            $(this).children().children('span').show().parent().parent().siblings().children().children('span').hide();

            //变更支付方式
            var pay_parent_id = $(this).attr('ppid');
            var pay_id =  $(this).attr('payid');
            var order_name = $('#order_name').val();
            var user_money = $('#user_money').val();
            var money = $('#money').val();
            var is_balance = $('#is_balance').val();

            var data = {
                'pay_parent_id':pay_parent_id,
                'pay_id':pay_id,
                'order_name':order_name
            };

            if(parseFloat(user_money)  >= parseFloat(money) && is_balance == 1)
            {
                $('.m-payment-list li').children().children('span').hide();
                MessageBox.error('请取消选择余额后，再选择其他支付方式');
                return;
            }
            else{
                MessageBox.loading();

                $.post('/ajax/order/changePayMent',data,function(result_data){
                    MessageBox.unloading();
                    resp = eval('('+result_data+')');
                    if(resp['code']=='200'){
                        var need_pay = resp['msg']['need_online_pay'];
                        var order_money = resp['msg']['order_money'];
                        $('#need_online_pay').html('￥'+need_pay);
                        $('.order-cash').html('￥'+order_money);
                        $('#is_pay').val(1);
                        $('#need_send_code').val(resp['msg']['need_send_code']);
                    }else{
                        MessageBox.error(resp.data);
                    }
                });
            }
        });

        //立即支付
        $('#pay').on('click',function(){
            var is_pay = $('#is_pay').val();
            var order_name = $('#order_name').val();
            var need_online_pay = $('#need_online_pay').html().replace("￥","");
            var need_send_code = $('#need_send_code').val();
            var identcode = $('#identcode').val();

            if(isNaN(need_online_pay))
            {
                MessageBox.error('支付金额异常');
                return;
            }
            
            var pay_parent_id = $('#pay_parent_id').val();
            if(need_online_pay > 0 && pay_parent_id == 9)
            {
                MessageBox.error('请选择支付方式');
                return;
            }

            if(is_pay == 0)
            {
                MessageBox.error('请选择支付方式');
                return;
            }
            else
            {
                if(identcode !='' && need_send_code == 1)
                {
                    var checkData =  {
                        'order_name':order_name,
                        'identcode':identcode
                    };

                    $.post('/ajax/login/checkBalanceCode',checkData,function(result_data){
                        resp = eval('('+result_data+')');
                        if(resp['code']=='200'){
                            $('#pay').text("支付跳转中...");
                            $('#pay').attr('disabled',true);
                            mPay(order_name,need_online_pay);
                        }else{
                            MessageBox.error(resp.data);
                        }
                    });
                }
                else if(need_send_code == 1)
                {
                    balancePlay();
                }
                else
                {
                    $(this).text("支付跳转中...");
                    $(this).attr('disabled',true);
                    mPay(order_name,need_online_pay);
                }
            }
        });

    });


    function mPay(order_name,need_online_pay)
    {
        var pdata = {
            'order_name':order_name,
            'need_online_pay':need_online_pay
        };
        $.post('/ajax/order/checkPay',pdata,function(result_data){
            resp = eval('('+result_data+')');
            if(resp['code']=='200'){
                var data = {
                    'order_name':order_name
                };
                $.post('/ajax/order/orderPay',data,function(result_data){
                    resp = eval('('+result_data+')');
                    if(resp['code']=='200'){
                        window.location.href = resp['msg'];
                        $("#pay").attr('disabled',false);
                    }else{
                        $("#pay").text("立即支付");
                        $("#pay").attr('disabled',false);
                        MessageBox.error(resp.msg);
                    }
                });
            }else{
                $("#pay").text("立即支付");
                $("#pay").attr('disabled',false);
                MessageBox.error(resp.msg);
                window.location.reload();
            }
        });
    }

    /*余额支付验证码*/
    function balancePlay(){
        $("#pay_send_code").show();
        var $submit=$('#pay'),
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
            var data = {
                'mobile':usermobile
            };
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
</script>
