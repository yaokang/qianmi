<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'user/uheader.php';

?>
<div class="w-1000 w-750 pt-50">
    <p class="member">注册会员</p>
    <div class="login-sec clearfix">
      <div class="login-left pull-left">
        <img src="<?php echo DQTPL?>images/common/huiyuan.jpg">
        <div class="login">
          <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>" class="btn btn-primary btn-lg active login-btn" role="button" title="点击此按钮，登录会员账号"> 会员登录></a>
        </div>
      </div>
      <div class="login-right pull-right">
        <div class="login-form">
            <ul>
              <li class="clearfix">
                <div class="text02 all pull-left">
                  <span class="mobile">手机号</span>
                </div>
                <div class="send-yanzm pull-left">
                  <input type="text" class="form-control" id="user" name="zhanghao">
                  <span class="true"></span>
                </div> 
              </li>
              <li class="clearfix">
                <div class="text04 all pull-left">
                 <span class="code">密码</span>
                </div>
                <div class="password pull-left">
                  <input type="password" placeholder="请输入6-20位号码字符"class="form-control" id="passwd" name="pass">
                  <span class="true"></span>
                </div>
              </li>
              
                <li class="clearfix">
                    <div class="text01 all pull-left">
                        <span class="form1">验证码</span>
                    </div>
                    <div class="yanzm pull-left">
                        <input type="text text-01 " class="pull-left form-control" id="verify" name="vcode"><span class="true"></span>
                        <span class="yanzm-img"><img src="<?php echo WZHOST.'api.php?action=vocde'?>" alt="" class="auth-img imgsrc"></span>
                        <span class="update auth-img imgsrc"></span>
                    </div>
                </li>
              <li class="clearfix">
                <div class="text03 all pull-left">
                 <span class="text">手机验证码</span>
                </div>
                <div class="mobile-yanzm pull-left">
                  <input type="text" class="form-control"  id="telverify" name="code"><span class="true"></span>
                  <div class="send" id="TestGetCode" onclick="return facode(1);">
                    <span>发送验证码</span>
                  </div>
                </div>
              </li>

              <li class="clearfix">
                <div class="fruit-login pull-right">
                  <div class="fr-regist pull-left">
                       <a href="javascript:reg()" class="btn-lg" role="button" id="submit">注册</a>
                  </div>
                  <div class="fr-login pull-left">
                        <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>" class="btn-lg" role="button">会员登录</a>
                  </div>
                </div>
              </li>

            </ul>
        </div>
      </div>
  </div>
</div>

<!--底部 -->
<?php 
include QTPL.'foot.php';
include QTPL.'user/ufoot.php';
?>

<script type="text/javascript">
mui.ready(function() {

 $(".imgsrc").click(function(){

        $( this ).attr( { src : $(this).attr('src')+'&1=' } );
    
    });

});

</script>