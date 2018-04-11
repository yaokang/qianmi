<?php if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT');
include QTPL.'head.php';
if( $DATA['tupianji'] != '' ) $PICT = unserialize( $DATA['tupianji'] ); 
if($DATA['canshu'] != '') $CANSHU = unserialize( $DATA['canshu'] ); 
else $CANSHU = array();
//p($DATA);
$D = db('type');
$name = $D->where(array('id'=>$DATA['cid']))->find();
//p($CANSHU);
?>
    <!-- 水果信息开始 -->
    <div class="content typepage clearfix">
        <div class="bread">
            <strong class="lvse"><a href="/">首页</a></strong>
            <span class="lvse">&gt;
                <a href=""><?php echo $name['name']?></a>&gt;
            </span>
            <span class="huise"><?php echo $DATA['name']?></span>
        </div>
        <!-- 焦点图开始 -->
        <div id="MyFocus" class="pull-left">
            <ul class="dianul">
            <?php foreach($PICT as $ong){?>
                <li class=" cur">
                    <img src="<?php echo pichttp($ong)?>"/>
                    <span>
                        <img src="<?php echo pichttp($ong)?>"/>
                    </span>
                </li>
            <?php }?>
                
            </ul>
            <ul class="tuul">
                <?php foreach($PICT as $ong){?>
                <li class=" cur">
                    <img src="<?php echo pichttp($ong)?>"/>
                    <span>
                        <img src="<?php echo pichttp($ong)?>"/>
                    </span>
                </li>
                <?php }?>
            </ul>
        </div>
        <script type="text/javascript">
            window.onload = function(){
                MyFocus(5000);
            }
        </script>
        <!-- 焦点图结束 -->
        <!-- 产品信息 -->
        <div class="product-info pull-left">
            <div class="country clearfix">

                <div class="name pull-left">
                    <h3><?php echo $DATA['name']?></h3>
                    <p class="title_describeapp">
                        <?php echo $DATA['miaoshu']?>                    
                    </p>
                </div>
            </div>
            <div class="price-info">
                <div class="price01 clearfix">
                    <div class="box pull-left">
                        <h5 class="pull-left">果园价</h5>
                        <span class="pull-left price-sp" id="jq-price">￥<?php echo $DATA['jiage']?></span>
                        <span class="pull-left">
                            <s id="jq-old-price">￥<?php echo $DATA['yuanjia']?></s>
                        </span>
                    </div>
                </div>
                <?php if($CANSHU != array()){?>
                <div class="guige clearfix">
                    <h5 class="pull-left">规格</h5>
                    <div class="zhuang pull-left">
                        <span data-old-price="138.00" data-price="128.00" data-pid="15865" data-ppid="19090" data-product_no="2161114115" data-outofstock="0" class="pull-left current"><?php echo $DATA['beizhu']?></span>
                    </div>
                </div>
                <input type="hidden" id="send_to" name="send_to" value="106092" />
                <?php }?>

                <div class="number clearfix">
                    <h5 class="pull-left">数量</h5>
                    <div class="goods-buy01 pull-left clearfix">
                        <span id="redu" class="num pull-left">-</span>
                        <input class="pull-left shuliang" id="add" type="tel" value="1">
                        <span id="add1" class="num pull-left">+</span>
                    </div>
                </div>
                <div class="buy clearfix">
                    <div class="fr-buy pull-left">
                        <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart');?>" class="btn btn-primary btn-lg active " role="button" title="点击此按钮，到下一步确认购买信息">立即购买</a>
                    </div>
                    <div class="fr-add pull-left">
                        <a href="javascript:;" class="btn btn-primary btn-lg active html1" title="加入购物车" role="button" pid="<?php echo $DATA['id']?>">
                            加入购物车
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- 产品信息结束 -->
        <div class="cl h68"></div>
        <!--  评论开始-->
        <input type="hidden" id="product_id" value="15865">
        <input type="hidden" id="comment_curr_page" value="0">
        <input type="hidden" id="comment_curr_type" value="">
        <input type="hidden" id="comment_curr_total" value="0">
        <div class="assess clearfix">
            <div class="leftpart pull-left">
                <div class="good-details js_fixed clearfix"  id="js_fixed">
                    <span class="cur pull-left" draggable="true">商品简介</span>
                    <span class="pull-left">
                        顾客评论 <b id="comment_total_top">(0)</b>
                    </span>
                    <a href="javascript:;" class="pull-right btn btn-primary btn-lg active queren" title="加入购物车" role="button">
                        加入购物车 <i class="tb-iconfont pull-left"></i>
                        <div class="thefruit clearfix haha">
                            <div class="fruitleft pull-left">
                                <img src="<?php echo pichttp($DATA['tupian'])?>"/>
                            </div>
                            <div class="fruitright pull-left">
                                <h5><?php echo $DATA['name']?></h5>
                                <p>￥<?php echo $DATA['jiage']?> / 2斤</p>
                                <p class="frnum"></p>
                                <div class="anniu html1" pid="<?php echo $DATA['id']?>">
                                    确认
                                </div>
                            </div>
                        </div>
                    </a>
                                    </div>
                <div class="good-comments">
                    <ul class="no1" style="display: block;">
                        <?php echo $DATA['neirong']?>
                    </ul>
                    <ul class="no2" style="display: none;">
                        <div class="detail-title clearfix">
                            <div class="detail-title00 pull-left">
                                <p class="p1" id="grade_good_another_left">0%</p>
                                <p class="p2 mar-8">好评度</p>
                            </div>
                            <div class="detail-title01 pull-left">
                                <div class="pl-user clearfix">
                                    <div class="green-user pull-left">不错哟</div>
                                    <div class="dengji-good pull-left">
                                        <div id="grade_good_another" style="width: 0%;"></div>
                                    </div>
                                    <div class="dengji-number pull-left" id="good_rate_another">0%</div>
                                </div>
                                <div class="pl-user clearfix">
                                    <div class="green-user pull-left">待提高</div>
                                    <div class="dengji-good pull-left">
                                        <div id="grade_normal_another" style="width: 0%;"></div>
                                    </div>
                                    <div class="dengji-number pull-left" id="normal_rate_another">0%</div>
                                </div>
                                <div class="pl-user clearfix">
                                    <div class="green-user pull-left">小失落</div>
                                    <div class="dengji-good pull-left">
                                        <div id="grade_bad_another" style="width: 0%;"></div>
                                    </div>
                                    <div class="dengji-number pull-left" id="bad_rate_another">0%</div>
                                </div>
                            </div>
                            <div class="detail-title02 pull-left clearfix">
                                <p class="">发布评价即可获10积分，</p>
                                <p class="w-375">APP上传图片并晒单即可获得20积分，前5名可获双倍积分。</p>

                            </div>
                        </div>
                        <div class="detail-user">
                            <div class="modal fade bs-appraise-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-md">
                                      <div class="modal-content appraise-img-dialog">
                                        <img src="">
                                      </div>
                                </div>
                            </div>
                            <div class="detail-user-title  clearfix">
                                <ul>
                                    <li  val="" id="c_all_another" class="now-gray pull-left">
                                        <s class="fpicon"></s>
                                        全部评论(
                                        <span id="comment_total">0</span>
                                        )
                                    </li>
                                    <li val="good" id="c_good_another" class="pull-left">
                                        <s class="fpicon"></s>
                                        不错呦(
                                        <span id="comment_total_good">0</span>
                                        )
                                    </li>
                                    <li val="normal" id="c_normal_another" class="pull-left">
                                        <s class="fpicon"></s>
                                        待提高(
                                        <span id="comment_total_normal">0</span>
                                        )
                                    </li>
                                    <li val="bad" id="c_bad_another" class="pull-left">
                                        <s class="fpicon"></s>
                                        小失落(
                                        <span id="comment_total_bad">0</span>
                                        )
                                    </li>
                                                                    </ul>
                            </div>
                            <div class="detail-allsays" id="comment_box">
                                <div class="nocomm">正在加载 ......</div>
                            </div>
                            <div class="btn-toolbar" role="toolbar" >
                                <div class="main" id="comment_box_page">
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>

