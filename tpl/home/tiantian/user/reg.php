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
              <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>" class="btn btn-warning btn-xs">登录</a>
          </span>  
                
          <span class="navbar-title">注册</span>
        </div>
      </div>
    </nav>

    <section class="m-component-login" id="m-login">
       <div class="container">
          <form id="registerForm">
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> 
                    <span class="glyphicon glyphicon-user"></span>
                  </span>
                  <input type="text" maxlength="30" class="form-control" name="zhanghao" placeholder="请输入<?php echo $LANG['zhanghao'.$CONN['regtype']]?>">
                </div>
            </div>    
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span>
                  </span>
                  <input type="password" class="form-control" name="pass" id="passwd" placeholder="设置新密码">
                </div>
            </div> 
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-pencil"></span>
                  </span>
                  <input type="password" class="form-control" name="epass" id="c-passwd" placeholder="重复新密码">
                </div>
            </div>

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
                    <button class="btn btn-default" type="button" id="TestGetCode" onclick="return facode(1);"><span>点击获取</span><span class="hide">还剩<b id="timeout">60</b>秒</span></button>
                  </span>
                </div>
            </div>



            <div class="">
                <button type="button" class="btn btn-success btn-block" id="m-submit" onclick="return reg();" >注 册</button>
            </div>
          </form>   
        </div>
    </section>

<?php include QTPL .'foot.php';?>