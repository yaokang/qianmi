<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';

?>
<link rel="stylesheet" href="/css/login.css">

    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>   
          <span class="pull-right navbar-func">
              <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>" class="btn btn-warning btn-xs">注册</a>
          </span>       
          <span class="navbar-title">快捷 登陆 或 注册</span>
        </div>
      </div>
    </nav>
<div class="dialog-custom-content">
    <section class="m-component-login" id="m-login">
       <div class="container">
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> 
                    <span class="glyphicon glyphicon-user"></span>
                  </span>
                  <input type="text" class="form-control" name="zhanghao" placeholder="手机号/邮箱" >
                </div>
            </div>    

            <input type="hidden" class="form-control" value="www.wapcq.com" name="pass" id="passwd" placeholder="设置新密码">
            <input type="hidden" class="form-control" value="www.wapcq.com" name="epass" id="c-passwd" placeholder="重复新密码">
           




             <div class="form-group" id="auth-div">
                  <div class="input-group">
                      <input type="type" class="form-control" name="vcode" id="authcode" placeholder="请输入验证码">
                  <span class="input-group-addon" style="padding:0;">
                      <img src="<?php echo WZHOST.'api.php?action=vocde'?>" width="100" height="32" alt="" border="0" class="imgsrc">
                  </span>
                  </div>
              </div> 

             <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-send"></span>
                  </span>
                  <input type="number" class="form-control" name="code" id="identcode" placeholder="输入收到的验证码">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="TestGetCode" onclick="return facode(3);"><span>点击获取</span><span class="hide">还剩<b id="timeout">60</b>秒</span></button>
                  </span>
                </div>
            </div>




            <div id="sb-div">
                <button type="button" class="btn btn-success btn-block" id="m-submit" onclick="return kjlogin();">登 陆</button>
            </div>    
            <div class="text-right">
                <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'pass');?>" class="m-login-link">忘记密码</a>
                <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>" class="m-login-link" style="float:left;color:red;">普通登录</a> 
            </div>




            <div class="m-login-extLogin">
                 <div class="hd"> <span>第三方登录</span>  </div>
                 <div class="bd">
                 <?php if($LANG['kjqqid'] != ''){ ?>
                  <a class="ico ico-thirdLogin ico-thirdLogin-qq" title="QQ帐号登录" href="<?php echo WZHOST.'login/login.php?y=1'?>"></a>
                 <?php } if($LANG['kjwxid'] != ''){ ?>
                  <a class="ico ico-thirdLogin ico-thirdLogin-weixin" title="微信帐号登录" href="<?php echo WZHOST.'login/login.php?y=2'?>"></a>
                  <?php } if($LANG['kjweiboid'] != ''){ ?>
                  <a class="ico ico-thirdLogin ico-thirdLogin-weibo" title="微博帐号登录" href="<?php echo WZHOST.'login/login.php?y=3'?>"></a>
                  <?php } if($LANG['kjzfbid'] != ''){ ?>
                  <a class="ico ico-thirdLogin ico-thirdLogin-alipay" title="支付宝登录" href="<?php echo WZHOST.'login/login.php?y=4'?>"></a>
                  <?php } ?>
                 </div>
            </div> 

        </div>

    </section>
    </div>

    
     
<?php include QTPL .'foot.php';?>

<script>

function kjlogin(){

       zhanghao = $("[name=zhanghao]").val();
       vcode    = $("[name=vcode]")   .val();
       code     = $("[name=code]")    .val();
       pass     = $("[name=pass]")    .val();
         canshu = [ "zhanghao#len#2-30" ,'vcode#len#4','code#len#6' ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "vcode" : vcode ,"code":code} );

        if( fanhui.code != 1){

            MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
            return false;
        }

        $.post(HTTP + "json.php",{y:'login',d:'get',zhanghao:zhanghao,pass:pass,vcode:vcode,code:code,kjlogin:2,ttoken:TOKEN}, function(data ) {


         
            MessageBox.show('登录成功',500,USERUL);

         
     
        }).error(function( data ){
        
            dataerror( data ,'快捷登录');
    
        });


}

</script>
