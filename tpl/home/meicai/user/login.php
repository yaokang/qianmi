<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'user/uheader.php';

?>
  <div class="w-1000 w-750 pt-50">
    <p class="member">会员登录</p>
    <div class="login-sec clearfix">
      <div class="login-left pull-left">
        <img src="<?php echo DQTPL?>images/common/huiyuan.jpg">
        <div class="login">
          <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>" class="btn btn-primary btn-lg active login-btn" role="button" title="点击此按钮，登录会员账号"> 会员注册></a>
        </div>
      </div>       
      <div class="login-right pull-right">
        <div class="login-form">
            <ul>
                <li class="clearfix log-number">
                    <div class="text02 all pull-left">
                        <span class="mobile">手机号</span>
                    </div>
                    <div class="send-yanzm pull-left">
                        <input type="text" class="form-control" id="user" name="zhanghao">
                        <span class="true"></span>
                    </div> 
                </li>
                <li class="clearfix log-pass">
                    <div class="text04 all pull-left">
                        <span class="code">密码</span>
                    </div>
                    <div class="password pull-left">
                        <input type="password" placeholder="请输入6-20位号码字符" class="form-control" id="passwd" name="pass">
                        <span class="true"></span>
                    </div>
                </li>
                <li class="clearfix log-wj">
                    <div class="wj-mima clearfix pull-right">
                        <div class="fr-wj pull-left">
                            <a href="/verify" target="_blank">忘记密码?</a>
                        </div>
                        <div class="fr-wj pull-right">  <a href="/quickLogin">快捷登录</a></div>
                    </div>
                </li>
                <li class="clearfix">
                    <div class="fruit-login pull-right">
                        <div class="fr-regist pull-left">
                           <a href="javascript:login();" class="btn-lg" role="button" id="submit">登录</a>
                        </div>
                        <div class="fr-login pull-left">
                            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>" class="btn-lg" role="button"> 注册会员
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
      </div>
  </div>
</div>
<input type="hidden" id="ref_url" value="/prolist/index/43">
<!--底部 -->
<?php 
include QTPL.'foot.php';
include QTPL.'user/ufoot.php';
?>

 