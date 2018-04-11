<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';

?>
<link rel="stylesheet" href="/tpl/js/kindeditor/themes/default/default.css" />
<style>

.ke-form{width:80px;height:80px;opacity: '0';margin:'0px 0px 0px -80px';}
</style>
  <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>      
          <a class="navbar-func pull-right" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart');?>"><span class="glyphicon fdayicon fdayicon-cart"></span></a>     
          <span class="navbar-title">我的果园</span>
        </div>
      </div>
    </nav>

    <section class="m-component-user" id="m-user">
        <div class="m-user-avatar text-center">
            <span class="avatarPic"><img class="lazy img-circle touxiang" data-original="<?php echo touxiang( $USER['touxiang']);?>" /><input  id="uploadButton" value="" style="float:left;"></span>
            
            
            <div class="nicheng"><?php echo $USER['name'];?></div>
        </div>
        
        <ul class="list-unstyled m-user-content">
                <li>
                    <div class="m-user-item">
                       <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'myding');?>" class="user-order">我的订单</a>
                    </div>

                    <div class="m-user-item">
                       <a href="javascript:<?php if( (int)$USER['shouji'] == '0'){ ?>openbang(1,'bangding')<?php }else{ ?>void(0);<?php }?>;" class="fdayicon-client">
                        <span class="pull-right"><?php echo ( (int)$USER['shouji'] == '0' ) ? '未绑定':'已绑定';?></span>绑定手机</a>
                    </div>

                    <!--
                    <div class="m-user-item">
                       <a href="javascript:<?php if( $USER['email'] == ''){ ?>openbang(2,'bangding')<?php }else{ ?>void(0);<?php }?>;" class="fdayicon-fold">
                        <span class="pull-right"><?php echo ( $USER['email'] == '') ? '未绑定':'已绑定';?></span>绑定邮箱</a>

                    </div>
                    -->


                    <div class="m-user-item">
                       <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'pay');?>" class="user-balance" style="color:red;">立即充值</a>
                    </div>

                </li>
                <li>
                    <div class="m-user-item">
                       <div class="user-level"><span class="icon-level user-level_<?php echo $CONN['level'];?>"></span>会员等级</div>
                    </div>
                    <div class="m-user-item">
                       <div class="user-score"><span class="pull-right"><?php echo $USER['jifen'];?></span>积分</div>
                    </div>
                    <div class="m-user-item">
                       <div class="user-balance"><span class="pull-right">￥<?php echo $USER['jine'];?></span>余额</div>
                    </div>
                    <div class="m-user-item">
                       <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'hongbao');?>" class="user-coupon">优惠券</a>
                    </div>
                    
                </li>
                 <li>
                    <div class="m-user-item">
                        <a href="<?php $ong = danye(2); echo $ong['link'];?>" class="user-info">关于我们</a>
                    </div>
                </li>
            </ul>
            <div class="m-user-quit" id="m-quit">
            <a  class="btn btn-warning btn-block " href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'quite');?>"> 注销 </a>
            
            </div>
        
    </section>
<div id="bangding" style="display:none;">

    <div class="baingding" style="padding:20px;">

        <form id="registerForm">
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> 
                    <span class="glyphicon glyphicon-user"></span>
                  </span>
                  <input type="text" maxlength="30" class="form-control" name="zhanghao" value="" id="shoujizh" placeholder="手机">
                </div>
            </div>    
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span>
                  </span> 
                  <input type="password" class="form-control" name="pass" id="passwd"  value=""  placeholder="设置新密码">
                </div>
            </div> 
        

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-send"></span>
                  </span>
                  <input type="number" class="form-control" name="code" id="identcode" value=""  placeholder="输入收到的验证码">
                  <span class="input-group-btn">
                    <button class="btn btn-default TestGetCode" type="button" id="TestGetCode" onclick="return facode2();"><span>点击获取</span><span class="hide">还剩<b id="timeout">60</b>秒</span></button>
                  </span>
                </div>
            </div>



            <div class="">
                <button type="button" class="btn btn-success btn-block" id="m-submit" onclick="return bangding();" >绑定</button>
            </div>
          </form>   
   
    </div>
</div>


