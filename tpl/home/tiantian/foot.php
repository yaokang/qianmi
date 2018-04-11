<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');?>

<!--
<section class="m-component-download clearfix" id="downloadApp">

    <div class="m-close"><span class="glyphicon glyphicon-remove"></span></div>
    <span class="pull-left"><img class="m-img" src="/images/logo1.svg" ></span>
    <span class="pull-left m-tips">下载果园App，立享专属优惠<br/>天天到家，2小时闪电送达</span>
    <span class="pull-right m-btn"><a href="http://a.app.qq.com/o/simple.jsp?pkgname=com.ttxg.fruitday" class="btn btn-success " role="button" name="apk_url">立刻体验</a></span>

</section>
-->
<div class="m-component-float">
    <ul class="list-unstyled">
            <li id="goToTop" style="display:none;height: 40px;width: 40px;"><span class="glyphicon fdayicon fdayicon-toTop"></span></li>
            <?php if(isset($CHANPINYES)){  ?><li id="addCart"><span class="glyphicon fdayicon fdayicon-procart jiarugouwu"></span></li><?php } ?>
            
        </ul>
</div>
<script src="/js/lib/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/tpl/h-ui/js/layer.js"></script> 
<script src="/js/require.js" data-main="/js/main"></script>
</body>
</html>
<script>
var TOKEN  = ''; /* token */
var HTTP   = '<?php echo WZHOST;?>'; /*js 访问网址*/
var USERUL = '<?php if(isset( $_SESSION['reback'])) echo $_SESSION['reback']; else echo mourl( $CONN['userword']);?>'; /*用户跳转网址*/
var DAOJI = 120;  /*短信倒计时*/
var $HUOBIICO = <?php echo json_encode($HUOBIICO);?>; /*货币单位*/
var HUOBI     = <?php echo json_encode( $HUOBI );?>; /*货币*/
var huobi0 =huobi1 = huobi2 = huobi3 = 0;
var HUOZUI = '<?php echo $CONN['houzui']?>';
var setdao;
var LOFROM = <?php echo json_encode( array( 'zhanghao' => '手机号/邮箱', 'pass' => '登录密码', 'epass' => '重复密码', 'code' => '信息验证码','vcode' => '图形验证码' ) );?>;  /*用户登录信息提示*/

function openurl(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}


function getcartnum(){

        /*获取购物车数量*/

        $.post(HTTP + "json.php",{y:'gouwuche',d:'get',zgw:1}, function(data ) {

            
            setcartnum( data.data.count );
         
        

        });



}


function setcartnum( num ){ 

         /* 设置购物车的数量 */

        if( $(".fdayicon-cart").length ){

            if(num < 1)$(".fdayicon-cart").html( '');
            else  $(".fdayicon-cart").html( '<i class="cart-sales-nums">'+num+'</i>');

        }

}

function dataerror( data , ming ){


 

        if( data.status == '401' ){

                MessageBox.errorFadeout('需要登录用户',500,USERUL);

        }else if( data.status == '304' ){
               
                MessageBox.errorFadeout('修改'+ming+'失败',500);
            
        }else if( data.status == '410' ){
               
                MessageBox.errorFadeout('删除'+ming+'失败',500);
            
        }else if( data.status == '404' ){
               
                MessageBox.errorFadeout('查询'+ming+'失败',500);
            
        }else if( data.status == '406' ){
               
                MessageBox.errorFadeout('新增'+ming+'失败',500);
            
        }else if( data.status == '415' ){





                if( data.responseJSON ){

                    DATA = data.responseJSON;

                    if(DATA.code == 2){
                    
                        $( ".imgsrc" ).attr( { src : $(".imgsrc").attr('src')+'&1=' } );
                    }

                    if( DATA.token && DATA.token != '') TOKEN = DATA.token;

                    MessageBox.errorFadeout( DATA.msg ,500);
                
                }else MessageBox.errorFadeout('非法数据',500);



        }else{

                MessageBox.errorFadeout('数据错误',500);

        }


}


function lijigo(cpid,num,cansu){

        $.post(HTTP + "json.php",{y:'gouwuche',d:'post',cpid:cpid,num:num,cansu:cansu}, function(data ) {

            setcartnum( data.data.count );
         
            MessageBox.show( '加入成功' , 500 );


        }).error(function( data ){
        
            dataerror( data ,'购物车');
    
        });
}


