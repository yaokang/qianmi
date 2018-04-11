<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'user/uheader.php';
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
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding')?>" >我的订单</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jifen');?>" >我的积分</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" >账户余额</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" class="cur">我的优惠券</a>
            	</li>
            	<li>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>" >在线充值</a>
            	</li>
            	<li>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" >基本资料</a>
            		<a href="/user/password.php" >密码修改</a>
            		<a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" >收货地址</a>
            	</li>
            </ul>
        </div>
        <div class="main coupon">
            <div class="tabmenu" id="uctabnav">
                <ul class="list-unstyled">
                    <li class="selected" id="id1"><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao').'&lx=1'?>" class="link"><span>未使用</span><em></em><i class="interval">|</i></a></li>
                    <li id="id2"><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao').'&lx=2'?>" class="link"><span>已使用</span><em></em> <i class="interval">|</i></a></li>
                    <li id="id3"><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao').'&lx=3'?>" class="link"><span>已过期</span><em></em> <i class="interval">|</i></a></li>
                </ul>
                <div class="wrap-line">
                    <span class="line select<?php echo $_GET['lx']-1?>"></span>
                </div>
            </div>
            <table class="table table-bordered">
                <tbody class="hongbao">
                    <tr class="active">
                        <th width="80">面值(元)</th>
                        <th width="130">获取原因</th>
                        <th width="80">使用情况</th>
                        <th width="150">使用范围</th>
                        <th width="80">金额限制</th>
                        <th class="text-center" width="108">使用时间</th>
                    </tr>
                </tbody>
            </table>
	        <!-- 翻页 -->
        </div>
    </section>
<!--底部 -->
<script type="text/javascript">
    var HTTP = '<?php echo WZHOST;?>';
    var page = '1';
    var num = '10';
    var LX = '<?php echo $_GET['lx']?>';
    if(LX == 1){
        $(".list-unstyled li").removeClass('selected');
        $("#id1").addClass('selected');
    }else if(LX == 2){
        $(".list-unstyled li").removeClass('selected');
        $("#id2").addClass('selected');
    }else if(LX==3){
        $(".list-unstyled li").removeClass('selected');
        $("#id3").addClass('selected');
    }
    mui.ajax( HTTP + 'json.php' ,{
        data:{y:'hongbaolist',d:'get',page:page,num:num,lx:LX},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){
            var hongbao = data.data;
            var count = hongbao.length;
            var html = '';
            if(LX == 1){
                $("#id1 em").html(count);
            }else if(LX==2){
                $("#id2 em").html(count);
            }else if(LX==3){
                $("#id3 em").html(count);
            }
            $.each(hongbao,function(name,value){
                var atime = value.atime;
                var gtime = value.gtime;
                var a = atime.substr(0,10);
                var g = gtime.substr(0,10);
                // console.log(a);
                // console.log(g);
                html += '<tr> <td><span class="VI-color2">'+value.jine+'</span></td> <td>全体客户10元无门槛优惠券</td> <td>未使用</td> <td>无门槛使用</td> <td>'+value.man+'</td> <td class="time"> '+a+' <br> —<br> '+g+' </td> </tr>';
            });
            $('.hongbao').append(html);
        },
        error:function(xhr){
            dataerror(xhr , '登录' );
        }
    });

    
</script>
<?php 
include QTPL.'foot.php'; 
?>