<script type="text/javascript" src="/tpl/js/kindeditor/kindeditor-all-min.js"></script>


<?php include QTPL .'foot.php';?>
<script>
TOKEN = '<?php echo wenyiyz( 'userid/'.$USERID ,'' , $Mem );?>';

KindEditor.ready(function(K) {

            function xxx(){
				var uploadbutton = K.uploadbutton({
					button : K('#uploadButton')[0],
					fieldName : 'image',
					url : '<?php echo WZHOST;?>json.php?y=user&lx=2&uplx=image&dir=image&d=post&ttoken='+TOKEN,
					afterUpload : function(data) {
                            
                        

                        if( data.token && data.token != '') TOKEN = data.token;

                        if (data.code == -2){

                         

                             MessageBox.errorFadeout( data.msg , 500 );


                        }else if(data.code == 1){

                            


                            $(".touxiang").attr({src:data.msg});
                        
                        
                        }else{
                        
                            MessageBox.errorFadeout( data.msg , 500 );
                        }

                        xxx();
						
					},
					afterError : function(str) {

                        MessageBox.errorFadeout( str , 500 );
					
					}

				});
				uploadbutton.fileBox.change(function(e) {
					uploadbutton.submit();
				});

            

                $(".ke-form").css({opacity: '0',width:'80px',height:'80px',margin:'0px 0px 0px -80px'});

         }

          xxx();
});


function facode2(){

    zhanghao = $(".layui-layer-content [name=zhanghao]").val();
     pass    = $(".layui-layer-content [name=pass]")    .val();
    code     = $(".layui-layer-content [name=code]")    .val();
    canshu   = ["zhanghao#len#2-30" , "pass#len#6-32" ];

    fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass } );
   
    if( fanhui.code != 1){

        MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
        return false;
    }

    $.post(HTTP + "json.php",{y:'user',d:'delete',zhanghao:zhanghao,pass:pass,ttoken: TOKEN }, function(data ) {

            
            if( data.token && data.token != '') TOKEN = data.token;

            if(data.code == 3){

                $(".layui-layer-content [name=code]").val(data.msg);
            
            
            }

            MessageBox.show('发送成功',500);

            $(".layui-layer-content  .TestGetCode").attr("disabled","true");

            setdao = setInterval("daojishi()",1000);

        }).error(function( data ){
        
            dataerror( data ,'发送短信');
    
        });

}

function bangding(){

    /* 发送绑定信息*/

    zhanghao = $(".layui-layer-content [name=zhanghao]").val();
     pass    = $(".layui-layer-content [name=pass]")    .val();
    code     = $(".layui-layer-content [name=code]")    .val();
    canshu   = ["zhanghao#len#2-30" , "pass#len#6-32",'code#len#6' ];

    fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "code" : code } );
   
    if( fanhui.code != 1){

        MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
        return false;
    }

    $.post(HTTP + "json.php",{y:'user',d:'put',zhanghao:zhanghao,pass:pass,code:code,ttoken: TOKEN }, function(data ) {

            
            if( data.token && data.token != '') TOKEN = data.token;

           MessageBox.show('绑定成功',500, USERUL);

        }).error(function( data ){
        
            dataerror( data ,'绑定');
    
        });


}



function openbang(title,ID){

    if(title == 1){

        titles = '绑定手机';
        $("[name=zhanghao]").attr({"placeholder":'绑定手机'});

    }else{

        titles = '绑定邮箱';

        $("[name=zhanghao]").attr({"placeholder":'绑定邮箱'});

    }


    var index = layer.open({
        type: 1,
        title: titles,
        zIndex:5,
        content: $("#"+ID).html()
    });
   
}

$(function(){

    $(".nicheng").click(function(){
    
    layer.prompt({ title: '请输入新的昵称'},function(val, index){

        
        $.post(HTTP + "json.php",{y:'user',d:'post',nicheng:val,lx:1,ttoken: TOKEN }, function(data ) {

            
            if( data.token && data.token != '') TOKEN = data.token;


            $(".nicheng").html( val );
            layer.close(index);

        }).error(function( data ){
        
            dataerror( data ,'绑定');
    
        });

     

    });


    });



});

</script>
