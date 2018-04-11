<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';
//p($USER);

?>
    <section class="p-component-usercenter clearfix">
        <div class="sidebar s_ani" >
            <span class="arrow"  id="arr"></span>
            <ul class="list-unstyled">
                <li><a href="<?php echo mourl($CONN['userword'])?>" class="cur" >我的账户</a></li>
                <li>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding')?>"  >我的订单</a>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jifen');?>" >我的积分</a>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" >账户余额</a>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" >我的优惠券</a>
                </li>
                <li>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>" >在线充值</a>
                </li>
                <li>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" >基本资料</a>
                	<a href="/user/password" >密码修改</a>
                	<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" >收货地址</a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="member-tabmenu">
                <ul class="user">
                    
                </ul>
            </div>
            <!-- 个人信息 end-->
            <!-- 最近订单 -->
            <div class="order-detail">
                <h6>最近订单：</h6>
                <table>
                    <thead>
                        <tr class="order-nav">
                            <th class="pdl">商品</th>
                            <th class="shop-price">价格(元)</th>
                            <th class="shop-number">数量</th>
                            <th class="shop-action">商品操作</th>
                            <th class="shop-pocket">实付金额(元)</th>
                            <th class="shop-status">交易状态</th>
                            <th class="shop-operation">操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- 最近订单 end-->
        </div>
    </section>
<?php 
include QTPL.'foot.php';

?>