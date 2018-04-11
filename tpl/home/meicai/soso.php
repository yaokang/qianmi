<?php if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT');
include QTPL.'head.php';
//p($DATA);

?>

<span class="page1" value="1"></span>
    <div class="content typepage typepage-pad">
        <!-- 筛选器 -->
        
        <!-- 列表 -->
        <div class="f-list clearfix">
            <div class="leftpart pull-left">
                <ul class="shuiguo">     
                    <script>
                        $(".s-kg span").on('click', function() {
                            var showStr = '￥' + $(this).data('price');
                            $(this).addClass('cur').siblings('span').removeClass('cur');
                            $(this).closest('.wrap').find('span.s-unit').text(showStr);
                            $(this).parent('.s-kg').siblings('.s-che').attr('ppid', $(this).data('ppid')).attr('pno', $(this).data('pno'));
                            var objA = $(this).parents('.wrap').find("div.s-img > a");
                            objA.prop('href', objA.data('url') + '-' + $(this).data('ppid'));
                        });
                    </script>
                </ul>
            </div>
        </div>
    </div>


<!--购物车弹出层-->
<div class="zhezhao"></div>
<!-- 购物车 -->
<div class="shop-cart">
    <div class="shop-top">
        <div class="cha pull-right">
            <img src="/images/common/cha.png" alt=""></div>
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
                            <a href="javascript:void(0);" onclick="closeCart();" class="btn btn-primary btn-lg active" role="button" title="点击此按钮，到下一步确认购买信息">
                                继续购物
                            </a>
                        </div>
                        <div class="fr-add pull-left">
                            <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'cart')?>" class="btn btn-primary btn-lg active" title="加入购物车" role="button">
                                去结算
                            </a>
                        </div>
                    </div>
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
    </div>
</div>
<script type="text/javascript">
    var page = 1;
    var num = 10;
    //alert(id);

    var cpid = 'SOSO_<?php echo $HTTP['1'];?>';
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
                html += '<li> <div class="wrap"> <div class="s-img"> <a href="'+value.link+'"  target="_blank"> <img class="lazy" data-original="'+value.tupian+'"src="'+value.tupian+'" alt=""/> </a> </div> <div class="s-info clearfix"> <span class="s-unit pull-right font-color">'+value.huobi+''+value.jiage+'</span> '+value.name+' </div> <div class="p-operate clearfix"> <div class="s-kg clearfix pull-left"> </div> <div class="s-che pull-right" pid="'+value.id+'" ppid="19090" type="normal" pno="2161114115"></div> </div> </div> </li>';
                });
            $('.shuiguo').append(html);
        },
        error:function(xhr){
            dataerror(xhr , '登录' );
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){  
        var range = 1200;          //距下边界长度/单位px  
        var elemt = 500;           //插入元素高度/单位px  
        var totalheight = 0;   
        var HTTP = '<?php echo WZHOST;?>';
        var page = $('.page1').attr('value');
        var num = 10;
        var cpid = 'SOSO_<?php echo $HTTP['1'];?>';
        var suo = true;  
        $(window).scroll(function(){  
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)  
            //console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());
            //console.log("页面的文档高度 ："+$(document).height());
            //console.log('浏览器的高度：'+$(window).height());
            totalheight = parseFloat($(window).height()) + parseFloat(srollPos); 
            if(($(document).height()-range) <= totalheight ) {  
                
                //alert(page);
                if (suo==true) {
                    suo = false;
                        var page11 = $('.page1').attr('value');
                        var page11xin = parseInt(page11)+1;
                        $('.page1').attr('value',page11xin);
                        
                        mui.ajax( HTTP + 'json.php' ,{
                            data:{y:'cplist',d:'get',page:page11xin,num:num,cpid:cpid},
                            dataType:'json',
                            type:'post',
                            timeout:10000,
                            success:function( data ){
                                var shuiguo = data.data;
                                if(shuiguo == ''){
                                    suo = false;
                                }else{
                                    suo = true;
                                }
                                //console.log(shuiguo);
                                var html = '';
                                $.each(shuiguo,function(name,value){
                                    html += '<li> <div class="wrap"> <div class="s-img"> <a href="'+value.link+'"  target="_blank"> <img class="lazy" data-original="'+value.tupian+'"src="'+value.tupian+'" alt=""/> </a> </div> <div class="s-info clearfix"> <span class="s-unit pull-right font-color">'+value.huobi+''+value.jiage+'</span> '+value.name+' </div> <div class="p-operate clearfix"> <div class="s-kg clearfix pull-left"> </div> <div class="s-che pull-right" pid="15865" ppid="19090" type="normal" pno="2161114115"></div> </div> </div> </li>';
                                    });
                                $('.shuiguo').append(html);
                            },
                            error:function(xhr){
                                dataerror(xhr , '登录' );
                            }
                        });
                };

                
            }  
        });  

    });  
</script>


<?php include QTPL.'foot.php';?>