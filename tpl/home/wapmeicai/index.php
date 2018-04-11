<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <meta name="description" content="<?php echo !isset($DATA['miaoshu']) || $DATA['miaoshu']==''?$CONN['miaoshu']:$DATA['miaoshu'];?>" /> 
    <meta name="keywords" content="<?php echo !isset($DATA['guanjian']) ||$DATA['guanjian']==''?$CONN['guanjian']:$DATA['guanjian'];?>" />
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <script type="text/javascript">
        function sousuo(){
           var url = document.getElementById("URLs");
           if(url.value== "") alert('请填写关键字');
           else  window.location.href="<?php echo mourl($CONN['sosoword'],'',$CONN['fenge']);?>"+url.value+"<?php echo $CONN['houzui'];?>";
           return false;
        }
    </script>
</head>

<body>

         <nav class="mui-bar mui-bar-tab" id="navfoot" >
            <a class="mui-tab-item2 mui-active" href="<?php echo WZHOST;?>">
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

            <a class="mui-tab-item2 " href="<?php echo mourl( $CONN['userword']);?>">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
                <span class="mui-tab-label">我的</span>
            </a>
        </nav>

        <header id="header" class="mui-bar mui-bar-transparent">

            <form method="get" onsubmit="return sousuo();">

                <span class="mui-icon mui-icon-chat" style="color:#0bbe06;top:2px;"></span>
                <div class="mui-input-row mui-search mui-pull-left" style="width:90%;float:right;margin-top:2px;">
                    <input type="search" class="mui-input-clear" id="URLs" placeholder="输入菜名搜索" style="background:#fff;">
                </div>

            </form>
        </header>

        <div class="mui-content">

            <div id="slider" class="mui-slider" >
            <div class="mui-slider-group mui-slider-loop">

                <?php

                    if( $LANG['huandeng'] ){ 

                        $ONG = end ( $LANG['huandeng'] );
                ?>  <div class="mui-slider-item mui-slider-item-duplicate">
                        <a href="<?php echo $ONG['连接'];?>" title="<?php echo $ONG['描述'];?>"><img  src="<?php echo $ONG['update-图片'];?>" alt="<?php echo $ONG['描述'];?>"></a>
                    </div>
                <?php

                    foreach( $LANG['huandeng'] as $ONG ){
                ?> 
                    <div class="mui-slider-item">
                        <a href="<?php echo $ONG['连接'];?>" title="<?php echo $ONG['描述'];?>"><img  src="<?php echo $ONG['update-图片'];?>" alt="<?php echo $ONG['描述'];?>"></a>
                    </div>

                <?php }} $ONG = reset( $LANG['huandeng']  ); ?>

                    <div class="mui-slider-item mui-slider-item-duplicate">
                        <a href="<?php echo $ONG['连接'];?>" title="<?php echo $ONG['描述'];?>"><img  src="<?php echo $ONG['update-图片'];?>" alt="<?php echo $ONG['描述'];?>"></a>
                    </div>

                </div>
            <div class="mui-slider-indicator">
                <div class="mui-indicator mui-active"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
            </div>
        </div>

     <div class="indexjge" style="padding:0px;">
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;pdding:0px;">

                <?php
                if( $LANG['caidan'] ){

                    foreach( $LANG['caidan'] as $ONG ){
                ?>  <li class="mui-table-view-cell mui-media mui-col-xs-3" style="border-color:#fff;padding:0px;">
                    
                        <a href="<?php echo $ONG['连接'];?>">
                            <img src="<?php echo $ONG['update-图片'];?>" style="width:60px;height:60px;" />
                            <div class="mui-media-body" style="margin:0px;font-size:12px;"><?php echo $ONG['名字'];?></div>
                        </a>
                    </li>

                     <?php
                        }
                    }?>
              




                   
                </ul> 
    </div>


        <?php echo Dsoft_ad( $LANG['adindex'] ),Dsoft_ad( $LANG['index3ad'] ),Dsoft_ad( $LANG['indexoad']);?>

        <div style="clear:both;"></div>


        <div style="background:#fff;margin-top:10px;height:50px;line-height:50px;text-align:center;">  <b class="mui-icon mui-icon-navigate" style="color:red;"></b> 今日促销 </div>
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;">

        <?php 

            $DATAS =  neirlist(  array( 'cid'=> xjcid($LANG['cpid']),'order'=>'id desc','limit'=>24) , 'center' , $D );

            if( $DATAS['date'] ){

            foreach( $DATAS['date'] as $ong ){

                if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                else $ong['canshu'] =  array();

                $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;
        ?>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                <a href="<?php echo $ong['link'];?>" title="<?php echo $ong['name'];?>">
                    <img src="<?php echo pichttp($ong['tupian']);?>" style="width:100px;height:100px;" />
                    <div class="mui-media-body" style="margin:0px;font-size:12px;text-align:left;height:30px;line-height:15px;text-overflow:none;white-space:normal"><?php echo $ong['name'];?></div>
                    <div style="color:#FF3300;font-size:12px;text-align:left;height:20px;line-height:20px;"><?php echo $HUOBIICO[$ong['huobi']] ;?><?php echo $jiage <=0? $ong['jiage']: $jiage;?><?php if($ong['beizhu'] != '') echo '/'.$ong['beizhu']?></div>
                </a>
            </li>

        <?php } } ?>

        </ul>

        </div>
<script src="<?php echo DQTPL?>js/mui.lazyload.js"></script>
<script src="<?php echo DQTPL?>js/mui.lazyload.img.js"></script>
</body>
</html>
<?php include QTPL.'foot.php';?>
<script type="text/javascript">

    mui.init();

    var header = document.getElementById("header");
    var slider = mui("#slider");

    slider.slider({
        interval: 5000
    });

    (function($) {

        $("body").imageLazyload({
            placeholder: '<?php echo DQTPL?>images/60x60.gif'
        });

        gouwuche();


    })(mui);

</script>
<?php if( strstr( $_SERVER['HTTP_USER_AGENT'] , "essenger" )  && $LANG['kjwxid'] != '' ) include QTPL.'weixin.php'; ?>