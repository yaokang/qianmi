<section class="p-common-footer">
    <div class="content">
        <ul class="list-inline clearfix">
            <li class="p-common-icon p1"></li>
            <li class="p-common-icon p2"></li>
            <li class="p-common-icon p3"></li>
            <li class="p-common-icon p4"></li>
        </ul>

        <div class="clearfix footbar">
            <div class="block4">
                <div class="logo"></div>
                <div class="tel"><img src="<?php echo DQTPL?>images/guan_tel.png" alt="" /></div>
                <div class="font-gray fs-4">
                    <span class="font-color">电话客服</span> 09:00 - 21:00
                    <br>
                </div>
            </div>

            <ul class="block2 list-unstyled">
                <li><img src="<?php echo DQTPL?>images/guan_ewcode1.jpg" alt="" /><span>天天果园官方微信</span></li>
                <li><img src="<?php echo DQTPL?>images/guan_ewcode2.jpg" alt="" /><span>天天果园APP</span></li>
            </ul>
            <ul class="block3 list-unstyled">
                <li><h4>购物指南</h4><a href="/help/index/725">新用户注册</a><a href="/help/index/726">在线下单</a><a href="/help/index/727">支付方式</a></li>
                <li><h4>配送说明</h4><a href="/help/index/728">运费说明</a><a href="/help/index/729">运费方式</a><a href="/help/index/730">发票说明</a></li>
                <li><h4>售后服务</h4><a href="/help/index/731">退换货规则</a><a href="/help/index/732">服务保障承诺</a><a href="/help/index/733">验货与签收</a></li>
                <li><h4>企业服务</h4><a href="/help/index/734">企业订购</a><a href="/help/index/735">公司简介</a><a href="/help/index/736">定制专区</a></li>
            </ul>

        </div>
        <div class="copyright text-center">
            <p class="fs-2 font-color">版权所有 &copy;2017上海天天鲜果电子商务有限公司&nbsp;&nbsp;保留所有权利 | <a href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action" style="color:#999;" target="_blank">沪ICP备12042163</a></p>
            <p class="fs-2 VI-color2">天天果园&nbsp;&nbsp;鲜果网购</p>
            <div> 
                <img src="<?php echo DQTPL?>images/guan_wgdjp.png" alt="" class="card-goverment"/>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="/tpl/h-ui/js/layer.js"></script>


