<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'user/uheader.php';
$orderid = $_GET['id'];
$D ->setbiao('dingdan');
$order = $D->where(array('tongyiid'=>$orderid))->find();

?>
<link href="<?php echo DQTPL?>css/order-online.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .grey{color:#999}
</style>
<!--中部开始-->
<div class="pay-succeed w-750">
    <div class="pay_content">
        <div class="succeed clearfix">
            <!-- 左边内容-->
            <div class="order_info clearfix pull-left">
                <div class="img pull-left">
                    <img src="<?php echo DQTPL?>images/common/suc.png" alt=""></div>
                <div class="payorders pull-left">
                    <p class="order">您已成功提交订单！</p>
                    <p class="min">请在15分钟内进行付款，超过时间后系统将自动取消订单！</p>
                    <div class="succeed-details clearfix">
                        <p class="ordernum">您的订单号:</p>
                        <p class="figure"><?php echo $orderid?></p>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
            <div class="pay_info pull-right">
                <p class="value">
                    <span></span>订单金额:
                    <strong id="really_pay">
                        ￥<?php echo $order['payjine']?>
                    </strong>元
                </p>
                <a clsss="view" href="/user/viewOrder/170216104380" target="_blank" >查看订单详情></a>
            </div>
        </div>
        <div id="balance_box" class="pay-box unselected clearfix">
            <span class="pull-left"></span>
            <div class="pull-left">
                <div class="remain_deduction">
                    账户余额抵扣
                </div>
            <span class="now-remain">
                当前余额：<em>￥<?php echo $USER['jine']?></em>
                元
                <em>(余额不支持购买充值卡 余额支付不支持开发票) </em>
             </span>
            </div>
            <div class= "remain_deduct pull-right">
                余额抵扣: <strong id="balance_deduction_money">￥<?php echo $USER['jine']?></strong>元
            </div>
        </div>

        

        <div class="pay-options">
            <div id="online-pay-title" class="pay_ways clearfix">
                <span class="pull-left choose" >请选择支付方式：</span>
                <span class="pull-right pay_remain" >还需支付：<strong id="need_online_pay">￥<?php echo $order['payjine']?></strong> 元</span>
            </div>
            <div class="option-bd">
                <ul id = "pay-ment">
                                   
                </ul>
                <input class="sure-pay" id="pay" type="image" src="<?php echo DQTPL?>images/common/sure-pay.png" value="确认支付方式">
            </div>
        </div>
    </div>
    <div class="succeed-notice clearfix">
        <div class="notice pull-left">
            <span>注意事项</span>
        </div>
        <div class="notice-details pull-left">
            <div>不支持无理由退换货</div>
            <div>
                48小时可退换货，如有疑问，请拨打 <em>400-720-0770</em>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        mui.ajax(HTTP+'json.php',{
            data:{y:'chongzhi',d:'get',lx:0},
            datatype:'json',
            type:'post',
            timeout:10000,
            success:function(data){
                var DATA = data.data;
                html = '';
                mui.each(DATA,function(index,item){
                    console.log(item);
                    html += '<li class="clearfix liebiao" ppid="8" payid="'+item.id+'"> <input type="hidden"> <span></span> <label> <img src="'+item.suoluetu+'" style="height: 25px; margin-right: 16px;"/> '+item.name+' </label> </li>';
                });
                $("#pay-ment").html(html);
            },error:function(xhr){

            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var PAYFF    = 0;
        var yue = '<?php echo $USER['jine']?>';
        var zhifu = '<?php echo $order['payjine']?>';
        var xiaid = '<?php echo $orderid?>';
        var TOKEN = '<?php echo $_GET['token']?>';
        var yue1 = parseFloat(yue);
        var zhifu1 = parseFloat(zhifu);
        $("#balance_box").click(function(){
            if( PAYFF == '0'){
                if( yue1 > 0 ){ 
                    PAYFF = 1;
                    $('#balance_box').removeClass('unselected');
                    $('#balance_box').addClass('selected');
                }else{
                    gdialog_info("余额不足");
                }
            }else{
                PAYFF = 0;
                $('#balance_box').removeClass('selected');
                $('#balance_box').addClass('unselected');
            }
        });
        $("#pay-ment").delegate('.liebiao','click',function(){
            var id = $(this).attr('payid');
            $("#paytype").val(id);
            $('.liebiao').removeClass('active');
            $(this).addClass('active');
        });

        $("#pay").click(function(){
            payfashi = $("#paytype").val(); /* 支付方式 */
            if( PAYFF == 1 ){
                cha = yue1 - zhifu1;
                if( cha >=0 ){
                    /*余额支付*/
                    payzhifu( xiaid );

                }else{
                    /*金额不足*/
                    layer.msg ( '支付中...'  ,{url:HTTP+ "pay.php?y=pay&jine="+(-cha)+"&paytype="+payfashi+"&order="+xiaid });
                }


           }else  layer.msg ( '支付中...'  ,{url:HTTP+ "pay.php?y=pay&jine="+zhifu1+"&paytype="+payfashi+"&order="+xiaid+"&cha=13" });
        })

        function payzhifu( payfs ){
            mui.ajax( HTTP + 'json.php' ,{
                data:{y:'ding',d:'put',dingid:payfs,ttoken: TOKEN},
                dataType:'json',
                type:'post',
                timeout:10000,
                success:function( data ){
                    if( data.token && data.token != '') TOKEN = data.token;
                    layer.msg ( data.code == -1  ? '支付失败查看详情' : '支付成功'  ,{url:"<?php echo mourl( $CONN['userword']. $CONN['fenge'].'myding');?>" });
                },error:function(xhr){
                    
                }
            });
        }
    });
</script>

<input type="hidden" id="jine" name="is_can_balance" value="<?php echo $order['payjine']?>">
<input type="hidden" id="paytype" name="user_money" value="">
<input type="hidden" id="order_id" name="order_id" value="<?php echo $orderid?>">
<input type="hidden" id="cha" value="">

<div id="payMent"></div>

<div id="p-dialog">

</div>



<!--底部 -->
<!--<section class="toolbarfoot">-->
    <!--<div class="toolbar-tab tab-card" style="bottom: 71px;">-->
        <!--<a href="/web/card_change" target="_blank">-->
            <!--<i class="tab-ico"></i>-->
            <!--<em class="tab-text">券卡</em>-->
        <!--</a>-->
    <!--</div>-->
    <!--<div class="toolbar-tab tab-top">-->
        <!--<a href="#" onclick="window.open('http://p.qiao.baidu.com/im/index?siteid=7860627&ucid=6965311','','width=800,height=600')">-->
            <!--<i class="tab-ico"></i>-->
            <!--<em class="tab-text">反馈</em>-->
        <!--</a>-->
    <!--</div>-->
    <!--<div class="toolbar-tab tab-feedback">-->
        <!--<a href="javascript:scrollTo(0,0);" >-->
            <!--<i class="tab-ico"></i>-->
            <!--<em class="tab-text">顶部</em>-->
        <!--</a>-->
    <!--</div>-->
<!--</section>-->

<?php include QTPL.'foot.php';?>