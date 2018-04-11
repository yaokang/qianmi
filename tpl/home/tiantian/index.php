<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <meta name="apple-itunes-app" content="app-id=myAppStoreID, affiliate-data=myAffiliateData, app-argument=myURL">
        <title><?php if(isset($DATA['name']))echo $DATA['name'],'-';if( isset($PAGE) && $PAGE != '1' )echo $LANG['pageqian'].$PAGE.$LANG['pagehou'].'-';echo $CONN['title'];?></title>
        <meta name="description" content="<?php echo !isset($DATA['miaoshu']) || $DATA['miaoshu']==''?$CONN['miaoshu']:$DATA['miaoshu'];?>" /> 
        <meta name="keywords" content="<?php echo !isset($DATA['guanjian']) ||$DATA['guanjian']==''?$CONN['guanjian']:$DATA['guanjian'];?>" />
        <link rel="stylesheet" href="/css/v3/common.min.css" />
        <link rel="stylesheet" href="/css/v3/index.min.css" />
        <link rel="stylesheet" href="/js/v3/swiper/swiper.min.css" />
        <script type="text/javascript">
   function sousuo(){
    var url = document.getElementById("URLs");
	 if(url.value== "")
		 alert('请填写关键字');
	 else
	 window.location.href="<?php echo mourl($CONN['sosoword'],'',$CONN['fenge']);?>"+url.value+"<?php echo $CONN['houzui'];?>";
  return false;
    }
  </script>
        <style>
        .nav-list{}

        .nav-list li{width:24.999%;float:left;text-align:center;}
        .nav-list li img{display:inline-block;height:60px;width:60px;}

        .nav-list li a{display:inline-block;width:60px;height:80px;margin-bottom:18px;overflow:hidden;color:#000;}

        .zuobi{background:#fff;padding: 20px 0 0 10px;margin-top:6px;}
        </style>
    </head>

    <body class="has-footer">

        <div class="body-height"></div>

        <section class="container index">

            <div class="swiper-container swiper-banner">

                <div class="swiper-wrapper">

                    <?php

                    if( $LANG['huandeng'] ){

                        foreach( $LANG['huandeng'] as $ONG ){
                        ?> 
                        <div class="swiper-slide">
                        <a href="<?php echo $ONG['连接'];?>" title="<?php echo $ONG['描述'];?>"><img src="/images/v3/common/EmptyList.png" data-src="<?php echo $ONG['update-图片'];?>" alt="<?php echo $ONG['描述'];?>"></a>

                    </div>
                        <?php
                        }
                    }?>

                </div>
                <div class="swiper-pagination"></div>
            </div>


            <div class="letters">
                <div class="text"><img src="/images/v3/index/letters.png" alt=""></div>

                <div class="swiper-container swiper-letters">

                    <div class="swiper-wrapper">
                       
                       <?php

                       $DATAS =  neirlist(  array( 'cid'=> xjcid(1),'order'=>'id desc','limit'=>3) , 'center' , $D ); 

                       if( $DATAS['date'] ){

                           foreach( $DATAS['date'] as $ONG){

                       ?>    <div class="swiper-slide">
                            <a href="<?php echo $ONG['link'];?>"><?php echo $ONG['name'];?></a>
                        </div>

                        <?php } }?>


                    </div>

                </div>
            </div>

      
                </div>
            </div>

            <div class="zuobi">

                <ul class="nav-list clearfix">

                  <?php

                    if( $LANG['caidan'] ){

                        foreach( $LANG['caidan'] as $ONG ){
                        ?> 

                        <li class="nav-item">
            <a class="ellipsis" href="<?php echo $ONG['连接'];?>"> 

            <img src="<?php echo $ONG['update-图片'];?>">
            
            <?php echo $ONG['名字'];?></a>
            </li>
                       
                        <?php
                        }
                    }?>
                 </ul>
               <div style="clear:both;"></div>
            </div>



            <div class="first-ads">

                <?php echo $LANG['indexad']?>
                
            </div>

            <?php $chanpin = menulist(1,$D);

            if( !$chanpin) $chanpin = array();
            
            foreach($chanpin as $ongs){
            
            ?>


           <div class="must-buy scene">
                <a href="<?php echo $ongs['link'];?>" class="scene-img">
                    <img src="/images/v3/common/EmptyList.png" data-src="<?php echo pichttp($ongs['tupian']);?>" alt="去世界尽头吃一颗果子">
                    <span><img src="/images/v3/index/banner_arrow.png" alt=""></span>
                </a>
                <div class="swiper-container swiper-list swiper-container-horizontal">
                    <div class="swiper-wrapper">


                                                                                                                                               <?php 
                
                 
                    $DATAS =  neirlist(  array( 'cid'=> xjcid($ongs['id']),'order'=>'id desc','limit'=>20) , 'center' , $D );
                    if( $DATAS['date'] ){

                    foreach( $DATAS['date'] as $ong ){
                        if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                        else $ong['canshu'] =  array();

                        $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                        $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;
                ?>
                                                                                                                                                <a class="swiper-slide"    href="<?php echo $ong['link'];?>" title="<?php echo $ong['name'];?>">
                            <img src="/images/v3/common/EmptyList.png" data-src="<?php echo pichttp($ong['tupian']);?>" alt="<?php echo $ong['name'];?>">
                                     <?php if($ong['beizhu'] !=''){ ?> <span style="background: #FF5353"><?php echo $ong['beizhu'];?></span>
                                    <?php  }?>
                                                        <div class="dt"><?php echo $ong['name'];?></div>
                            <div class="dd"><?php echo $HUOBIICO[$ong['huobi']] ;?><?php echo $jiage <=0? $ong['jiage']: $jiage;?> 
                            <?php if($ong['canshu'] ){ ?>/ <?php echo $shuju['0']['canshu'];?><?php } ?></div>
                        </a>

                        <?php
                    }
                    }
                ?>


                                                                                                                                                                    <a class="swiper-slide all" href="<?php echo $ongs['link'];?>">
                            全部推荐<i class="iconfont icon-morehome"></i>
                        </a>
                                                                                            </div>
                </div>
            </div>

            <?php } ?>






                <div class="like-buy">

                <div class="item">

                <?php 
                
                 
                    $DATAS =  neirlist(  array( 'cid'=> xjcid(1),'order'=>'id desc','limit'=>20) , 'center' , $D );
                    if( $DATAS['date'] ){

                    foreach( $DATAS['date'] as $ong ){
                        if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                        else $ong['canshu'] =  array();

                        $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                        $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;
                ?>

 

                    <a href="<?php echo $ong['link'];?>" title="<?php echo $ong['name'];?>">
                        <div class="img">
                            <img src="/images/v3/common/EmptyList.png" data-src="<?php echo pichttp($ong['tupian']);?>" alt="<?php echo $ong['name'];?>">
                                                    </div>
                        <dl>
                            <dt><?php echo $ong['name'];?></dt>
                            <dd><?php echo $ong['beizhu'];?></dd>
                            <div>
                                                                                            </div>
                            <p><?php echo $HUOBIICO[$ong['huobi']] ;?><?php echo $jiage <=0? $ong['jiage']: $jiage;?> 
                            <?php if($ong['canshu'] ){ ?>/ <?php echo $shuju['0']['canshu'];?><?php } ?>
                        
                            
                            
                            </p>
                        </dl>
                    </a>
                <?php
                    }
                    }
                ?>


                 </div>


            </div>


        </section>

        <header>
            <div class="position">
                <em class="curr_region_name"> </em>
                
            </div>
            <div class="search">
    <i class="iconfont icon-searchpage"></i>
    <div class="input-frame">新鲜水果、生鲜</div>
</div>

        </header>
        <!-- 底部导航 -->
<footer class="main-nav">
    <a class="footer-item active" href="<?php echo WZHOST;?>">
        <i class="iconfont icon-homeclick"></i>
        <span>首页</span>
    </a>
    <a class="footer-item" href="<?php $ong = danye(1); echo $ong['link'];?>">
        <i class="iconfont icon-kinddefault"></i>
        <span>分类</span>
    </a>
    <a class="footer-item" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>">
        <i class="iconfont icon-cartdefault"></i>
        <span>购物车</span>
    </a>
    <a class="footer-item" href="<?php echo mourl( $CONN['userword']);?>">
        <i class="iconfont icon-centerdefault"></i>
        <span>我的果园</span>
    </a>
</footer>



        <!--搜索弹出框-->
        <div class="modal search-box">

            <form action="get" onsubmit="return sousuo();">

                <div class="m-component-nav">

                    <div class="navbar-header">
                        <i class="iconfont icon-morehome"></i>
                        <span>返回</span>
                    </div>
                    
                    <div class="searchbar">
                        <i class="iconfont icon-searchpage"></i>
                        <input type="text" id="URLs" placeholder="新鲜水果、生鲜">
                        <input type="hidden" id="last_keyword" />
                        <i class="iconfont icon-searchhomedel"></i>
                    </div>
                    <input type="button" value="搜索" id="search-btn" >
                </div>

            </form>
            
            <section>
                <div class="keyword hot">
                    <div class="title">热门搜索</div>
                    <div class="con"> <?php echo keyset($LANG['guanjianci']);?> </div>
                </div>

            </section>
            <ul class="search-tips">
               
            </ul>
        </div>
       

        <div class="back-top">
            <i class="iconfont icon-tophome"></i>
        </div>
        <input type="hidden" id="dsp_page" value="1">
       
     
        <script src="/js/v3/lib/jquery-3.0.0.min.js"></script>
        <script src="/js/v3/lib/fastclick.min.js"></script>
        <script src="/js/v3/swiper/swiper.min.js"></script>
        <script src="/js/v3/base/global.js"></script>
        <script src="/js/v3/base/common.js"></script>
        <script src="/js/v3/index/index.js"></script>
    </body>
</html>
