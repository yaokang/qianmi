<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
   
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <style>
    body{background: #f5f5f5;padding-bottom:100px;}
    .mui-input-row{background:#fff;}
    .mui-input-group .mui-input-row:after{left:0px;}
    .mui-card-link{font-size:14px;color:#0BBE06;}
    .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:33px;width:25px;height:33px;}
    </style>
   
    </head>

    <body>

       

        <header id="header" class="mui-bar mui-bar-nav">

           <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo WZHOST;?>"></a>
            <h1 class="mui-title">登录帐号</h1>
            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">注册</a>
            

        </header>

         <nav class="mui-bar mui-bar-tab" style="height:57px;" >

            

            <?php if($LANG['kjwxid'] != ''){ ?>
            <a class="mui-tab-item2" href="<?php echo WZHOST.'login/login.php?y=2'?>" style="color:#0ECB19;">
                <span>
                <b class="mui-icon mui-icon-weixin" ></b>
                </span>
                <span class="mui-tab-label" >微信登录</span>
            </a>
            <?php } ?>

            <?php if($LANG['kjqqid'] != ''){ ?>
            <a class="mui-tab-item2" href="<?php echo WZHOST.'login/login.php?y=1'?>" style="color:#E44A34;">
                <span>
                <b class="mui-icon mui-icon-qq" ></b>
                </span>
                <span class="mui-tab-label">QQ登录</span>
            </a>
            <?php } ?>
            
            <?php  if($LANG['kjzfbid'] != ''){ ?>
            <a class="mui-tab-item2 " href="<?php echo WZHOST.'login/login.php?y=4'?>" style="color:#00AAEE;">
                <span>
                <b class="mui-icon mui-icon-zhifubao"  ></b>
                </span>
                <span class="mui-tab-label">支付宝登录</span>
            </a>
            <?php } ?>


            <?php  if($LANG['kjweiboid'] != ''){ ?>


            <a class="mui-tab-item2 " href="<?php echo WZHOST.'login/login.php?y=3'?>"  style="color:#FF3407;">
                <span>
                <b class="mui-icon mui-icon-weibo"></b>
                </span>
                <span class="mui-tab-label">微博登录</span>
            </a>
            <?php } ?>
           
        </nav>

    <div class="mui-content" style="background:transparent;margin-top:2px;">

        <div class="headad" style="width:100%;overflow:hidden;text-align:center;"> 

            <img src="<?php echo DQTPL;?>images/bgphone.png" style="width:100%;" />
       
       
       </div>
      
        <form class="mui-input-group" style="background:transparent;margin-top:2px;" action="post">


           
            <div class="mui-input-row">

               <span class="mui-icon mui-icon-contact inputfdongico"></span>
             
                <input style="width:100%;text-indent:18px;" type="text" name="zhanghao" class="mui-input-clear mtts" placeholder="您的手机/邮箱">
            </div>

            <div class="mui-input-row mui-password">

                <span class="mui-icon mui-icon-locked inputfdongico"></span>
            
                <input  style="width:100%;text-indent:18px;" type="password" name="pass" class="mui-input-password" placeholder="您的登录密码">
            </div>


            <button type="button"  class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto; " onclick="return login();">登 录</button>

        </form>

        <div class="mui-card-footer" >
					<a class="mui-card-link" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'klogin');?>">快捷登录</a>
					<a class="mui-card-link" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'pass');?>">找回密码</a>
		</div>

    </div>
</body>
</html>
<?php 

include QTPL.'foot.php';
include QTPL.'user/ufoot.php';
?>