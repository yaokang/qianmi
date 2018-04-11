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
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" class="cur">账户余额</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" >我的优惠券</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>"  >在线充值</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" >基本资料</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" >收货地址</a>
                </li>
            </ul>
        </div>
        <div class="main balance">
            <h5>您当前的余额为：<span class="VI-color2">￥<?php echo $USER['jine']?></span></h5>
            <table class="table table-bordered">

                <tbody class="jilu">
                    <tr class="active">
                        <th width="180">交易时间</th>
                        <th width="120">金额</th>
                        <th width="160">交易号</th>
                        <th>状态</th>
                    </tr>		
                </tbody>
            </table>
			
            <!-- 翻页 -->
			        </div>
    </section>
<!--底部 -->
<?php
include QTPL.'foot.php';
?>

<script type="text/javascript">
    $(document).ready(function(){
        mui.ajax(HTTP+'json.php',{
            data:{y:'jine',d:'get',page:1,num:16},
            datatype:'json',
            type:'post',
            timeout:10000,
            success:function(data){
                var jilu = data.data;
                // console.log(jilu);
                html8 = '';
                mui.each(jilu,function(index,item){
                    console.log(item);
                    html8 += '<tr ><th width="180">'+item.atime+'</th><th width="120">'+item.jine+'</th><th width="160">'+item.data+'</th><th>'+item.typename+'</th></tr>';
                });
                $('.jilu').append(html8);
            },error:function(xhr){
                console.log(xhr);
            }
        });
    });
</script>