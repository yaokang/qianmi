<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';
$D -> setbiao ( 'shouhuo' );
$DATA = array( 'diqu' => 0,'off' => 0 ) ;
$shuju = chengshiid($DATA['diqu']);
for($i = 0;$i< count($shuju) ; $i++){
  $shujus = chengshi($shuju[$i]);
  if($shuju[$i] > 0 )unset($shujus['0']);
}
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
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>"   >在线充值</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" >基本资料</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" class="cur">收货地址</a>
                </li>
            </ul>
        </div>
        <div class="main">
            <h6 class="people-info">收货人信息</h6>
            <div class="order-item">
                <ul class="list-unstyled clearfix order-item-addresslist" id="orderAddressList">

                </ul>
                <a href="javascript:;" class="newAddress" id="newAddress">新增收货地址</a>
            </div>
        </div>
    </section>
    <!--底部 -->
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
<?php include QTPL.'foot.php'; ?>

<script type="text/javascript">
    var LOFROM = <?php echo json_encode( array( 'zhanghao' => '手机号/邮箱', 'pass' => '登录密码', 'epass' => '重复密码', 'code' => '信息验证码','vcode' => '图形验证码' ) );?>;
    TOKEN = '<?php echo wenyiyz( 'shouhuo_'.$USERID ,  '' , $Mem );?>';
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
                console.log(item);
                if(item.off == 1){
                    var dizhi = '默认';
                    var cla = 'tag';
                }else{
                    var dizhi = '';
                    var cla = 'flags';
                }
                html += '<li class="clearfix cur" id="'+item.id+'"><span class="pull-left"><span class="name">'+item.xingming+'</span> <span class="tel">'+item.shouji+'</span> <span class="address">'+item.beizhu+'</span></span><span class="operate"><a href="javascript:edit('+item.id+');" class="modifyAddress" id="'+item.id+'">编辑</a><a href="javascript:;" class="deleteAddress" id="'+item.id+'">删除</a><input type="hidden" name="addr_id" value="7623934"><a href="javascript:;" class="'+cla+'">'+dizhi+'</a></span></li>';
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

                layer.msg ( $add == 'put'?'修改成功':'添加成功' ,{url:"<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo');?>" });

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