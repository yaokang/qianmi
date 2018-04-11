<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';

?>

    <section class="p-component-usercenter clearfix">
        <div class="sidebar s_ani" >
            <span class="arrow"  id="arr"></span>
            <ul class="list-unstyled">
                <li><a href="<?php echo mourl($CONN['userword'])?>">我的账户</a></li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding')?>"  >我的订单</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jifen');?>" >我的积分</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" >账户余额</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" >我的优惠券</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>"  class="cur" >在线充值</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" >基本资料</a>
                    <a href="/user/password" >密码修改</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" >收货地址</a>
                </li>
            </ul>
        </div>
        <div class="main recharge">
            <h5>
                 您当前的余额为：<span class="VI-color2">￥<?php echo $USER['jine']?></span> (充值积分即时到账)
            </h5>

            <div class="tabmenu" id="uctabnav">
                <ul class="list-unstyled">
                    <li class="selected"><a href="/user/recharge" class="link"><span>在线充值</span><i class="interval">|</i></a></li>
                </ul>
                <div class="wrap-line">
                    <span class="line select0"></span>
                </div>
            </div>

            <div class="recharge-con1">
                <div class="sum">
                    <h5>请选择充值金额：</h5>
                    <ul class="list-unstyled clearfix pay-account" id="recharge-sum">
                        <li price="500" class="cur">500元</li>
                        <li price="1000">1000元</li>
                        <li price="2000" >2000元</li>
                        <li><input type="text" value="" placeholder="输入金额" class="qijine">元</li>
                    </ul>
                </div>
                <div class="option-bd">
                    <ul class="no3" style="display: block;">
                        <div class="clearfix">
                        <?php  
                            $PAY = xitongpay( '0' );
                            if( $PAY ){ 
                                $z = 0;
                                echo '<input type="hidden" name="paytype" value="'.$PAY['0']['id'].'">';
                                foreach( $PAY as $ONG ){
                                    //p($ONG);
                        ?>
                            <li data="<?php echo $ONG['id']?>" style="float:left;margin-left:30px" class="haha">
                                <input type="radio" name="pay" id="pay" data-style="online" value="7" <?php echo $z=='0' ? 'checked':''?>>
                                <label for="pay7">
                                    <img src="<?php echo $ONG['suoluetu']?>" alt="" style="height:35px;"><span style="font-size: 20px; margin-left:5px;"><?php echo $ONG['name']?></span>
                                </label>
                            </li>
                        <?php $z++; } } ?>
                        
                        </div>
                    </ul>
                </div>
                <a href="javascript:void(0)" class="btn btn-success" role="button" id="paypay">立即充值</a>

            </div>
            <input type="hidden" name="zhifue" value="10">
            <div class="recharge-rules">
                <h5>用户需知： </h5>
                <ul class="list-unstyled">
                    <li><span>1.</span>单笔订单充值满1000元赠佳沛新西兰绿奇异果礼盒-20个礼盒装，价值108元。</li>
                    <li><span>2.</span>单笔订单充值满2000元赠美国华盛顿甜脆红地厘蛇果-20个+佳沛新西兰绿奇异果礼盒-20个礼盒装，价值207元。</li>
                    <li><span>3.</span>北京仓与广东仓单笔订单充值满1000元赠佳沛意大利绿奇异果礼盒-20个装，价值108元。</li>
                    <li><span>4.</span>北京仓与广东仓单笔订单充值满2000元赠美国华盛顿甜脆红地厘蛇果-20个+佳沛意大利绿奇异果礼盒-20个装，价值207元。</li>
                    <li><span>5.</span>使用充值卡充值不参与充值送赠品活动。</li>
                    <li><span>6.</span>余额提现时，若参与过充值活动，实际提现金额将扣除赠品价值。</li>
                    <li><span>7.</span>账户余额不支持购买券卡。</li>
                    <li><span>8.</span>如需申请充值发票，只支持申请开具3个月内充值的发票。</li>
                    <li><span>9.</span>活动区域：上海、上海崇明、江苏省、浙江省、安徽省、北京、天津、河北省、广东省</li>
                    <li><span>10.</span>充值卡充值无法开具发票</li>
                </ul>
            </div>
        </div>
    </section>
<?php
$_SESSION['paydd'] = time();
include QTPL.'foot.php';
?>

<script type="text/javascript">
$(function(){
    
    $(".haha").click(function(){
        data = $(this).attr('data');
        $( "[name=paytype]" ).val( data );
        $(this).find("#pay").prop("checked","checked");

    });

    $(".pay-account li").click(function(){

        jine = $(this).attr('price');
        $( "[name=zhifue]" ).val( jine );
        $(".xuzejine li").removeClass('mui-selected');
        $(this).addClass('mui-selected');


    });


    $(".qijine").change(function(){

        var shuliang = $(this).val() * 1;
        if( isNaN( shuliang ) ) shuliang = 1;
        if( shuliang <0.01) shuliang = 1;

        $(this).val( shuliang );

        $( "[name=zhifue]" ).val( shuliang );

    });


    $("#paypay").click( function(){

        mui.closePopup();

        var jine    = $("[name=zhifue]") .val();
        var paytype = $("[name=paytype]").val();

        mui.toast ('订单提交中...' ,{ duration:500,url: HTTP +'pay.php?y=pay&jine='+ jine + '&paytype='+paytype  });

    });


});
</script>