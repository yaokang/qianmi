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

           <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
            <h1 class="mui-title">找回密码</h1>
            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">登录</a>
            

        </header>

         

    <div class="mui-content" style="background:transparent;margin-top:2px;">

        <div class="headad" style="width:100%;overflow:hidden;text-align:center;"> 

            <img src="<?php echo DQTPL;?>images/bgphone.png" style="width:100%;" />
       
       
       </div>
      
        <form class="mui-input-group" style="background:transparent;margin-top:2px;" action="post">


           
            <div class="mui-input-row">

               <span class="mui-icon mui-icon-contact inputfdongico"></span>
             
                <input style="width:100%;text-indent:18px;" type="text" name="zhanghao"  class="mui-input-clear mtts" placeholder="您的手机/邮箱">
            </div>

             <div class="mui-input-row mui-password">

                <span class="mui-icon mui-icon-locked inputfdongico"></span>
            
                <input  style="width:100%;text-indent:18px;" type="password"  name="pass"  class="mui-input-password" placeholder="您的登录密码">
            </div>

    

            <div class="mui-input-row">

                <span class="mui-icon mui-icon-image inputfdongico"></span>
                
                <input style="width:100%;text-indent:18px;" type="text"  name="vcode" class=" " placeholder="图形验证码">
                <img src="<?php echo WZHOST.'api.php?action=vocde'?>" style="width:100px;" class="inputfdong  imgsrc">
            </div>

            <div class="mui-input-row ">

                <span class="mui-icon mui-icon-email inputfdongico"></span>

            
                
                <input style="width:100%;text-indent:18px;" type="text" name="code" class=" " placeholder="收到的验证码">
                <div class="inputfdong">

                <button type="button" class="mui-btn mui-btn-danger" style="width:100px;" id="TestGetCode" onclick="return facode(2);"> <span class="mui-badge mui-badge-primary"> 点击获取 </span> </button>
                
                
                </div>
            </div>


           


         


            <button type="button"  class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto; " onclick="return zpass();">找回</button>

        </form>

        <div class="mui-card-footer" >
					<a class="mui-card-link" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>">帐号登录</a>
					<a class="mui-card-link" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>">帐号注册</a>
		</div>

    </div>
</body>
</html>
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