</div>

        <script>
            $(function(){
                $(".queren").click(function(){
                    $(".haha").toggle();
                });
            });


            $(function(){

                $('body').find(".html1").click(function(){

                                var pid = $(this).attr('pid');
                                var ppid = $(this).attr('ppid');
                                var pno = $(this).attr('pno');
                                var type = $(this).attr('type');

                                addCart(pid,ppid,pno,type);


                });


                $('.shop-cart .shop-top .cha').click(
                    function(){
                        $('.shop-cart').fadeOut(800);
                        $('.zhezhao').fadeOut(800);
                        $('.f-list .leftpart .p-operate .s-che,.fruit-kinds .good-list ul li .s-info .s-che,.qx-content .qx-cor .qx-cont .qx-info .cart').animate({backgroundPosition:"-517px -243px"},500);
                    }
                )
            });

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
            function addCart(pid,ppid,pno,type)
            {
                var HTTP = '<?php echo WZHOST;?>'; 
                var cpid = pid;
                var t = $("#add");
                var num = t.val();
                alert(num);
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
                                    html += '<li id="c_normal_18669" type="normal" pid="15473" ppid="18669"> <a href="/prodetail/index/15473" target="_blank"> <img class="pull-left" src="'+y.tupian+'" alt=""> <div class="p-minicart-info"> <h5>'+y.name+'</h5> <h5>￥'+y.jiage+'/5斤</h5></div></a><div class="num_sel_lage p-mincart-modify"><span class="inC p-mincart-act btn-minus">-</span><input type="text" class="set-num-in" value="'+y.num+'" readonly="true" ><span class="deC p-mincart-act btn-plus" >+</span></div><span class="mini-cartlist-delete p-mincart-delete">删除</span></li>';
                                    var zhongjia = parseFloat(y.num*y.jiage);
                                    //console.log(zhongjia);
                                    zongjia+=parseFloat(zhongjia);
                                });
                            })
                            //console.log(zongjia);
                            var cartprice = '￥'+zongjia.toFixed(2);
                            $(".cartcount").html(cartcount);
                            $("body").find(".cartnum").html(cartcount);
                            $(".cartprice").html(cartprice);
                            $("body").find(".html").html(html);

                            //var url = '<?php echo WZHOST?>';
                            //$('.p-common-minicart').load(url);

                        }else if(rs.code == -1){
                            layer.msg(rs.msg);
                        }
                    }
                });
            }

            function getCommentRate() {
                $.ajax({
                    type: 'POST',
                    url: '/ajax/comment/pRate',
                    dataType: 'json',
                    data: {
                        id: $("#product_id").val()
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            $("#comment_total_top").text('(' + data.msg.num.total + ')');
                            $("#grade_good_another_left").text(data.msg.good + '%');
                            $("#grade_good_another").animate({width: data.msg.good + '%'}, 1000);
                            $("#good_rate_another").text(data.msg.good + '%');
                            $("#grade_normal_another").animate({width: data.msg.normal + '%'}, 1000);
                            $("#normal_rate_another").text(data.msg.normal + '%');
                            $("#grade_bad_another").animate({width: data.msg.bad + '%'}, 1000);
                            $("#bad_rate_another").text(data.msg.bad + '%');
                            $("#comment_total").text(data.msg.num.total);
                            $("#comment_total_good").text(data.msg.num.good);
                            $("#comment_total_normal").text(data.msg.num.normal);
                            $("#comment_total_bad").text(data.msg.num.bad);

                            getComment('', 0, data.msg.num.total);
                        }
                    }
                });
            }
            // get comment list and pagination
            function getComment(type, page, total) {
//                console.log(arguments);
                $.ajax({
                    type: 'POST',
                    url: '/ajax/comment/pList',
                    dataType: 'json',
                    data: {
                        id: $("#product_id").val(),
                        curr_page: page,
                        type: type
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            var list = data.msg.list;
                            var commentHtml;
                            if (!list.length) {
                                commentHtml = '<div class="nocomm">暂时还没有评论</div>';
                            } else {
                                commentHtml =  '<div class="detail-allsays01">'
                                $.each(list, function(k, v) {
                                    commentHtml +=      '<div class="detail-user-says clearfix">';
                                    commentHtml +=          '<div class="detail-user-says-left pull-left">';
                                    commentHtml +=              '<img class="img-circle" src="' + v.userface + '">';
                                    commentHtml +=              '<p>' + v.user_name + '</p>';
                                    commentHtml +=          '</div>';
                                    commentHtml +=          '<div class="detail-user-says-right pull-right">';
                                    commentHtml +=              '<ul>';
                                    commentHtml +=                  '<li class="clearfix">';
                                    commentHtml +=                      '<p class="num pull-left">评分</p>';
                                    commentHtml +=                      '<p class="start pull-left user-ping">';
                                    commentHtml +=                          new Array(parseInt(v.star)+1).join('<span class="star"></span>');
                                    commentHtml +=                      '</p>';
                                    commentHtml +=                  '</li>';
                                    commentHtml +=                  '<li class="clearfix">';
                                    commentHtml +=                      '<p class="cont pull-left">内容</p>';
                                    commentHtml +=                      '<p class="pull-left user-ping">' + v.content.replace("\\n", "<br />", "g") + '</p>';
                                    commentHtml +=                  '</li>';
                                    if (v.thumbs) {
                                        var commentImage = v.thumbs.split(',');
                                    commentHtml +=                  '<li data-toggle="modal" data-target="#myModal">';
                                    commentHtml +=                      '<p class="cont pull-left">晒图</p>';
                                        $.each(commentImage, function(key, img) {
                                    commentHtml +=                      '<img src="' + img + '"/>';
                                        });
                                    commentHtml +=                  '</li>';
                                    }
                                    commentHtml +=                  '<li>';
                                    commentHtml +=                      '<span class="gray">' + v.time + '</span>';
                                    commentHtml +=                  '</li>';
                                    commentHtml +=                  '<li class="clearfix">';
                                    if(v.customer_repaly != undefined)
                                    {
                                        if(v.customer_repaly[0] != null && v.customer_repaly[0].id >0)
                                        {
                                            commentHtml +=                      '<p class="cont pull-left" style="color:#64a131">回复</p>';
                                            commentHtml +=                      '<p class="pull-left user-ping" style="color:#64a131">' + v.customer_repaly[0].content+ '</p>';
                                            commentHtml +=                  '</li>';
                                            commentHtml +=                  '<li>';
                                            commentHtml +=                      '<span class="gray" style="color:#64a131">' + v.customer_repaly[0].time + '</span>';
                                            commentHtml +=                  '</li>';
                                        }
                                    }
                                    commentHtml +=              '<ul>';
                                    commentHtml +=          '</div>';
                                    commentHtml +=      '</div>';
                                });
                                commentHtml +=      '</div>';

                            }
                            $("#comment_box").html(commentHtml);

                            $("#comment_curr_type").val(type);
                            $("#comment_curr_page").val(page);
                            $("#comment_curr_total").val(total);

                            getCommentPage(parseInt(total), page);
                        }
                    }
                });
            }
            function getCommentPage(total, current){
                if (total == 0) {
                    $("#comment_box_page").html('').hide();
                    return false;
                }

                var pageSize = 10;
                var pages = Math.ceil(total/pageSize) - 1;
                if (pages > 0) {
                    var start = current - 2 >= 0 ? current - 2 : 0;
                    var end = current + 2 <= pages ? current + 2 : pages;

                    var commentPageHtml = '';
                    if (total > pageSize) {
                        commentPageHtml =   '<a href="javascript:;" class="jq-first"> < 首页</a>';
                        commentPageHtml +=  '<div class="last">';
                        commentPageHtml +=      '<a href="javascript:;">上一页</a>';
                        commentPageHtml +=  '</div>';
                    }
                    commentPageHtml +=      '<div class="pagenum">';
                    for (var i=start; i<=end; i++) {
                        var curr = i == current ? 'cur' : '';
                    commentPageHtml +=          '<a href="javascript:;" class="' + curr + '">' + (i+1) + '</a>';
                    }
                    commentPageHtml +=      '</div>';
                    if (total > pageSize) {
                        commentPageHtml +=  '<div class="next">';
                        commentPageHtml +=      '<a href="javascript:;">下一页</a>';
                        commentPageHtml +=  '</div>';
                        commentPageHtml +=  '<a href="javascript:;" class="jq-last"> 最后一页 > </a>';
                    }

                    $("#comment_box_page").html(commentPageHtml).show();

                    // bind page event
                    var currentType = $("#comment_curr_type").val();
                    var currentPage = parseInt($("#comment_curr_page").val());
                    var currentTotal = parseInt($("#comment_curr_total").val());

                    $("#comment_box_page .jq-first").on('click', function() {
                        getComment(currentType, 0, currentTotal);
                    });
                    $("#comment_box_page > .last > a").on('click', function() {
                        var page = currentPage-1 >= 0 ? currentPage-1 : 0;
                        getComment(currentType, page, currentTotal);
                    });
                    $("#comment_box_page > .next > a").on('click', function() {
                        var page = currentPage+1 <= pages ? currentPage+1 : pages;
                        getComment(currentType, page, currentTotal);
                    });
                    $("#comment_box_page > .pagenum > a").on('click', function() {
                        getComment(currentType, $(this).text()-1, currentTotal);
                    });
                    $("#comment_box_page .jq-last").on('click', function() {
                        getComment(currentType, pages, currentTotal);
                    });
                } else {
                    $("#comment_box_page").html('').hide();
                }
            }

            function getList(page) {
                $.ajax({
                    type: 'POST',
                    url: '/ajax/foretaste/getComment',
                    dataType: 'json',
                    data: {
                        fgid: $("#foretaste-comment").data('fgid'),
                        page: page
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            var list = data.msg.data;
                            var listHtml = '', pageHtml = '';
                            if (!list.length) {
                                listHtml = '<div class="nocomm">暂时还没有评论</div>';
                                $("#comment_box").html(listHtml);
                            } else {
                                // list
                                listHtml =  '<div class="detail-allsays01">'
                                $.each(list, function(k, v) {
                                    listHtml +=      '<div class="detail-user-says clearfix">';
                                    listHtml +=          '<div class="detail-user-says-left pull-left">';
                                    listHtml +=              '<img class="img-circle" src="' + (v.userinfo ? v.userinfo.userface : '') + '">';
                                    listHtml +=              '<p>' + (v.userinfo ? v.userinfo.username : '') + '</p>';
                                    listHtml +=          '</div>';
                                    listHtml +=          '<div class="detail-user-says-right pull-right">';
                                    listHtml +=              '<ul>';
                                    listHtml +=                  '<li class="clearfix">';
                                    listHtml +=                      '<p class="num pull-left">评分</p>';
                                    listHtml +=                      '<p class="start pull-left user-ping">';
                                    listHtml +=                          new Array(parseInt(v.rank)+1).join('<span class="star"></span>');
                                    listHtml +=                      '</p>';
                                    listHtml +=                  '</li>';
                                    listHtml +=                  '<li class="clearfix">';
                                    listHtml +=                      '<p class="cont pull-left">内容</p>';
                                    listHtml +=                      '<p class="pull-left user-ping">' + v.content.replace("\\n", "<br />", "g") + '</p>';
                                    listHtml +=                  '</li>';
                                    if (v.pic_urls.length) {
                                    listHtml +=                  '<li data-target="#myModal" data-toggle="modal">';
                                    listHtml +=                      '<p class="cont pull-left">晒图</p>';
                                        $.each(v.pic_urls, function(key, img) {
                                    listHtml +=                      '<img src="' + img + '"/>';
                                        });
                                    listHtml +=                  '</li>';
                                    }
                                    listHtml +=                  '<li>';
                                    listHtml +=                      '<span class="gray">' + v.createtime + '</span>';
                                    listHtml +=                  '</li>';
                                    listHtml +=              '<ul>';
                                    listHtml +=          '</div>';
                                    listHtml +=      '</div>';
                                });
                                listHtml +=      '</div>';
                                $("#comment_box").html(listHtml);

                                // pagep
                                var total = data.msg.totalResult;
                                var pageSize = 10;
                                pageHtml = getPage(total, page, pageSize);
                                console.log(pageHtml);
                                $("#comment_box_page").html(pageHtml).show();
                                if (!pageHtml) $("#comment_box_page").hide();
                                bindPageEvent(page, Math.ceil(total/pageSize));
                            }
                        }
                    }
                });
            }
            function getPage(total, current, pageSize) {
                var pages = Math.ceil(total/pageSize);
                var pageHtml = '';

                if (pages > 1) {
                    var start = current - 2 >= 1 ? current - 2 : 1;
                    var end = current + 2 <= pages ? current + 2 : pages;


                    if (total > pageSize) {
                        pageHtml +=     '<a href="javascript:;" class="jq-first"> < 首页 </a>';
                        pageHtml +=     '<div class="last">';
                        pageHtml +=         '<a href="javascript:;">上一页</a>';
                        pageHtml +=     '</div>';
                    }
                    pageHtml +=         '<div class="pagenum">';
                    for (var i=start; i<=end; i++) {
                        var curr = i == current ? 'cur' : '';
                    pageHtml +=             '<a href="javascript:;" class="'+ curr + '">' + i + '</a>';
                    }
                    pageHtml +=         '</div>';
                    if (total > pageSize) {
                        pageHtml +=     '<div class="next">';
                        pageHtml +=         '<a href="javascript:;">下一页</a>';
                        pageHtml +=     '</div>';
                        pageHtml +=     '<a href="javascript:;" class="jq-last"> 最后一页 > </a>';
                    }
                } else {
                    pageHtml = '';
                }

                return pageHtml;
            }
            function bindPageEvent(currentPage, pages) {
                $("#comment_box_page .jq-first").on('click', function() {
                    getList(1);
                });
                $("#comment_box_page > .last > a").on('click', function() {
                    var page = currentPage-1 >= 1 ? currentPage-1 : 1;
                    getList(page);
                });
                $("#comment_box_page > .next > a").on('click', function() {
                    var page = currentPage+1 <= pages ? currentPage+1 : pages;
                    getList(page);
                });
                $("#comment_box_page > .pagenum > a").on('click', function() {
                    getList(parseInt($(this).text()));
                });
                $("#comment_box_page > .jq-last").on('click', function() {
                    getList(pages);
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

            // 大选项卡----
            $(function() {
                $(".assess .good-details span").click(
                    function(){
                        $(this).addClass("cur").siblings().removeClass("cur").parent().siblings().children("ul").eq($(this).index()).show().siblings().hide();
                    }
                );
                //小选项卡
                $(".detail-user .detail-user-title ul li").click(
                    function(){
                        $(this).addClass("now-gray").siblings().removeClass("now-gray").parent().parent().siblings().children().eq($(this).index()).show().siblings().hide();
                });
                $('.Tastepart').delegate('.detail-user-says-right ul li img', 'click', function(e){ 
                  var url=$(this).attr('src');
                $('.bs-appraise-modal-sm').modal('show')    
                    .find('.appraise-img-dialog>img').attr({'src': url});
                $('.bs-appraise-modal-sm').on('click', function(){
                    $(this).modal('hide')
                })      
             });
            //置顶
             var gao=$("#js_fixed").offset().top; 
            $(window).scroll(function(event){
                var val=$(document).scrollTop();
                if(val>=gao)
                { 
                    $("#js_fixed").css({"position":"fixed", "top":"0"});
                    $("#js_fixed").fadeIn(300);
                }
                else
                {
                    $("#js_fixed").css({"position":"static"});
                }
        });
            //遮罩
                $('.detail-user').delegate('.detail-allsays .detail-allsays01 .detail-user-says .detail-user-says-right li img', 'click', function(e){ 
                var url=$(this).attr('src');
                $('.bs-appraise-modal-sm').modal('show').find('.appraise-img-dialog>img').attr({'src': url});
                $('.bs-appraise-modal-sm').on('click', function(){
                    $(this).modal('hide')
                });      
            })

})
        </script>
        <!-- 评论结束 -->
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
                            <a href="javascript:void(0);" onclick="closeCart();" class="btn btn-primary btn-lg active" role="button" title="点击此按钮，到下一步确认购买信息">继续购物</a>
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




<?php include QTPL.'foot.php';?>