function goumai( cpid,num,cansu ){

      fenge = '<?php echo $CONN['fenge']?>';


        MessageBox.loading('<?php echo mourl( $CONN['userword'],'',$CONN['fenge'].'goumai' );?>'+fenge+cpid+fenge+num+fenge+cansu+'.html');


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


function login(){

        zhanghao = $("[name=zhanghao]").val();
        pass     = $("[name=pass]")    .val();
        epass    = $("[name=epass]")    .val();
        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        if( $("[name=vcode]:visible").length )
            canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4' ];
        else
            canshu = [ "zhanghao#len#2-30" , "pass#len#6-32" ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode } );

        if( fanhui.code != 1){

            MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
            return false;
        }

        $.post(HTTP + "json.php",{y:'login',d:'get',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken:TOKEN}, function(data ) {
         
            MessageBox.show('登录成功',500,USERUL);

         
     
        }).error(function( data ){
        
            dataerror( data ,'登录');
    
        });

     
}

function reg(){

        zhanghao = $("[name=zhanghao]").val();
        pass     = $("[name=pass]")    .val();
        epass    = $("[name=epass]")   .val();
        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        
        canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4','code#len#6','epass#=#'+pass ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode ,'code':code,'epass':epass } );

        if( fanhui.code != 1){

            MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
            return false;
        }

        $.post(HTTP + "json.php",{y:'login',d:'post',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken:TOKEN}, function(data ) {
         
            MessageBox.show('注册成功',500 , USERUL);

     
        }).error(function( data ){
        
            dataerror( data ,'注册');
    
        });
}


function zpass(){

        zhanghao = $("[name=zhanghao]").val();
        pass     = $("[name=pass]")    .val();
        epass    = $("[name=epass]")    .val();
        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        
        canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4','code#len#6','epass#=#'+pass ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode ,'code':code,'epass':epass } );

        if( fanhui.code != 1){

            MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
            return false;
        }

        $.post(HTTP + "json.php",{y:'login',d:'put',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken:TOKEN}, function(data ) {
         
            MessageBox.show('找回成功',500 , USERUL);

        }).error(function( data ){
        
            dataerror( data ,'找回');
    
        });
}


function daojishi(){

        DAOJI--;

        if(DAOJI < 1){

            $("#TestGetCode").attr("disabled",false);
            clearInterval( setdao );
            DAOJI = 120;
            $("#TestGetCode span").html('点击获取');

        }else  $("#TestGetCode span").html('还剩<b id="timeout">'+DAOJI+'</b>秒');
}


function facode( lx ){

        zhanghao = $("[name=zhanghao]").val();
        pass     = $("[name=pass]")    .val();
        epass    = $("[name=epass]")    .val();
        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4','epass#=#'+pass ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode ,'code':code,'epass':epass } );

        if( fanhui.code != 1){

           MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
           return false;
        }

        $.post(HTTP + "json.php",{y:'login',d:'delete',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken: lx }, function(data ) {

            
            if( data.token && data.token != '') TOKEN = data.token;

            if(data.code == 3){

                $("[name=code]").val(data.msg);
            
            
            }

            MessageBox.show('发送成功',500);

            $("#TestGetCode").attr("disabled","true");

            setdao = setInterval("daojishi()",1000);

        }).error(function( data ){
        
            dataerror( data ,'发送短信');
    
        });

}


function shanchu( id , fanhui){


        $.post(HTTP + "json.php",{y:'gouwuche',d:'delete',cansu:id}, function(data ) {

            fanhui(id);

        }).error(function( data ){
        
            dataerror( data ,'删除购物车');
    
        });
}

function bianji( id , num ,fanhui){


        $.post(HTTP + "json.php",{y:'gouwuche',d:'put',cansu:id,num:num}, function(data ) {

            fanhui(id,num);

        }).error(function( data ){
        
            dataerror( data ,'购物车');
    
        });
}



$(function(){


    if( $(".fdayicon-cart").length ){
        getcartnum();
    }

    $(".imgsrc").click(function(){

        $( this ).attr( { src : $(this).attr('src')+'&1=' } );
    
    });


});
</script>
