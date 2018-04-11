<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'user/uheader.php';
$D -> setbiao ( 'shouhuo' );
$DATA = array( 'diqu' => 0,'off' => 0 ) ;
$shuju = chengshiid($DATA['diqu']);
for($i = 0;$i< count($shuju) ; $i++){
  $shujus = chengshi($shuju[$i]);
  if($shuju[$i] > 0 )unset($shujus['0']);
}

?>
<input type="hidden" id="api_msg_type" value="">
<input type="hidden" id="api_msg" value="">
<input type="hidden" id="api_goto_url" value="">
<input type="hidden" id="order_error" value="">

<!-- 下单开始 -->
<section class="p-component-order" id="p-order">
    <h3><i class="iconfont pull-left">&#xe603;</i>填写并核对订单信息</h3>
    <h4><a href="javascript:;" class="pull-right" id="newAddress">新增收货地址</a>收货人信息</h4>
    <div class="order-item">
        <ul class="list-unstyled clearfix order-item-addresslist" id="orderAddressList">
        </ul>
        <ul  class="list-unstyled order-item-addresslist" id="orderAddressSwitch">
            <li>
                <span class="more">
                    <b>更多地址</b>
                    <a class=""></a>
                </span>
            </li>
        </ul>
    
    </div>
    <h4>支付方式</h4>
    <div class="order-item">
        <ul class="list-unstyled clearfix order-item-paylist" id="orderPayList">
            <li data-id="1|0" >在线支付</li>
            <!--<li data-id="1|0" >网银支付</li>-->
            <!--<li id="sc_payoff" data-id="9|0" >货到付款</li>-->
            <li data-id="8|0" class="balancepay">余额支付
                <div class="paytips">
                    <i class="iconfont">&#xe607;</i>
                    您的余额是：0.00元 <span class="fc-red">余额不足，<a href="/user/recharge" target="_blank">立即充值</a></span>
                </div>
            </li>
        </ul>
    </div>
    <h4><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'cart')?>" class="pull-right">修改购物车</a>配送信息</h4>
    <div class="order-item clearfix">
        <ul class="order-item-cartlist list-unstyled pull-right hehe">
           
        </ul>
        <div class="order-item-sendinfo pull-left" id="orderSendInfo">
            <h5 class="hasInvoice">
                <span id="Fpxg">
                    <a href="javascript:;" class="pull-right" id="modidyInvo">修改</a>
                </span>
                <span class="pull-left">发票信息</span>
                <span id="inv_ts">无</span>
            </h5>
            <h5 class="end clearfix">
                <textarea class="form-control pull-right" rows="3" placeholder="请填写备注信息" id="msg"></textarea>
                <span class="pull-left">备注信息</span>
            </h5>
            <div class="font-color">
                <span>运费：</span>
                <span class="VI-color2" id="ref_yf">￥0.00</span>
            </div>
        </div>
    </div>
    <h4>使用积分/优惠券</h4>
    <div class="order-item order-item-discount">
                <p>最多可抵扣￥0.00元，已抵扣<input type="text" class="form-control" placeholder="0"  value="0.00" id="jf"  data-last-id="0.00" data-limit-id="0.00">元</p>
                <p><span id="couponshow">抵扣码及优惠券:
            暂无
            </span><a href="javascript:;" id="modifyCoup">选择</a></p>
    </div>

    <div class="order-item-inall">
        <p class="text-right">商品总金额：<span id="all_total1">￥197.00</span></p>
        <p class="text-right">运费：<span id="all_yf">￥0.00</span></p>
        <p class="text-right">商品减免：<span>￥0</span></p>
        <p class="text-right">积分抵扣：<span id="all_jf">￥0.00</span></p>
        <p class="text-right">优惠券抵扣：<span id="all_cm">￥0.00</span></p>
        <p class="text-right">其他抵扣：<span id="all_pd">￥0.00</span></p>
    </div>

    <div class="order-item-last text-right">
        <a href="javascript:void(0);" class="pull-right" id="commitOrder">提交订单</a>
        <b class="pull-right"><span id="all_total"></span></b><span>应付金额</span>
    </div>
