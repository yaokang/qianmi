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
          <span class="navbar-title">登陆</span>
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
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span>
                  </span>
                  <input type="password" class="form-control" name="pass" placeholder="请输入密码">
                </div>
            </div> 
            <div class="form-group hide" id="auth-div">
                <div class="input-group">
                  <input type="type" class="form-control" name="vcode"  placeholder="请输入验证码">
                  <span class="input-group-addon" style="padding:0;">
                      <img src="<?php echo WZHOST.'api.php?action=vocde'?>" width="100" height="32" alt="" border="0"  class="imgsrc">
                  </span>
                </div>
            </div> 
            <div id="sb-div">
                <button type="button" class="btn btn-success btn-block" id="m-submit" onclick="return login();">登 陆</button>
            </div>    
            <div class="text-right">
                <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'pass');?>" class="m-login-link">忘记密码</a>
                <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'klogin');?>" class="m-login-link" style="float:left;color:red;">快捷登录注册</a> 
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

