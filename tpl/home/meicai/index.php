<?php if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT');
include QTPL.'head.php';


?>
<!-- 轮播图开始 -->
<section class="p-component-banner" id="p-banner">
    <div class="frame" id="frameBanner">
        <ul class="slidee">
        <?php foreach($LANG['pchuandeng'] as $v){?>
            <li>
                <a href="<?php echo $v['连接']?>" style="background-image:url(<?php echo $v['update-图片']?>)" target="_blank"></a>
            </li>
        <?php }?>
        </ul>
    </div>
    <ul class="slidebtn"></ul>
</section>
<!-- 中部广告开始 -->
<div class="show-ad w-1280">
    <ul class="clearfix">
        <?php $i = 1; foreach($LANG['guanggao'] as $v){?>
        <li class="pull-left <?php if($i==4) echo 'last';?>">
            <a href="<?php echo $v['连接']?>" target="_blank">
                <img alt="" class="lazy" data-original="<?php echo $v['update-图片']?>" src="<?php echo $v['update-图片']?>">
            </a>
        </li>
        <?php $i++; }?>
        
    </ul>
</div>

<!-- 果园推荐 -->
<div class="fruit-kinds ">
    <div class="til clearfix">
        <a href="/prolist/index/40" target="_blank" class="more">更多 &gt;</a>
        <ul class="pull-right"> </ul>
        <div class="textPic"><img class="lazy" data-original="http://img9.fruitday.com/guan_t1.png" src=""></div>
    </div>
        <div class="good-list clearfix">
        <ul class="clearfix cplist">
            
        </ul>
    </div>
</div>
<script type="text/javascript">
    var HTTP = '<?php echo WZHOST;?>';
    var page = 1;
    var num = 9;
    var cpid = 3;
    mui.ajax( HTTP + 'json.php' ,{
        data:{y:'cplist',d:'get',page:page,num:num,cpid:cpid},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){
            var cplist = data.data;
            console.log(cplist);
            var html = '';
            $.each(cplist,function(name,value){
                html += '<li class="pro_list" pid="15583" ppid="18799" type="normal" pno="2161223115"> <div class="s-img"> <a href="'+value.link+'" target="_blank"> <img class="lazy" data-original="'+value.tupian+'" alt="" src="'+value.tupian+'"> </a> </div> <div class="s-info"> <div class="s-name"> '+value.name+' </div> <div class="s-unit"> ￥'+value.jiage+'/'+value.beizhu+' </div> <div class="s-che"  pid="'+value.id+'" ></div> </div> <div class="pro_list_pos"> <span class="pro_list_span" style="background: #65A032">新品</span> </div> </li>';
                });
            $('.cplist').append(html);
        },
        error:function(xhr){
            dataerror(xhr , '登录' );
        }
    });
</script>

<!-- 全球鲜果 -->
<div class="fruit-kinds ">
    <div class="til clearfix">
        <a href="/prolist/index/40" target="_blank" class="more">更多 &gt;</a>
        <ul class="pull-right"> </ul>
        <div class="textPic"><img class="lazy" data-original="http://img9.fruitday.com/guan_t2.png" src="http://img9.fruitday.com"></div>
    </div>
        <div class="good-list clearfix">
        <ul class="clearfix shuiguo">
            
        </ul>
    </div>
            <div class="ad">
        <a target="_blank" href="/prodetail/index/7154"><img class="lazy" data-original="https://imgws4.fruitday.com/images/2016-12-28/a7f1b3f8cec6001e9505c996d2dabcc4.jpg" src="http://img9.fruitday.com/guan_EmptyAd@2x.png"></a>
    </div>
    