<script type="text/javascript" src="<?php echo DQTPL?>js/lib/cart.js"></script>
<script src="<?php echo DQTPL?>js/require.js" data-main="<?php echo DQTPL?>js/main"></script>
<script type="text/javascript">

     var ANNIU = true;
       var UID = 0; /*默认用户uid*/
    var GOUCHE = [];  /* 购物 默认参数列表 */
     var TOKEN = ''; /* token */
      var HTTP = '<?php echo WZHOST;?>'; /*js 访问网址*/
    var USERUL = '<?php if(isset( $_SESSION['reback'])) echo $_SESSION['reback']; else echo mourl( $CONN['userword']);?>'; /*用户跳转网址*/
 var $HUOBIICO = <?php echo json_encode($HUOBIICO);?>; /*货币单位*/
     var HUOBI = <?php echo json_encode( $HUOBI );?>; /*货币*/
    var huobi0 = huobi1 = huobi2 = huobi3 = 0;
    var HUOZUI = '<?php echo $CONN['houzui']?>';
    var jiesuan = '<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart');?>';
    $(function() {
        $('.p-common-minicart').delegate('#btncart', 'click', function(e){
            window.open(jiesuan);
        });
    });

    mui.ajax( HTTP + 'json.php' ,{
        data:{y:'gouwuche',d:'get'},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){
            setgwnum( data );
        },
        error:function(xhr){
            
        }
    });


    function dataerror( data , ming ){

        if( data.status == '401' ){

            mui.toast ( '需要登录用户' ,{ url:USERUL } );

        }else if( data.status == '304' ){

            layer.msg('修改'+ming+'失败' );

            //mui.toast ('修改'+ming+'失败' );

        }else if( data.status == '410' ){

            layer.msg('删除'+ming+'失败' );
               
            //mui.toast ('删除'+ming+'失败' );

        }else if( data.status == '404' ){

            layer.msg ('查询'+ming+'失败' );

        }else if( data.status == '406' ){

            layer.msg ('新增'+ming+'失败' );

        }else if( data.status == '415' ){

            if( !data.responseJSON &&  data.responseText ){

                data.responseJSON = eval("("+ data.responseText +")");

            }

            if( data.responseJSON ){

                DATA = data.responseJSON;

                if( DATA.code == 2 ){

                    if( $( ".imgsrc" ).length > 0 ) $( ".imgsrc" ).attr( { src : $(".imgsrc").attr('src')+'&1=' } );

                }

                if( DATA.token && DATA.token != '') TOKEN = DATA.token;

                layer.msg (DATA.msg );

            }else layer.msg ('非法数据' );

        }else layer.msg ('数据错误' );
    }

    function setgwnum( data ){

        DATA = data.data;
        html = '';
        html2 = '';
        var zongjia = 0;
        if( DATA ){
            //console.log(DATA);
            mui.each(DATA.data, function( index, item ){
                //console.log(DATA.data);
                mui.each(item , function( dage, vvv ){
                    var cpid = vvv.cpid;
                    var canshu = vvv.canshu
                    var chash =  hex_md5( cpid+'_'+canshu  );
                    //alert(chash);
                    html += '<li id="c_normal_'+vvv.cpid+'" type="normal" pid="'+vvv.cpid+'" ppid="'+vvv.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"> <a href="'+vvv.link+'" target="_blank"> <img class="pull-left" src="'+vvv.tupian+'" alt=""> <div class="p-minicart-info"> <h5>'+vvv.name+'</h5> <h5>￥'+vvv.jiage+'/5斤</h5></div></a><div class="num_sel_lage p-mincart-modify"><span class="inC p-mincart-act btn-minus">-</span><input type="text" class="set-num-in" value="'+vvv.num+'" readonly="true" ><span class="deC p-mincart-act btn-plus" >+</span></div><span class="mini-cartlist-delete p-mincart-delete">删除</span></li>';
                    html2 += '<li id="c_normal_'+vvv.cpid+'" type="normal" pid="'+vvv.cpid+'" ppid="'+vvv.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"><div class="cartbox clearfix"><div class="cartorder-select pull-left clearfix"> <!--<p class="select selected"></p><input type="hidden" value="" />--></div><div class="cart-imgs pull-left"><a href="'+vvv.link+'" target="_blank"><img src="'+vvv.tupian+'" alt=""></a></div><div class="cart-name pull-left"><p><a href="/prodetail/index/16729" target="_blank">'+vvv.name+'</a></p></div><div class="spec-num pull-left"><p>'+vvv.beizhu+'</p></div><div class="price-singular pull-left"><p>￥'+vvv.jiage+'</p></div><div class="num_sel_lage cart-goods pull-left clearfix"><span class="inC num pull-left btn-minus">-</span><input class="pull-left" type="tel" disabled="" name="qty" autocomplete="on" value="'+vvv.num+'"><span class="deC num pull-left btn-plus">+</span></div><div class="sum pull-left"><p>￥'+vvv.yuanjia+'</p></div><div class="delete pull-left"><p class="m-cartlist-delete deleteCartpro">删除</p></div></div><div class="cl"></div></li>';
                    var zhongjia = parseFloat(vvv.num*vvv.jiage);
                    zongjia += parseFloat(zhongjia);
                    //console.log(zhongjia);
                    GOUCHE[dage] = vvv['num'];
                 });
            });
            
            var jiage = zongjia.toFixed(2);
            //console.log(jiage);
            html1 = '<div class="pull-left">共<span class="VI-color2">'+data.data.count+'</span>件商品</div><div class="pull-right">商品小计<span class="fs-3 VI-color2">'+jiage+'</span></div><button id="btncart" type="button" class="btn btn-success btn-lg btn-block">立即结算</button>';

            html3 = '<div class="cart-pay pull-right"><span>已选择<em>'+DATA.count+'件</em>商品  |  订单金额</span><span class="all-order">￥'+jiage+'</span><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'ding')?>" id="btngopay" class="go-pay">去结算</a></div><div class="cl"></div>';

            $("body").find(".cartnum").html(DATA.count);

            $("body").find(".html3").html(html3);

            $("body").find(".html2").html(html2);

            $("body").find(".html").html(html);

            $("body").find(".mcart-pay").html(html1);


            if( DATA.count > 0) $(".mui-icon-mcgwc").find(".mui-badge").show();
            else{
                $(".mui-icon-mcgwc").find(".mui-badge").hide();
                $(".mui-bar-nav").find(".mui-badge").hide();
            }

           

        }
    
    
    }


