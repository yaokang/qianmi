<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link rel="shortcut icon" href="/favicon.ico" >
    <link href="<?php echo DQTPL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo DQTPL?>css/common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DQTPL?>css/style.css" rel="stylesheet" type="text/css">
    <?php if($AC == 'reg'){?>
    <link href="<?php echo DQTPL?>css/register.css" rel="stylesheet" type="text/css">
    <?php }elseif($AC=='login'){?>
    <link href="<?php echo DQTPL?>css/login.css" rel="stylesheet" type="text/css">
    <?php }elseif($AC=='cart'){?>
    <link href="<?php echo DQTPL?>css/cart.css" rel="stylesheet" type="text/css">
    
    <?php }?>
    <script type="text/javascript" src="<?php echo DQTPL?>js/lib/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="<?php echo DQTPL?>js/lib/md5.js"></script>
    <script type="text/javascript" src="<?php echo DQTPL?>js/lib/cart.js"></script>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="/css/style-ie.css">
    <link rel="stylesheet" href="/css/style-ie1.css">
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    <!-- DSP -->
    <?php if($AC=='cart'){?>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="dialog" src="<?php echo DQTPL?>js/lib/dialog.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="back" src="<?php echo DQTPL?>js/lib/back.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="base64" src="<?php echo DQTPL?>js/lib/jquery.base64.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="evaluate" src="<?php echo DQTPL?>js/evaluate.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="ajax" src="<?php echo DQTPL?>js/lib/ajax.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="topindex" src="<?php echo DQTPL?>js/lib/topindex.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lazyload" src="<?php echo DQTPL?>js/lib/jquery.lazyload.min.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="sly" src="<?php echo DQTPL?>js/lib/sly.min.js"></script>
    <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="rose" src="<?php echo DQTPL?>js/rose.js"></script>
    <?php }?>
    
</head>
<body>
<!-- top -->

<!-- 头部开始 -->
<section class="p-common-header">
    <div class="topnav">
        <div class="content clearfix">
        <span class="pull-left">
            满百包邮（环郊内）
            <a href="/xyd" class="link-VI2" target="_blank">星夜达</a>
        </span>

            <ul class="pull-right list-inline">
                <li class="useriid">
                    <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'login');?>" class="link-gray">[ 登录 ]</a>
                    ，
                    <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'reg');?>" class="link-gray">[ 注册有惊喜 ]</a>
                </li>
                <li class="p-common-topsubnav">
                    果园公告
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
                <li>|</li
                        >
                <li>
                    <i class="iconfont">&#xe61a;</i> <b>400-720-0770</b>
                </li>
            </ul>
        </div>
    </div>
    <?php if($AC == 'cart'){?>
    <div class="content">
        <nav class="navbar ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand logo" href="/"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="icons-cart clearfix pull-right">
                        <li class="pull-left li1 cur">
                            <span>1</span>
                            <p>我的购物车</p>
                        </li>
                        <li class="pull-left li2 ">
                            <span>2</span>
                            <p>确认订单信息</p>
                        </li>
                        <li class="pull-left li3">
                            <span>3</span>
                            <p>成功提交订单</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php }elseif($AC == 'ding'){?>
    <div class="content">
        <nav class="navbar ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand logo" href="/"></a>
                </div>
                <div class="collapse navbar-collapse" >
                    <ul class="icons-cart clearfix pull-right list-unstyled">
                        <li class="pull-left li1 cur">
                            <span>1</span>
                            <p>我的购物车</p>
                        </li>
                        <li class="pull-left li2 cur">
                            <span>2</span>
                            <p>确认订单信息</p>
                        </li>
                        <li class="pull-left li3">
                            <span>3</span>
                            <p>成功提交订单</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php }elseif($AC == 'select'){?>
    <div class="content">
        <nav class="navbar ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand logo" href="/"></a>
                </div>
                <div class="collapse navbar-collapse" >
                    <ul class="icons-cart clearfix pull-right list-unstyled">
                        <li class="pull-left li1 cur">
                            <span>1</span>
                            <p>我的购物车</p>
                        </li>
                        <li class="pull-left li2 cur">
                            <span>2</span>
                            <p>确认订单信息</p>
                        </li>
                        <li class="pull-left li3">
                            <span>3</span>
                            <p>成功提交订单</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php }?>
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