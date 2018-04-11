<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $CONN['title']?></title>
    <link rel="shortcut icon" href="/favicon.ico" >
    <link href="<?php echo DQTPL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo DQTPL?>css/common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/index.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-order.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/channel.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/detail.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo DQTPL?>js/lib/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="<?php echo DQTPL?>js/lib/md5.js"></script>
    <script type="text/javascript" src="<?php echo DQTPL?>js/lib/cart.js"></script>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <script type="text/javascript" src="<?php echo DQTPL;?>js/lib/MyFocus.js"></script>
    <script type="text/javascript" src="<?php echo DQTPL;?>js/lib/add.js"></script>
    <?php if(isset($AC) && $AC == 'chading'){?>
    <link href="<?php echo DQTPL?>css/usercenter-basics.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-donation.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-order.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-order-evaluate.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-tryeat.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/order-online.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-rechargebill.css" rel="stylesheet" type="text/css">
    <?php } elseif(isset($AC) && $AC == 'shouhuo'){?>
    <link href="<?php echo DQTPL?>css/usercenter-basics.css" rel="stylesheet" type="text/css">
    <?php } elseif(isset($AC) && $AC == 'setting'){?>
    <link href="<?php echo DQTPL?>css/usercenter-basics.css" rel="stylesheet" type="text/css">
    <?php } elseif(isset($AC) && $AC == 'touxiang'){?>
    <link href="<?php echo DQTPL?>css/usercenter-basics.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-donation.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-order.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-order-evaluate.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-tryeat.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/order-online.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/usercenter-rechargebill.css" rel="stylesheet" type="text/css">
    <?php }?>


    <!--[if lt IE 9]>
    <link rel="stylesheet" href="/css/style-ie.css">
    <link rel="stylesheet" href="/css/style-ie1.css">
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    
</head>
<body>


<!-- 头部开始 -->
<section class="p-common-header">
    <div class="topnav">
        <div class="content clearfix">
            <span class="pull-left">满百包邮（环郊内）
                <a href="/xyd" class="link-VI2" target="_blank">星夜达</a>
            </span>
            <ul class="pull-right list-inline">
                <li class="useriid">
                    <a href="<?php echo mourl( $CONN['userword']);?>" class="link-gray">[ 登录 ]</a>
                    ，
                    <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>" class="link-gray">[ 注册有惊喜 ]</a>
                </li>
                <li class="p-common-topsubnav">果园公告
                    <div class="p-common-noticelist hide">
                        <ul class="list-unstyled">
                            <li>
                                <a href="/notice/detail/821" target="_blank">天天农场活动结束通知</a>
                                <em>new</em>
                            </li>
                            <li>
                                <a href="/notice/detail/820" target="_blank">全仓充值活动调整公告</a>
                                <em>new</em>                            
                            </li>
                            <li>
                                <a href="/notice/detail/819" target="_blank">全仓充值活动调整公告</a>
                                <em>new</em>                            
                            </li>
                        </ul>
                        <div class="text-center"><a href="/notice" target="_blank">查看更多 ></a></div>
                    </div>
                </li>
                <li>|</li>
                <li>
                    <a href="/web/card_change" class="link-gray pull-left" target="_blank">券卡兑换</a>
                </li>
                <li>|</li>
                <li class="p-common-topsubnav">
                    <i class="iconfont">&#xe605;</i>
                    手机果园
                    <div class="p-common-topcode hide">
                        <div class="text-center">
                            <span class="VI-color2">下载果园app，</span>
                            即享果园特价商品
                        </div>
                        <dl class="clearfix">
                            <dt>
                                <img src="<?php echo DQTPL?>images/guan_ewcode2.jpg" alt="" />
                            </dt>
                            <dd>
                                <a href="https://itunes.apple.com/us/app/tian-tian-guo-yuan-fruitday/id880977721" target="_blank">
                                    <img src="<?php echo DQTPL?>images/guan_btn01.jpg" alt="" />
                                </a>
                                <a href="http://cdn.fruitday.com/fruitday.apk" target="_blank">
                                    <img src="<?php echo DQTPL?>images/guan_btn02.jpg" alt="" />
                                </a>
                            </dd>
                        </dl>
                        <dl class="clearfix">
                            <dt>
                                <img src="<?php echo DQTPL?>images/guan_ewcode1.jpg" alt="" />
                            </dt>
                            <dd>
                                <span class="VI-color2">关注果园微信</span>
                                优惠信息实时掌握
                            </dd>
                        </dl>
                    </div>
                </li>
                <li>|</li>
                <li>
                    <i class="iconfont">&#xe61a;</i> <b>400-720-0770</b>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <nav class="navbar ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand logo" href="/"></a>
                </div>
                <div class="collapse navbar-collapse" >
                    <ul class="nav navbar-nav" id="navcon">
                        <li class="<?php if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] == WZHOST)echo 'current'?>">
                            <a href="/">
                                首页
                                <span>Home</span>
                            </a> <em></em>
                        </li>
                        <?php $danye = danye(5);?>
                        <li class="<?php if($DATA['url'] == $danye['url'])echo 'current';?>">
                            <a href="<?php echo $danye['link']?>&cid=5" target="_blank">
                                鲜果
                                <span>Fruit</span>
                            </a> <em></em>
                        </li>
                        <?php $danye = danye(6);?>
                        <li class="<?php if($DATA['url'] == $danye['url'])echo 'current'?>">
                            <a href="<?php echo $danye['link']?>&cid=6" target="_blank">
                                生鲜
                                <span>Fresh</span>
                            </a>
                            <em></em>
                        </li>
                    </ul>
                    <div class="navbar-right">
                            <div class="p-common-topsearch">
                                    <form method="get" onsubmit="return sousuo();">
                                        <input type="search-keyword"   id="URLs" placeholder="请输入关键字" style="background:#fff; border:0;">
                                        <input type="hidden" id="last_keyword" />
                                        <button id="search-button" style="background:#fff; border:0;">
                                            <i class="iconfont">&#xe600;</i>
                                        </button>
                                    </form>
                                    <div class="hotsearch">
                                        热门：
                                        <a href="/prolist/search?keyword=金奇异果" target="_blank">金奇异果</a>
                                        <a href="/prolist/search?keyword=脐橙" target="_blank">脐橙</a>
                                        <a href="/prolist/search?keyword=柚子" target="_blank">柚子</a>
                                        <a href="/prolist/search?keyword=苹果" target="_blank">苹果</a>
                                    </div>
                                    <ul class="subsearch">
                                    </ul>
                            </div>
                        <script type="text/javascript">
                            function sousuo(){
                                var url = document.getElementById("URLs");
                                console.log(url.val);
                                if(url.value== "") alert('请填写关键字');
                                else  window.location.href="<?php echo mourl($CONN['sosoword'],'',$CONN['fenge']);?>"+url.value+"<?php echo $CONN['houzui'];?>";
                                return false;
                            }
                        </script>
                        <div class="p-common-navtoggle" id="navtoggle">
                            <i class="iconfont navtogglebg">&#xe601;</i>
                            <ul class="navtoggle-icon list-unstyled">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
						<div class="p-common-minicart">
                        	<div id="miniCart">
                        		<i class="iconfont cartbg">&#xe601;</i>
                        		<i class="iconfont icon-cart">&#xe60c;</i>
                        		<span class="cartnum">0</span>
                        	</div>
                        	<!-- <div class="cartcont"><i class="iconfont">&#xe607;</i>
                        		 <h5 class="text-center font-color">购物车中还没有商品，赶紧选购吧！</h5>
                        	</div> -->
                            <div class="cart-order cartcont">
                                <i class="iconfont"></i>
                                <ul class="list-unstyled html">
                                
                                </ul>
                                <div class="mcart-pay clearfix">
                                    <div class="pull-left">
                                        共
                                        <span class="VI-color2">0</span>
                                        件商品
                                    </div>
                                    <div class="pull-right">
                                        商品小计
                                        <span class="fs-3 VI-color2"></span>
                                    </div>
                                    <button id="btncart" type="button" class="btn btn-success btn-lg btn-block">立即结算</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</section>