</script>

<script>

    //点击增加购物车商品数量

    $('.p-common-minicart').delegate('.deC', 'click', function (event) {
        var $num, _val;
        var timeout;
        event.stopPropagation();

        var parent_li = $(this).parents('li');

        //console.log(parent_li);

        $num = $('.list-unstyled').find('.deC').filter(function (i) {
            return $(this).parents('li').attr('ppid') == parent_li.attr('ppid') ? true : false;
        }).prev('input');

        //alert($num.val());
        _val = parseInt($num.val());
        if (_val <= 1) {
            _val = 1;
        }
        _val++;
        $num.val(_val);

        //alert(_val);

        var data = {
            'pid': parent_li.attr('pid'),
            'ppid': parent_li.attr('ppid'),
            'type': parent_li.attr('canshu'),
            'qty': _val,
            'ik': parent_li.attr('id'),
        };
        //alert(data.qty);
        jiarugo( data.pid ,data.qty ,data.type ,'' ,'');

        
    });

    //点击减少购物车商品数量

    $('.p-common-minicart').delegate('.inC', 'click', function (event) {
        var $num, _val;
        var timeout;
        event.stopPropagation();

        var parent_li = $(this).parents('li');
        $num = $('.list-unstyled').find('.inC').filter(function (i) {
            return $(this).parents('li').attr('ppid') == parent_li.attr('ppid') ? true : false;
        }).next('input');

        _val = parseInt($num.val());

        if (_val == 1) return;
        _val--;
        if (_val > 1) {
            $num.val(_val);
        } else {
            $num.val(1);
        }

        var data = {
            'pid': parent_li.attr('pid'),
            'ppid': parent_li.attr('ppid'),
            'type': parent_li.attr('canshu'),
            'qty': $num.val(),
            'ik': parent_li.attr('id'),
        };
        //alert(data.qty);
        jiarugo( data.pid ,data.qty ,data.type ,'' ,'');
        //Cart.miniupdate(data);
    });


     /*
         * cart btn
         */
        $('.cartspage').delegate('.deC', 'click', function (event) {
            var $num, _val;
            var timeout;
            event.stopPropagation();

            var parent_li = $(this).parents('li');
            $num = $('.list-unstyled').find('.deC').filter(function (i) {
                return $(this).parents('li').attr('ppid') == parent_li.attr('ppid') ? true : false;
            }).prev('input');

            //alert($num.val());
            _val = parseInt($num.val());
            if (_val <= 1) {
                _val = 1;
            }
            _val++;
            $num.val(_val);

            var data = {
                'pid': parent_li.attr('pid'),
                'ppid': parent_li.attr('ppid'),
                'type': parent_li.attr('canshu'),
                'qty': _val,
                'ik': parent_li.attr('id'),
            };

            if (timeout) {
                clearTimeout(timeout);
            }

            timeout = setTimeout(function () {
                jiarugo( data.pid ,data.qty ,data.type ,'' ,'');
            }, 20);

        });

        /*
         * cart-mini  btn
         */
        

        /*
         * cart  btn
         */
        $('.cartspage').delegate('.inC', 'click', function (event) {

            var $num, _val;
            var timeout;
            event.stopPropagation();

            var parent_li = $(this).parents('li');
            $num = $('.list-unstyled').find('.inC').filter(function (i) {
                return $(this).parents('li').attr('ppid') == parent_li.attr('ppid') ? true : false;
            }).next('input');

            _val = parseInt($num.val());

            if (_val == 1) return;
            _val--;
            if (_val > 1) {
                $num.val(_val);
            } else {
                $num.val(1);
            }

            var data = {
                'pid': parent_li.attr('pid'),
                'ppid': parent_li.attr('ppid'),
                'type': parent_li.attr('canshu'),
                'qty': _val,
                'ik': parent_li.attr('id'),
            };

            if (timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function () {
                jiarugo( data.pid ,data.qty ,data.type ,'' ,'');
            }, 20);

        });


    //删除购物车中的某件商品

    $('.p-common-minicart').delegate('.mini-cartlist-delete', 'click', function (event) {
        event.stopPropagation();
        var parent_li = $(this).parents('li');
        var pdata = {
            'pid': parent_li.attr('pid'),
            'ppid': parent_li.attr('data'),
            'type': parent_li.attr('canshu'),
            'ik': parent_li.attr('id')
        };
        //console.log(pdata);
        shanchugo(pdata.pid,pdata.type,'','');
        //Cart.miniremove(pdata);
    });

    $('.cartspage').delegate('.m-cartlist-delete', 'click', function (event) {
        event.stopPropagation();
        var parent_li = $(this).parents('li');
        var pdata = {
            'pid': parent_li.attr('pid'),
            'ppid': parent_li.attr('data'),
            'type': parent_li.attr('canshu'),
            'ik': parent_li.attr('id')
        };
        //console.log(pdata);
        shanchugo(pdata.pid,pdata.type,'','');
        //Cart.miniremove(pdata);
    });




    $(function(){

        $('body').delegate('.s-che','click',function(){

            $(this).animate({backgroundPosition:"-514px -291px"},500);
            var pid = $(this).attr('pid');
            var ppid = $(this).attr('ppid');
            var pno = $(this).attr('pno');
            var type = $(this).attr('type');

            //加入购物车
            addCart(pid,ppid,pno,type);


        })


        $('.shop-cart .shop-top .cha').click(
            function(){
                $('.shop-cart').fadeOut(800);
                $('.zhezhao').fadeOut(800);
                $('.f-list .leftpart .p-operate .s-che,.fruit-kinds .good-list ul li .s-info .s-che,.qx-content .qx-cor .qx-cont .qx-info .cart').animate({backgroundPosition:"-517px -243px"},500);
            }
        )
    });

    function jiarugo( cpid, num ,cansu,jiahaoback,tdcaozuo){

        /* 加入购物车 */

        ANNIU = false;

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'gouwuche',d:'post',cpid:cpid,num:num,cansu:cansu,qx:1},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){
                //console.log(data);
                var zongjia = 0;
                html = '';
                html2 = '';
                html3 = '';
                mui.each(data.data.data, function( index, item ){
                    mui.each(item , function( dage, vvv ){
                        var cpid = vvv.cpid;
                        var canshu = vvv.canshu
                        var chash =  hex_md5( cpid+'_'+canshu  );
                        html += '<li id="c_normal_'+vvv.cpid+'" type="normal" pid="'+vvv.cpid+'" ppid="'+vvv.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"> <a href="'+vvv.link+'" target="_blank"> <img class="pull-left" src="'+vvv.tupian+'" alt=""> <div class="p-minicart-info"> <h5>'+vvv.name+'</h5> <h5>￥'+vvv.jiage+'/5斤</h5></div></a><div class="num_sel_lage p-mincart-modify"><span class="inC p-mincart-act btn-minus">-</span><input type="text" class="set-num-in" value="'+vvv.num+'" readonly="true" ><span class="deC p-mincart-act btn-plus" >+</span></div><span class="mini-cartlist-delete p-mincart-delete">删除</span></li>';
                        html2 += '<li id="c_normal_'+vvv.cpid+'" type="normal" pid="'+vvv.cpid+'" ppid="'+vvv.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"><div class="cartbox clearfix"><div class="cartorder-select pull-left clearfix"> <!--<p class="select selected"></p><input type="hidden" value="" />--></div><div class="cart-imgs pull-left"><a href="'+vvv.link+'" target="_blank"><img src="'+vvv.tupian+'" alt=""></a></div><div class="cart-name pull-left"><p><a href="/prodetail/index/16729" target="_blank">'+vvv.name+'</a></p></div><div class="spec-num pull-left"><p>'+vvv.beizhu+'</p></div><div class="price-singular pull-left"><p>￥'+vvv.jiage+'</p></div><div class="num_sel_lage cart-goods pull-left clearfix"><span class="inC num pull-left btn-minus">-</span><input class="pull-left" type="tel" disabled="" name="qty" autocomplete="on" value="'+vvv.num+'"><span class="deC num pull-left btn-plus">+</span></div><div class="sum pull-left"><p>￥'+vvv.yuanjia+'</p></div><div class="delete pull-left"><p class="m-cartlist-delete deleteCartpro">删除</p></div></div><div class="cl"></div></li>';
                        var zhongjia = parseFloat(vvv.num*vvv.jiage);
                        zongjia += parseFloat(zhongjia);
                        //console.log(zhongjia);
                        GOUCHE[dage] = vvv['num'];
                     });
                });
                var jiage = zongjia.toFixed(2);
                //console.log(jiage);
                html1 = '<div class="pull-left">共<span class="VI-color2">'+data.data.count+'</span>件商品</div><div class="pull-right">商品小计<span class="fs-3 VI-color2">'+jiage+'</span></div><button id="btncart" type="button" class="btn btn-success btn-lg btn-block">立即结算</button>';
                html3 = '<div class="cart-pay pull-right"><span>已选择<em>'+data.data.count+'件</em>商品  |  订单金额</span><span class="all-order">￥'+jiage+'</span><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'ding')?>" id="btngopay" class="go-pay">去结算</a></div><div class="cl"></div>';

                $("body").find(".cartnum").html(data.data.count);

                $("body").find(".html").html(html);

                $("body").find(".html3").html(html3);

                $("body").find(".html2").html(html2);


                $("body").find(".mcart-pay").html(html1);

           

            },error:function(xhr){

                ANNIU = true;
                dataerror(xhr , '购物车' );
            }
        });
    }


    /*
     * 删除购物车商品
     */
    function shanchugo( cpid ,cansu,jiahaoback,tdcaozuo){ 


        //ANNIU = false;
        /* 删除购物车 */
        mui.ajax( HTTP + 'json.php' ,{
            data:{y:'gouwuche',d:'delete',cpid:cpid,cansu:cansu},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){
                var zongjia = 0;
                html = '';
                html2 = '';

                mui.each(data.data.data, function( index, item ){
                    mui.each(item , function( dage, vvv ){
                        var cpid = vvv.cpid;
                        var canshu = vvv.canshu
                        var chash =  hex_md5( cpid+'_'+canshu  );
                        //alert(chash);
                        html += '<li id="c_normal_'+vvv.cpid+'" type="normal" pid="'+vvv.cpid+'" ppid="'+vvv.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"> <a href="'+vvv.link+'" target="_blank"> <img class="pull-left" src="'+vvv.tupian+'" alt=""> <div class="p-minicart-info"> <h5>'+vvv.name+'</h5> <h5>￥'+vvv.jiage+'/5斤</h5></div></a><div class="num_sel_lage p-mincart-modify"><span class="inC p-mincart-act btn-minus">-</span><input type="text" class="set-num-in" value="'+vvv.num+'" readonly="true" ><span class="deC p-mincart-act btn-plus" >+</span></div><span class="mini-cartlist-delete p-mincart-delete">删除</span></li>';
                        html2 += '<li id="c_normal_'+vvv.cpid+'" type="normal" pid="'+vvv.cpid+'" ppid="'+vvv.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"><div class="cartbox clearfix"><div class="cartorder-select pull-left clearfix"> <!--<p class="select selected"></p><input type="hidden" value="" />--></div><div class="cart-imgs pull-left"><a href="'+vvv.link+'" target="_blank"><img src="'+vvv.tupian+'" alt=""></a></div><div class="cart-name pull-left"><p><a href="/prodetail/index/16729" target="_blank">'+vvv.name+'</a></p></div><div class="spec-num pull-left"><p>'+vvv.beizhu+'</p></div><div class="price-singular pull-left"><p>￥'+vvv.jiage+'</p></div><div class="num_sel_lage cart-goods pull-left clearfix"><span class="inC num pull-left btn-minus">-</span><input class="pull-left" type="tel" disabled="" name="qty" autocomplete="on" value="'+vvv.num+'"><span class="deC num pull-left btn-plus">+</span></div><div class="sum pull-left"><p>￥'+vvv.yuanjia+'</p></div><div class="delete pull-left"><p class="m-cartlist-delete deleteCartpro">删除</p></div></div><div class="cl"></div></li>';
                        var zhongjia = parseFloat(vvv.num*vvv.jiage);
                        zongjia += parseFloat(zhongjia);
                        //console.log(zhongjia);
                        GOUCHE[dage] = vvv['num'];
                     });
                });
                var jiage = zongjia.toFixed(2);
                //console.log(jiage);
                html1 = '<div class="pull-left">共<span class="VI-color2">'+data.data.count+'</span>件商品</div><div class="pull-right">商品小计<span class="fs-3 VI-color2">'+jiage+'</span></div><button id="btncart" type="button" class="btn btn-success btn-lg btn-block">立即结算</button>';

                html3 = '<div class="cart-pay pull-right"><span>已选择<em>'+data.data.count+'件</em>商品  |  订单金额</span><span class="all-order">￥'+jiage+'</span><a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'ding')?>" id="btngopay" class="go-pay">去结算</a></div><div class="cl"></div>';

                $("body").find(".cartnum").html(data.data.count);

                $("body").find(".html").html(html);

                $("body").find(".html3").html(html3);

                $("body").find(".html2").html(html2);


                $("body").find(".mcart-pay").html(html1);

            },error:function(xhr){
                ANNIU = true;
                dataerror(xhr , '购物车' );
            }
        });
    }


    



    /*
     * 加入购物车 - 继续购物
     */
    function closeCart() {
        $('.shop-cart').fadeOut(800);
        $('.zhezhao').fadeOut(800);
        $('.f-list .leftpart .p-operate .s-che,.fruit-kinds .good-list ul li .s-info .s-che,.qx-content .qx-cor .qx-cont .qx-info .cart').animate({backgroundPosition: "-517px -243px"}, 500);
    }

    /*
     * 加入购物车
     */
    function addCart(pid,ppid,pno,type){
        var HTTP = '<?php echo WZHOST;?>'; 
        var cpid = pid;
        var t = $("#add");
        var num = t.val();
        //alert(num);
        //添加商品到购物车
        $.ajax({
            type: 'POST',
            url: HTTP + 'json.php',
            dataType: 'json',
            data: {
                y:'gouwuche',
                d:'post',
                cpid:cpid,//产品id
                num:num,//增加的数量
                cansu:'',//产品规格
            },
            success: function(rs) {
                if (rs.code == 1) {
                    $('.zhezhao').fadeIn(800);
                    $('.shop-cart').fadeIn(800);
                    var ds = rs.data;
                    var qs = rs.data.data;
                    var cartcount = ds.count;
                    var zongjia = 0;
                    var html = '';
                    $.each(qs,function(index, item){
                        $.each(item,function(x,y){
                            //console.log(y);
                            var cpid = y.cpid;
                            var canshu = y.canshu
                            var chash =  hex_md5( cpid+'_'+canshu  );
                            html += '<li id="c_normal_'+y.cpid+'" type="normal" pid="'+y.cpid+'" ppid="'+y.cpid+'" canshu="'+chash+'" data="cs'+cpid+'"> <a href="'+y.link+'" target="_blank"> <img class="pull-left" src="'+y.tupian+'" alt=""> <div class="p-minicart-info"> <h5>'+y.name+'</h5> <h5>￥'+y.jiage+'/5斤</h5></div></a><div class="num_sel_lage p-mincart-modify"><span class="inC p-mincart-act btn-minus">-</span><input type="text" class="set-num-in" value="'+y.num+'" readonly="true" ><span class="deC p-mincart-act btn-plus" >+</span></div><span class="mini-cartlist-delete p-mincart-delete">删除</span></li>';
                            var zhongjia = parseFloat(y.num*y.jiage);
                            //console.log(zhongjia);
                            zongjia+=parseFloat(zhongjia);
                        });
                    })
                    var cartprice = '￥'+zongjia.toFixed(2);
                    html1 = '<div class="pull-left">共<span class="VI-color2">'+cartcount+'</span>件商品</div><div class="pull-right">商品小计<span class="fs-3 VI-color2">'+cartprice+'</span></div><button id="btncart" type="button" class="btn btn-success btn-lg btn-block">立即结算</button>';
                    //console.log(zongjia);
                    $(".cartcount").html(cartcount);
                    $("body").find(".cartnum").html(cartcount);
                    $(".cartprice").html(cartprice);
                    $("body").find(".html").html(html);
                    $("body").find(".mcart-pay").html(html1);

                    //var url = '<?php echo WZHOST?>';
                    //$('.p-common-minicart').load(url);

                }else if(rs.code == -1){
                    layer.msg(rs.msg);
                }
            }
        });
    }
</script>
</body>
</html>