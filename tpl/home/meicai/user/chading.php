<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';

$PAGE = 1;
$FAOFF   = logac('faoff');
$ORDERID = isset( $HTTP['2'] ) ? $HTTP['2'] : '';
$KUOMO   = isset( $HTTP['3'] ) ? $HTTP['3'] : 'cha';
$FAOFF = logac('faoff');
$PAYOFF = logac('payoff');
$PAYTYPE = xitongpay('-1');
if( $ORDERID == '' ) msgbox( '' , mourl( $CONN['userword'] ) );
$D = db('dingdan');
$DATAA = $D ->where( array( 'orderid' => $ORDERID) )-> find();
if( ! $DATAA || $DATAA['uid'] != $USERID || $DATAA['type'] != '0' ) msgbox( '' , mourl( $CONN['userword'] ) );
$PAYTYPE['0'] = '余额支付';
$D -> setbiao( 'dingdanx' );
$XQING = $D ->where( array('orderid' => $DATAA['orderid'] ))->select();
$FAHUODE = array();
foreach($XQING as $ONG){
    $token = md5( $ONG['biaoshi'].'_'. $ONG['beizhu'] );
    if( ! isset( $FAHUODE[ $token ] )) $FAHUODE[ $token ] = $ONG['biaoshi'].' '. $ONG['beizhu'];
}
//p($DATAA);
?>
<link href="<?php echo DQTPL?>css/mui.css" rel="stylesheet" type="text/css">
<section class="p-component-usercenter clearfix">
    <div class="sidebar s_ani" >
        <span class="arrow"  id="arr"></span>
        <ul class="list-unstyled">
	        <li>
                <a href="<?php echo mourl($CONN['userword'])?>"  >我的账户</a>
            </li>
            <li>
                <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding')?>" class="cur" >我的订单</a>
                <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jifen');?>" >我的积分</a>
                <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" >账户余额</a>
                <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" >我的优惠券</a>
            </li>
            <li>
                <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>" >在线充值</a>
            </li>
            <li>
                <a href="/user/basics.php" >基本资料</a>
                <a href="/user/password.php" >密码修改</a>
                <a href="/user/address.php" >收货地址</a>
                <a href="/user/notice.php" >通知设置</a>
            </li>
        </ul>
    </div>
    <div class="main">
        <h6><span>我的订单</span>&nbsp;&gt;&nbsp;查看订单</h6> 
        <!-- 收货信息 -->
        <div class="receive-info">
            <dl>
                <dt>收货信息</dt>
                <dd class="receive-common">收货人：<?php echo $DATAA['xingming']?></dd>
                <dd>手机号：<?php echo $DATAA['shouji']?></dd>
                <dd>收货地址：<?php echo $DATAA['shouhuo']?></dd>
            </dl>
        </div>
       <!--支付及配送方式  -->
        <div class="receive-info">
            <dl>
                <dt>支付及配送方式</dt>
                <dd class="receive-common">支付方式：<?php echo $PAYTYPE[$DATAA['paytype']];?></dd>
                <?php if( $DATAA['off'] == 2 && $DATAA['faoff']  > 1  && $FAHUODE  ){
                echo '';
                foreach( $FAHUODE as $ne ){
                    $wuliu = explode( ' ' , $ne );
                ?>
                <dd onclick="openurl('物流跟踪','https://m.kuaidi100.com/result.jsp?nu=<?php echo $wuliu['1'];?>');">查询物流：<?php echo $wuliu['0'];?>(点击查询物流)</dd>
                <?php } }?>
            </dl>
        </div>
        <!--备注  -->
        <div class="receive-info">
            <dl>
                <dt>备注</dt>
                <dd class="receive-common">发票：无填写</dd>
                <dd>留言：无填写</dd>
                <dd>贺卡：无填写</dd>
            </dl>
        </div>
        <div class="order-detail">
            <table>
                <thead>
                    <tr class="order-nav">
                        <th class="pdl">商品</th>
                        <th class="shop-price">单价(元)</th>
                        <th class="shop-number">数量</th>
                        <th class="shop-action"></th>
                        <th class="shop-pocket">实付金额(元)</th>
                        <th class="shop-status">交易状态</th>
                        <th class="shop-operation">付款状态</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr class="step"></tr>
                <!-- 待收货订单 -->
                    <tr>
                        <td colspan="7" class="detail">
                            <span class="order-time"><?php echo date('Y-m-d',$DATAA['atime'])?></span>
                            <span>订单号:<?php echo $DATAA['orderid']?></span>
                        </td>
                    </tr>
                    <?php
                        
                        $D -> setbiao( 'dingdanx' );
                        $XQING = $D ->where( array('orderid' => $DATAA['orderid'] ))->select();

                        $FAHUODE = array();

                        if( $XQING ){

                            $i = 0;
                            foreach( $XQING as $ONG ){
                                $i++;
                                $token = md5( $ONG['biaoshi'].'_'. $ONG['beizhu'] );

                                if( ! isset( $FAHUODE[ $token ] )) $FAHUODE[ $token ] = $ONG['biaoshi'].' '. $ONG['beizhu'];
                    
                    ?>  
                    <tr class="shop-list">
                        <td class="shop-info">
                            <ul>
                                <li class="shop-img">
                                    <a href="<?php echo WZHOST.'api.php?action=tiao&id='.$ONG['cpid']?>"><img src="<?php echo $ONG['tupian']?>" alt=""></a>
                                </li>
                                <li class="shop-character"><a href="/prodetail/index/17035"><?php echo $ONG['name']?></a></li>
                            </ul>
                        </td>
                        <td>
                            <p class="logoColor"><?php echo $ONG['jine']?></p>
                        </td>
                        <td>
                            <p><?php echo $ONG['num']?></p>
                        </td>
                        <td class="member-border commodity"></td>
                        <?php if($i == 1){?>
						<td class="member-border special" rowspan="100">
	                        <p class="logoColor"><?php echo $DATAA['payjine']?></p>
						</td>
						<td class="member-border special" rowspan="100">
						    <p data-status="wait-receive">已取消</p>
						</td>
						<td class="special member-border location" rowspan="100">
						    <p>
							    <p data-status="wait-receive">还未付款</p>
						    </p>
						</td>
                        <?php }?>
                    </tr>
                    <?php }}?>
                </tbody>

            </table>
        </div>
        <div class="total">
            <ul>
              <li>商品总价：<span>¥<?php echo $DATAA['payjine']?></span></li>
              <li>运费：<span>¥<?php echo $DATAA['yunfei']?></span></li>
              <li>积分抵扣：<span>¥0.00</span></li>
              <li>优惠券抵扣：<span>¥<?php echo $DATAA['hongjine']?></span></li>
              <li>账户余额抵扣：<span>¥0.00</span></li>
              <li>其他抵扣：<span>¥0</span></li>
            </ul>
            <div class="extra">
               实际应付款： <span>¥<?php echo $DATAA['payjine']?></span>
            </div>
        </div>
    </div>
</section>

<?php 
include QTPL.'foot.php';
?>
<script type="text/javascript">
    function openurl( title, url){

        mheight = $(window).height()-150;
        html = '<div style="width:100%;height:'+mheight+'px;"><iframe frameborder="0" src="'+url+'" style="width:100%;height:100%;"></iframe></div>';

        mui.alert(html,title,'关闭');

    }
</script>


 