</section>

<!-- 添加地址信息 -->
<div id="p-dialog" class="dialog-open" style="display:none ;">
    <div class="dialog-mask"></div>
    <div class="dialog">
        <h5 class="dialog-til"><span class="pull-right iconfont guanbi"></span>新增收货人信息</h5>
        <div class="dialog-con">
            <form>
                <div class="formitem clearfix">
                    <label><span class="VI-color1">*</span>收货人</label>
                    <input type="text" class="inpText" maxlength="15" value="" id="name">
                </div>
                <div class="formitem clearfix">
                    <label><span class="VI-color1">*</span>选择地区</label>
                    <div class="inpSel">
                        <input type="hidden" value="" id="provice">
                        <span id="spsheng">省/直辖市</span>
                        <ul id="issheng" class="list-unstyled">
                            <?php foreach($shujus as $key => $val){?>
                            <li data-id="<?php echo $key?>"><?php echo $val?></li>
                            <?php }?>
                        </ul>
                    </div>

                    <div class="inpSel">
                        <input type="hidden" value="" id="city">
                        <span id="spcity">市</span>
                        <ul id="lscity" class="list-unstyled">
                        </ul>
                    </div>

                    <div class="inpSel sel1 disabl">
                        <input type="hidden" value="" id="area">
                        <span id="sparea">区／县</span>
                        <ul id="lsarea" class="list-unstyled">
                        </ul>
                    </div>
                </div>
                <div class="formitem clearfix">
                    <label><span class="VI-color1">*</span>详细地址</label>
                    <input type="text" class="inpText" value="" style="width:540px; *width:520px;" id="detailAddr">
                </div>
                <div class="formitem clearfix">
                    <label><span class="VI-color1">*</span>手机号码</label>
                    <input type="tel" class="inpText" value="" id="tel">
                </div>
                <div class="formitem clearfix">
                    <input type="checkbox" id="def" class="inpCheck" onclick="" value="1" checked><label for="def" style="width:auto;">设为为默认收货地址</label>
                </div>
                <div class="formitem clearfix">
                    <button type="button" class="btn btn-success" id="submit" onclick="shedit( 'post' );">保存收货人信息</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- 修改地址信息 -->
<div id="p-dialog1" class="dialog-open" style="display:none ;">
    <div class="dialog-mask"></div>
    <div class="dialog">
        <h5 class="dialog-til"><span class="pull-right iconfont guanbi1"></span>修改收货人信息</h5>
        <div class="dialog-con" id="ooo">
            
        </div>
    </div>
</div>

<?php include QTPL.'foot.php';?>