<script type="text/javascript">
    var HTTP = '<?php echo WZHOST;?>'; 
    mui.ajax( HTTP + 'json.php' ,{
        data:{y:'user',d:'get'},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){
            var user = data.data;
            //console.log(user);
            html = '<span class="pull-left">您好，</span> <a href="<?php echo mourl($CONN['userword'])?>" class="link-gray pull-left" target="_blank">'+user.name+'</a> <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'quite');?>" class="link-gray pull-left">退出</a> <div class="p-common-topsubnav pull-left"> 我的果园 <div class="p-common-topmygarden hide"> <dl class="clearfix"> <dt> <img class="img-circle" src="'+user.touxiang+'" alt="" /> </dt> <dd> <span>欢迎您</span> <p>'+user.name+'</p> </dd> </dl> <ul class="list-unstyled clearfix"> <li> <a href="/user/orders" target="_blank">我的订单</a> </li> <li> <a href="/user/tryeat" target="_blank">我的试吃</a> </li> <li> <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'jifen');?>" target="_blank">我的积分</a> </li> <li> <a href="/user/coupon" target="_blank">我的优惠券</a> </li> <li> <a href="/user/transaction" target="_blank">帐户余额</a> </li> <li> <a href="/user/recharge" target="_blank">在线充值</a> </li> <li> <a href="/user/address" target="_blank">收货地址</a> </li> <li> <a href="/user/giftsget" target="_blank">领取赠品</a> </li> </ul> </div> </div>';
            $('.useriid').html(html);
            html1 = '<li class="member-info"> <div class="face-img"> <img src="'+user.touxiang+'" alt=""> </div> <div class="member-content"> <p class="member-name">'+user.name+'</p> <p>您已经消费0元，购买0次</p> </div> </li> <li class="member-content"> <p class="character">余额：</p> <p class="digit">¥'+user.jine+'</p> <a href="user/recharge">立即充值&nbsp;&gt;</a> </li > <li class="member-content"> <p class="character">积分：</p> <p class="digit">'+user.jifen+'</p> <a href="user/jfget">积分明细&nbsp;&gt;</a> </li> <li class="member-content noborderRight"> <p class="character">优惠券：</p> <p class="digit">0张</p> <a href="user/coupon">查看优惠券&nbsp;&gt;</a> </li>';
            $('.user').append(html1); 
        },error:function(xhr){
            // dataerror(xhr , '登录' );
        }
    });
</script>







