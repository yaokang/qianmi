<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';

?>
    <section class="p-component-usercenter clearfix">
        <div class="sidebar s_ani" >
            <span class="arrow"  id="arr"></span>
            <ul class="list-unstyled">
            	<li><a href="<?php echo mourl($CONN['userword'])?>"  >我的账户</a></li>
            	<li>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding')?>"  >我的订单</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jifen');?>" class="cur">我的积分</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" >账户余额</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" >我的优惠券</a>
            	</li>
            	<li>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>" >在线充值</a>
            	</li>
            	<li>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" >基本资料</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" >收货地址</a>
            	</li>
            </ul>
        </div>
        <div class="main integral">
            <h5><div class="pull-right fs-1">注：订单积分会在确认收货后48小时内到账</div>您当前的积分为：<span class="VI-color2">0</span></h5>
            <table class="table table-bordered">

                <tbody class="jilu">
                    <tr class="active">
                        <th width="180">交易记录</th>
                        <th width="120">积分</th>
                        <th>备注</th>
                    </tr>
                </tbody>
            </table>
            <!-- 翻页 -->
			        </div>
    </section>

<?php 
include QTPL.'foot.php';

?>

<script type="text/javascript">
    $(document).ready(function(){
        mui.ajax(HTTP+'json.php',{
            data:{y:'jifen',d:'get',page:1,num:16},
            datatype:'json',
            type:'post',
            timeout:10000,
            success:function(data){
                var jifen = data.data;
                // /console.log(jifen);
                html8 = '';
                mui.each(jifen,function(index,item){
                    console.log(item);
                    html8 += '<tr><th width="180">'+item.data+'</th><th width="120">'+item.jine+'</th><th>'+item.typename+'</th></tr>';
                });
                $('.jilu').append(html8);
            },error:function(xhr){
                console.log(xhr);
            }
        });
    });
</script>