<script type="text/javascript">
    TOKEN = '<?php echo wenyiyz( 'shouhuo_'.$USERID ,  '' , $Mem );?>';
    var LOFROM = <?php echo json_encode( array( 'zhanghao' => '手机号/邮箱', 'pass' => '登录密码', 'epass' => '重复密码', 'code' => '信息验证码','vcode' => '图形验证码' ) );?>;
    mui.ajax(HTTP+'json.php',{
        data:{y:'gouwuche',d:'get'},
        datatype:'json',
        type:'post',
        timeout:10000,
        success:function(data){
            var DATA = data.data;
            html = '';
            var zongjia = 0;
            mui.each(DATA.data,function(index,item){
                mui.each(item,function(dage,vvv){
                    //console.log(vvv);
                    html += '<li><dl class="list-unstyled clearfix"><dt><img src="'+vvv.tupian+'" alt="" /></dt><dd><div class="protitle">'+vvv.name+'</div><div class="proinfo">￥'+vvv.jiage+' / '+vvv.beizhu+' <span>x '+vvv.num+'</span></div></dd></dl></li>';
                    var zhongjia = parseFloat(vvv.num*vvv.jiage);
                    zongjia += parseFloat(zhongjia);
                });
            });
            var cartprice = '￥'+zongjia.toFixed(2);
            $("body").find(".hehe").html(html);
            $("body").find("#all_total").html(cartprice);
            $("body").find("#all_total1").html(cartprice);
        },
        error:function(xhr){
        },
    });

    mui.ajax(HTTP+'json.php',{
        data:{y:'shouhuo',d:'get'},
        datatype:'json',
        type:'post',
        timeout:10000,
        success:function(data){
            var DATA = data.data;
            html = '';
            var del = 'delete';
            mui.each(DATA,function(index,item){
                if(index == 0){
                    if(item.off == 1){
                        var dizhi = '默认地址';
                    }else{
                        var dizhi = item.xingming;
                    }
                    var cla = 'cur ttt';
                    var style = '';
                }else{
                    var dizhi = item.xingming;
                    var style = 'display: none;';
                    var cla = '';
                }
                html += '<li class="clearfix '+cla+'"  id="'+item.id+'" style="'+style+'"><span class="tag">'+dizhi+'</span><span class="pull-left">'+item.beizhu+'</span><span class="operate"><a href="javascript:edit('+item.id+');" class="modifyAddress" id="'+item.id+'">编辑</a><a href="javascript:;" class="deleteAddress" id="'+item.id+'" >删除</a><input type="hidden" name="addr_id" value="7622933"><input type="hidden" name="province_id" value="1"><input type="hidden" name="area_id" value="15367"></span></li>';
            });
            $("body").find("#orderAddressList").html(html);
        },
        error:function(xhr){},
    });

</script>

<script type="text/javascript">
//点击弹出添加地址弹框
    $("body").find("#newAddress").click(function(){
        $('#p-dialog').show();
    });
    $("body").find(".guanbi").click(function(){
        $('#p-dialog').hide(500);
    });
    $("body").delegate('.guanbi1','click',function(){
        $("#p-dialog1").hide(500);
    });
//点击选择省级地址
    $("body").find("#spsheng").click(function(){
        $('#issheng').slideDown(200);
    });
    $("#p-dialog").not(".inpSel").click(function(){
        $('#issheng').slideUp(200);
    });
    $("#p-dialog1").not(".inpSel").click(function(){
        $('#issheng1').slideUp(200);
    });
    $("#p-dialog1").not(".inpSel").click(function(){
        $('#lscity1').slideUp(200);
    });
    $("#p-dialog1").not(".inpSel").click(function(){
        $('#lsarea1').slideUp(200);
    });
    $(".inpSel").click(function(){
        return false;
    });
    $("#issheng li").click(function(){
        var val = $(this).attr('data-id');
        var html = $(this).html();
        $("#provice").val(val);
        $("#spsheng").html(html);
        $('#issheng').slideUp(200);
        shiji0(val);
    });

