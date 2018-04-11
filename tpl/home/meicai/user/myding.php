<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';
if(!isset($_GET['lx'])){
    $_GET['lx'] = 1;
}
?>

    <section class="p-component-usercenter clearfix">
        <div class="sidebar s_ani" >
            <span class="arrow"  id="arr"></span>
            <ul class="list-unstyled">
                <li><a href="<?php echo mourl($CONN['userword'])?>"  >我的账户</a></li>
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
            <div class="tabmenu" id="uctabnav">
                <ul class="list-unstyled">
                    <li  ><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding').'&lx=1'?>" class="link"><span>未完成</span> <i class="interval">|</i></a></li>
                    <li  ><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding').'&lx=2'?>" class="link"><span>已完成</span> <i class="interval">|</i></a></li>
                    <li  ><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding').'&lx=3'?>" class="link"><span>已取消</span> <i class="interval">|</i></a></li>
                </ul>
                <div class="wrap-line">
                    <span class="line select<?php echo $_GET['lx']-1?>"></span>
                </div>
            </div>
            <div class="order-detail">
                <table id="html">
                    <thead>
                        <tr class="order-nav">
                            <th class="pdl">商品</th>
                            <th class="shop-pocket">实付金额(元)</th>
                            <th class="shop-status">订单状态</th>
                            <th class="shop-status">交易状态</th>
                            <th class="shop-operation">操作</th>
                        </tr> 
                    </thead>

                </table>
            </div>
        </div>
    </section>
<?php 
include QTPL.'foot.php';
?>

<script type="text/javascript">
    $(document).ready(function(){
        var PAGE = 1;
        var LX = '<?php echo $_GET['lx']?>';
        mui.ajax(HTTP+'json.php',{
            data:{ y:'ding',d:'get',type:LX,page:PAGE },
            datatype:'json',
            type:'post',
            timeout:10000,
            success:function(data){
                var DATA = data.data;
                console.log(DATA);
                var html = '';
                mui.each(DATA,function(index,item){
                    html += '<tbody><tr class="step"></tr><tr><td colspan="7" class="detail"><span class="order-time">'+item.atime+'</span><span>订单号:'+item.orderid+'</span></td></tr><tr class="shop-list"><td class="shop-info"><ul><li class="shop-img"><a href="/prodetail/index/15787"><img src="'+item.tupian+'" alt=""></a></li><li class="shop-character"><a href="/prodetail/index/15787">'+item.name+'</a></li></ul></td><td class="member-border special" rowspan="1"><p class="logoColor">'+item.shifu+'</p></td><td class="member-border special" rowspan="1"><p data-status="wait-receive">'+item.faoffname+'</p></td><td class="member-border special" rowspan="1"><p data-status="wait-receive">'+item.offname+'</p></td><td class="special member-border location" rowspan="1"><p><a href="'+item.url+'">查看订单</a></p><div class="logistics-search"><div class="logistics-content"></div></div></td></tr></tbody>';
                });
                $('#html').append(html);



            },error:function(xhr){
                console.log(xhr);
            }
        });
    });
</script>