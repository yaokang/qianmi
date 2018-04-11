<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');

$_SESSION['shangyibu'] = mourl( $URI );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <link rel="stylesheet" href="<?php echo TPL;?>js/kindeditor/themes/default/default.css" />
    <style>
      .woqudd{ margin:10px 0; }
      body{background: #f5f5f5;}

      .toubuss{padding:8px;}

      .toubuzhong{width:188px;margin:0 auto;text-align:center;color:#fff;position:relative;}
      .toubuzhong p{color:#fff;margin-bottom:1px;}
      .toubuzhong .sjanniu{ position:absolute;top:0px;left:0px;}


.ke-form{width:108px;height:108px;opacity: '0';}
#uploadButton{display:none;opacity: '0';}
.ke-inline-block *{opacity: '0';width :108px;height:108px;}
.woqudd .mui-icon{font-size:20px;}
.mui-table-view-cell:after{left:0px;}

</style>
    </head>

    <body style="padding-bottom:58px;">

   <nav class="mui-bar mui-bar-tab" id="navfoot" >
            <a class="mui-tab-item2" href="<?php echo WZHOST;?>">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
                <span class="mui-tab-label" >首页</span>
            </a>

            <?php $danye = danye( $LANG['cpid'] );?>
            <a class="mui-tab-item2 " href="<?php echo $danye['link'];?>" >
                <span>
                <b class="mui-icon mui-icon-mctype"></b>
                </span>
                <span class="mui-tab-label"><?php echo $danye['name'];?></span>
            </a>

            <?php $danye = danye( $LANG['tjid'] );?>
            <a class="mui-tab-item2" href="<?php echo $danye['link'];?>">
                <span>
                <b class="mui-icon mui-icon-mctj"></b>
                </span>
                <span class="mui-tab-label"><?php echo $danye['name'];?></span>
            </a>

            <a class="mui-tab-item2" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge" style="display:none;"></span></b>
                </span>
                <span class="mui-tab-label">购物车</span>
            </a>

            <a class="mui-tab-item2  mui-active" href="<?php echo mourl( $CONN['userword']);?>">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
                <span class="mui-tab-label">我的</span>
            </a>
        </nav>

        <div class="mui-content" style="background:#0BBE06;height:200px;">

            <div class="toubuss">

            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'setting');?>"><span class="mui-icon mui-icon-gear" style="color:#fff;font-size:28px;"></span></a>

            <?php
             $zz = $D -> setbiao('msgbox') ->where( array( 'uid' => $USERID ,'yuedu' => 0) )-> find();

            if($zz){ ?>

              
                <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'msgbox');?>"><span class="mui-icon mui-icon-chat" style="color:#eee;float:right;font-size:28px;"> </span></a>
            
            <?php }else{ ?>

            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'msgbox');?>"><span class="mui-icon mui-icon-chatbubble" style="color:#fff;float:right;font-size:28px;"> </span></a>
            <?php } ?>



            </div>

            <div class="toubuzhong">

                <p> <img src="<?php echo touxiang( $USER['touxiang']);?>" class="touxiang" style="width:108px;height:108px;border-radius:50%;border:1px solid #fff;" /></p>

                <p> <?php echo $USER['name'];?> </p>

               <!--  <p style="margin-top:5px;">
               
                    <b style="background:#00A615;padding:5px 10px;border-radius:10px;"><span class="mui-icon mui-icon-eye" style="font-size:18px;margin-right:8px;"></span>普通会员</b>
                </p> -->

                <p class="sjanniu"><input  id="uploadButton" value="" style="float:right;"> </p>


            </div>


        </div>




        <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'jine');?>">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-mccyue" style="color:red;"></span> 我的钱包
                            
                        </div>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'hongbao');?>">
                    
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-mccyhui" style="color:#007aff;"></span> 我的红包
                            
                        </div>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'pay');?>">
                    
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-zhifubao" style="color:#FFA73C;"></span> 立即充值
                            
                        </div>
                    </a>
                </li>

             </ul>
           </div>

            <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">



                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'myding');?>">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-refresh" style="color:#8FCFF3;"></span> 我的订单
                            
                        </div>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'shouhuo');?>">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-map" style="color:#83D18C;"></span> 收货地址管理
                            
                        </div>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="<?php echo $LANG['lxlink'];?>">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-phone" style="color:#81DFE6;"></span> <?php echo $LANG['lxdianhua'];?>
                            
                        </div>
                    </a>
                </li>


            </ul>


        </div>

        <!-- 
        <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">
            <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-compose" style="color:#58D9C9;"></span> 提交新品需求
                            
                        </div>
                    </a>
                </li>
        
            <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-chat" style="color:#81DFE6;"></span> 在线客服
                            
                        </div>
                    </a>
                </li>
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-phone" style="color:#81DFE6;"></span> 客服电话:111154545
                            
                        </div>
                    </a>
                </li>
                 <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-qq" style="color:#FF7400;"></span> 服务中心
                            
                        </div>
                    </a>
                </li>
            </ul>
        </div> -->

        <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'quite');?>">
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-close-filled" style="color:red"></span> 退出登录
                            
                        </div>
                    </a>
                </li>
            </ul>
        </div>


</body>
</html>
<script type="text/javascript" src="<?php echo TPL;?>js/kindeditor/kindeditor-all-min.js"></script>
<?php include QTPL.'foot.php';?>
<script>
TOKEN = '<?php echo wenyiyz( 'userid/'.$USERID ,'' , $Mem );?>';
var UPURL = '<?php echo WZHOST;?>json.php?y=user&lx=2&uplx=image&dir=image&d=post&ttoken='+TOKEN;


KindEditor.ready(function(K) {

          

				var uploadbutton = K.uploadbutton({
					button : K('#uploadButton')[0],
					fieldName : 'image',
					url : UPURL,
					afterUpload : function(data) {
                            
                        

                        if( data.token && data.token != '') {

                            TOKEN = data.token;

                            UPURL = '<?php echo WZHOST;?>json.php?y=user&lx=2&uplx=image&dir=image&d=post&ttoken='+TOKEN;

                            $(".ke-form").attr({action:UPURL });

                            uploadbutton.options.url = UPURL;

                        }

                        if (data.code == -2){

                            mui.toast (  data.msg  );

                        }else if(data.code == 1){

                            $(".touxiang").attr({ src : data.msg } );

                        }else{
                            mui.toast (  data.msg  );
                        }


					},
					afterError : function(str) {

                        mui.toast ( str );
					
					}

				});
				uploadbutton.fileBox.change(function(e) {
					uploadbutton.submit();
				});

                $(".ke-form").css({opacity: '0',background:'red',width:'108px',height:'108px',margin:'0px 0px 0px -0px',top:'0px',left:'46px'});

 gouwuche();
});



</script>