//点击删除地址
    $("body").delegate('.deleteAddress','click',function(){
        var id = $(this).attr('id');
        mui.ajax(HTTP+'json.php',{
            data:{y:'shouhuo',d:'delete',id:id,ttoken:TOKEN},
            datatype:'json',
            type:'post',
            timeout:10000,
            success:function(data){
                alert('删除成功');
                location.reload() ;
            },error:function(xhr){

            }
        });

    });

    function shiji0(id){

        if( id < 1){
   
            if(  $("#shisso1").length) $("#shisso1").remove();
            if(  $("#shisso2").length) $("#shisso2").remove();

            $("#yuandiqu").val('0');
            return ;
        }

        if( $("#shisso2").length ) $("#shisso2").remove();

        $.getJSON("<?php echo $CONN['dir']?>api.php?action=chenshi&id=" + id ,function( FANHUI ){

            if( FANHUI.code == 1 ){

                var html = '';
                var shuju = FANHUI.data;

                if( shuju ){

                    var get  = 0 ;
                    var  ii = 0;
                    $.each( shuju, function( i , field ){
                        html += '<li data-id="'+i+'">'+field+'</li>';
                    });

                    $("body").find("#lscity").html(html);
                    //点击弹出市级地址
                    $("body").find("#spcity").click(function(){
                        $("#lscity").slideDown(200);
                    });
                    $("#p-dialog").not(".inpSel").click(function(){
                        $('#lscity').slideUp(200);
                    });
                    $(".inpSel").click(function(){
                        return false;
                    });
                    $("#lscity li").click(function(){
                        var val = $(this).attr('data-id');
                        var html = $(this).html();
                        $("#city").val(val);
                        $("#spcity").html(html);
                        $('#lscity').slideUp(200);
                        shiji1(val);
                    });

                }

            }

        });
    }

    function shiji1( id ){

        $.getJSON("<?php echo $CONN['dir']?>api.php?action=chenshi&id=" + id ,function( FANHUI ){

            if( FANHUI.code == 1 ){

                var html  = '';
                var shuju = FANHUI.data;
                var  ii   = 0;
                if( shuju ){
                    $.each( shuju, function( i, field){
                        //console.log(field);
                        html += '<li data-id="'+i+'">'+field+'</li>';
                    });
                //添加地址
                    $("body").find("#lsarea").html(html);
                    //点击弹出县级地址
                    $("body").find("#sparea").click(function(){
                        $("#lsarea").slideDown(200);
                    });
                    $("#p-dialog").not(".inpSel").click(function(){
                        $('#lsarea').slideUp(200);
                    });
                    $(".inpSel").click(function(){
                        return false;
                    });
                    $("#lsarea li").click(function(){
                        var val = $(this).attr('data-id');
                        var html = $(this).html();
                        $("#area").val(val);
                        $("#sparea").html(html);
                        $('#lsarea').slideUp(200);
                    });

                }

            }
        });
    }

    function shiji2( id ){

        $.getJSON("<?php echo $CONN['dir']?>api.php?action=chenshi&id=" + id ,function( FANHUI ){

            if( FANHUI.code == 1 ){

                var html  = '';
                var shuju = FANHUI.data;
                var  ii   = 0;
                if( shuju ){
                    $.each( shuju, function( i, field){
                        //console.log(field);
                        html += '<li data-id="'+i+'">'+field+'</li>';
                    });
                //添加地址
                    $("body").find("#lsarea1").html(html);
                    //点击弹出县级地址
                    $("#lsarea1").slideDown(200);
                   
                    $("#lsarea1 li").click(function(){
                        var val = $(this).attr('data-id');
                        var html = $(this).html();
                        $("#area1").val(val);
                        $("#sparea1").html(html);
                        $('#lsarea1').slideUp(200);
                    });

                }

            }
        });
    }


    function shiji3(id){


        $.getJSON("<?php echo $CONN['dir']?>api.php?action=chenshi&id=" + id ,function( FANHUI ){

            if( FANHUI.code == 1 ){

                var html = '';
                var shuju = FANHUI.data;

                if( shuju ){

                    var get  = 0 ;
                    var  ii = 0;
                    $.each( shuju, function( i , field ){
                        html += '<li data-id="'+i+'">'+field+'</li>';
                    });

                    $("body").find("#lscity1").html(html);
                    //点击弹出市级地址
                    $("#lscity1").slideDown(200);

                    $("#lscity1 li").click(function(){
                        var val = $(this).attr('data-id');
                        var html = $(this).html();
                        $("#city1").val(val);
                        $("#spcity1").html(html);
                        $('#lscity1').slideUp(200);
                        
                    });

                }

            }

        });
    }


    function edit(id){
        $("#ooo").load('http://127.0.0.9/index.php?user-load.html&id='+id+'');
        $("#p-dialog1").show();
    }
    //点击出现省级地址





$(document).ready(function(){
    //点击出现省级地址
    $("body").delegate('#spsheng1','click',function(){
        $("#issheng1").slideDown(200);
            $("#issheng1 li").click(function(){
            var val = $(this).attr('data-id');
            var html = $(this).html();
            $("#provice1").val(val);
            $("#spsheng1").html(html);
            $('#issheng1').slideUp(200);
            //shiji0(val);
        });
    });

    $("body").delegate('#sparea1','click',function(event){
        var id = $("#city1").val();
        shiji2(id);
    });

    $("#ooo").delegate('#spcity1','click',function(){
        var id = $("#provice1").val();
        shiji3(id);

    });
});