</div>
<script type="text/javascript">
    var HTTP = '<?php echo WZHOST;?>';
    var page = 1;
    var num = 9;
    var cpid = 5;
    mui.ajax( HTTP + 'json.php' ,{
        data:{y:'cplist',d:'get',page:page,num:num,cpid:cpid},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){
            var shuiguo = data.data;
            //console.log(shuiguo);
            var html = '';
            $.each(shuiguo,function(name,value){
                html += '<li class="pro_list" pid="15583" ppid="18799" type="normal" pno="2161223115"> <div class="s-img"> <a href="'+value.link+'" target="_blank"> <img class="lazy" data-original="'+value.tupian+'" alt="" src="'+value.tupian+'"> </a> </div> <div class="s-info"> <div class="s-name"> '+value.name+' </div> <div class="s-unit"> ￥'+value.jiage+'/'+value.beizhu+' </div> <div class="s-che"  pid="'+value.id+'" ></div> </div> <div class="pro_list_pos"> <span class="pro_list_span" style="background: #65A032">新品</span> </div> </li>';
                });
            $('.shuiguo').append(html);
        },
        error:function(xhr){
            dataerror(xhr , '登录' );
        }
    });
</script>

<!-- 生鲜美食 -->
<div class="fruit-kinds ">
    <div class="til clearfix">
        <a href="/prolist/index/277" target="_blank" class="more">更多 &gt;</a>
        <ul class="pull-right"> </ul>
        <div class="textPic"><img class="lazy" data-original="http://img9.fruitday.com/guan_t3.png" src=""></div>
    </div>
        <div class="good-list clearfix">
        <ul class="clearfix sx">
            
        </ul>
    </div>
    
</div>
<script type="text/javascript">
    var HTTP = '<?php echo WZHOST;?>';
    var page = 1;
    var num = 9;
    var cpid = 8;
    mui.ajax( HTTP + 'json.php' ,{
        data:{y:'cplist',d:'get',page:page,num:num,cpid:cpid},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){
            var sx = data.data;
            //console.log(sx);
            var html = '';
            $.each(sx,function(name,value){
                html += '<li class="pro_list" pid="15583" ppid="18799" type="normal" pno="2161223115"> <div class="s-img"> <a href="'+value.link+'" target="_blank"> <img class="lazy" data-original="'+value.tupian+'" alt="" src="'+value.tupian+'"> </a> </div> <div class="s-info"> <div class="s-name"> '+value.name+' </div> <div class="s-unit"> ￥'+value.jiage+'/'+value.beizhu+' </div> <div class="s-che"  pid="'+value.id+'" ></div> </div> <div class="pro_list_pos"> <span class="pro_list_span" style="background: #65A032">新品</span> </div> </li>';
            });
            $('.sx').append(html);
        },
        error:function(xhr){
            dataerror(xhr , '登录' );
        }
    });
</script>

<!--购物车弹出层-->
<div class="zhezhao"></div>
<!-- 购物车 -->
<div class="shop-cart">
    <div class="shop-top">
        <div class="cha pull-right">
            <img src="<?php echo DQTPL?>images/common/cha.png" alt=""></div>
    </div>
    <div class="shop-content">
        <div class="title clearfix">
            <div class="suc pull-left"></div>
            <div class="adds pull-left">
                <p>加入购物车成功！</p>

            </div>
        </div>
        <p class="row2">
            购物车中共
            <em class="cartcount">0</em>
            件商品 | 商品小计
            <em class="cartprice">￥0</em>
        </p>
        <!--<div class="choosed clearfix">-->
            <!--<ul>-->
                <!--<li>-->
                    <div class="buy clearfix">
                        <div class="fr-buy pull-left">
                            <a href="javascript:void(0);" onclick="closeCart();" class="btn btn-primary btn-lg active" role="button" title="点击此按钮，到下一步确认购买信息">继续购物</a>
                        </div>
                        <div class="fr-add pull-left">
                            <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'cart')?>" class="btn btn-primary btn-lg active" title="加入购物车" role="button">
                                去结算
                            </a></div>
                    </div>
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
    </div>
</div>




<?php include QTPL.'foot.php';?>