</script>





<script type="text/javascript">

    

    function shedit( $add ,$id){

        if($add == 'post'){
            id       = $id;
            diqu     = $("#area").val();
            xingming = $("#name").val();
            xiangqing= $("#detailAddr").val();
            shouji   = $("#tel").val();
            moren    = $(".inpCheck:checked").val();
        }else{
            id       = $id;
            diqu     = $("#area1").val();
            xingming = $("#name1").val();
            xiangqing= $("#detailAddr1").val();
            shouji   = $("#tel1").val();
            moren    = $(".inpCheck1:checked").val();
        }
        
        if(moren == undefined){
            moren = 0;
        }

        canshu = [ "xingming#len#2-30" , "diqu#len#6","xiangqing#len#2-120", "shouji#len#11", ];

        LOFROM["xingming"] = '收货人';
        LOFROM["diqu"] = '区域选择';
        LOFROM["xiangqing"] = '详细地址';
        LOFROM["shouji"] = '收货手机';

        fanhui = yzpost( canshu , { "xingming" : xingming , "diqu" : diqu , "xiangqing" : xiangqing ,  "shouji" : shouji  } );

        if( fanhui.code != 1){
            layer.msg (LOFROM[fanhui.biao] + '错误' ,{time:1000});
            return false;
        }

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'shouhuo',d:$add,id:id,diqu:diqu,xingming:xingming,xiangqing:xiangqing,shouji:shouji,moren:moren,ttoken:TOKEN},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                layer.msg ( $add == 'put'?'修改成功':'添加成功' ,{url:"<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'ding');?>" });

            },error:function(xhr){

                dataerror(xhr , '收货' );
            }
        });


    }

    function yzpost( canshu ,$_POST){

        if( canshu ){

            for(var i in canshu){

                da    = canshu[ i ] . split( '#' );

                $name = da[0];
                $type = da[1];
                $zhi  = da[2];

                if( ! $_POST[$name] ) return  { "code":"0","biao": $name  ,"msg":"" };

                if( $type == 'len' ){

                    if( $_POST[$name] == '' ) return  { "code":"0","biao": $name  ,"msg":"" };

                    $zlen = $_POST[$name].length;
                    $zifu = $zhi. split( '-' );

                    if ( $zifu[1] && $zifu[1] != '' ){

                        if( $zlen < $zifu[0] || $zlen > $zifu[1]  ) return  { "code":"0","biao": $name  ,"msg":$zhi };

                    }else if( $zifu[0] !=  $zlen ){

                        return  { "code":"0","biao": $name  ,"msg":$zifu[0] };
                    }

                }else if( $type == '=' ){

                    

                    if( $_POST[$name] != $zhi ) return  { "code":"0","biao": $name  ,"msg": $zhi };
                }

            }
        }

        return  { "code":"1","biao":"all","msg":"" };
    }
</script>

<script type="text/javascript">
$(document).ready(function(){
    TOKEN    = '<?php echo  wenyiyz( 'ding/'.$USERID ,  '' , $Mem );?>';
    $("body").find("#commitOrder").click(function(){
        var hongid = 0;
        var shouid = $(".ttt").attr('id');
        var youfei = '';
        mui.ajax(HTTP+'json.php',{
            data:{y:'ding',d:'post',hongid:hongid,shouid:shouid,ttoken:TOKEN,youfei:youfei},
            datatype:'json',
            type:'post',
            timeout:10000,
            success:function(data){
                var DATA = data.data;
                var id = DATA.orderid;
                var token = data.token;
                window.location=HTTP+'index.php?user-select.html&id='+id+'&token='+token;
            },error:function(xhr){

            }
        });
    });
});
</script>