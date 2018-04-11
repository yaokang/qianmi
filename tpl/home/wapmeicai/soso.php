<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
$DATA['cid'] = $DATA['id'] =  $LANG['cpid'];

$PAGE= (int)isset($HTTP['2'])?$HTTP['2']:1;
$DATA['name'] = '搜索-'.$HTTP['1'];


?>
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
           console.log(url);
           return false;
           if(url.value== "") alert('请填写关键字');
           else  window.location.href="<?php echo mourl($CONN['sosoword'],'',$CONN['fenge']);?>"+url.value+"<?php echo $CONN['houzui'];?>";
           return false;
        }
    </script>
    <style>
        body{font-size:14px;}
        .main-nav,.sub-nav{list-style: none;padding:0px;margin:0px;font-size:14px;}

        .main-nav li{
                background-color: #f5f5f5;
                line-height: 48px;
                color: #666;
                border-bottom: 1px solid #ebebeb;
                border-left:none;
                text-align:center;
                overflow:hidden;
        }

        .sub-nav{display:none;background:#fff;}

        .main-nav .active .sub-nav{display:block;}

        .sub-nav .active{}

        .main-nav li.active{background:#fff;}

        .main-nav li.active span.btt{  color: #0bbe06;font-weight: 700;}

        .sub-nav li.active { background-color: #0bbe06; color:#fff;}
         .sub-nav li{background:#fff;}
        .mui-table-view-cell:after{left:0px;}

        img.mui-media-object{    border-radius: 2px; border: 1px solid #ebebeb; }


        .mui-btn-success{float:right;   font-size: 12px;background-color: #fff;border: 1px solid #0bbe06; color: #0bbe06;width: 50px; padding: 4px;}
        
        .xzguige{margin-top:10px;display:none;}

        .btxzkan{ width:95px;position:relative;float:right;top:10px;}
        .btxzkan *{text-align:center;height:35px;border-radius: 100%;line-height:35px;padding:0px;margin:0px;position:absolute;font-size: 12px;border-color:#ebebeb;}

        .btjianhao{display:none;/* - */ width:30px;left:0px;z-index:1;color:#0bbe06;font-weight:bold;}
        input.btshuru{ display:none;/* 输入框 */width:65px;left:15px;height:35px;border-width:1px 0px;padding:0px;margin:0px;border-color:#ebebeb;}
        .btjiahao {/* + */width:35px;left:60px;z-index:1;color:#0bbe06;font-weight:bold;}


        .xuanzeguig{border-top:1px solid #ebebeb;padding:1px 0;}
        .xuanzeguig label{width:138px;color:#999;height:60px;}

        .xuanzeguig label b{color:#ff7400;font-size:18px;display:block;line-height:30px;}

        .anniu{height:35px;line-height:35px;}
        .shuruke{ border:1px solid #eee;height:35px;line-height:35px;border-radius:30px; }
    </style>
</head>
<body>

        <nav class="mui-bar mui-bar-tab" id="navfoot" >
            <a class="mui-tab-item2 " href="<?php echo WZHOST;?>">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
                <span class="mui-tab-label" >首页</span>
            </a>

            <?php $danye = danye( $LANG['cpid'] );?>
            <a class="mui-tab-item2 mui-active" href="<?php echo $danye['link'];?>" >
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

        <header id="header" class="mui-bar mui-bar-nav">

            <form method="get" onsubmit="return sousuo();">

                <span class="mui-icon mui-icon-chat" style="color:#0bbe06"></span>
                <div class="mui-input-row mui-search mui-pull-left" style="width:90%;float:right;margin-top:2px;">
                    <input type="search" class="mui-input-clear"  id="URLs" placeholder="输入菜名搜索" style="background:#fff;">
                </div>
            </form>

        </header>

        

      

        

<script id="demo" type="text/html">


{{# mui.each(d, function(index, item){  }}

<li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;" id="chanpid{{ item.id }}">
        
        <img class="mui-media-object mui-pull-left" src="{{ item.tupian }}" style="max-width:60px;width:60px;height:60px;">
        <div class="mui-media-body">

            <span class="mui-pull-left" style="width:80%;">{{ item.name }}</span>

            <button class="mui-btn-danger mui-btn-outlined mui-pull-right" style="width: 50px; padding: 4px;font-size:12px;" onclick="window.location.href='{{ item.link }}'" > 详情 </button>

            <p class="mui-ellipsis mui-pull-left" style="margin-top:20px;width:100%;">
                <span class="list-col-orange" style="color: #ff7400;">{{ item.huobi +item.jiage }}</span> 
                <button class="mui-btn-success guigexuan mui-pull-right" data="{{ item.id }}"> 选规格 </button>
            </p>

        </div>


        {{# if(item.guige){ }}
        
        <div class="xzguige" style="clear:both;">

            
            {{# mui.each(item.guige , function(indexx, item2){ var num = 0; if( GOUCHE[item2.chash] ){   num = GOUCHE[item2.chash]; }  }}
            <div class="mui-input-row xuanzeguig" id="cs{{ item.id }}_{{ indexx }}">

                <label>
                
                
               <b >{{ item.huobi + item2.jiage }}</b> {{= woqu(item2.name ) }}
               
                
                </label>
                <div class="btxzkan">
                    <button class="btjianhao" {{= (num > 0 ?" style=display:block;":'')}} type="button" data="cs{{ item.id }}_{{ indexx }}">一</button>
                    <input  class="btshuru"   {{= (num > 0 ?" style=display:block;":'')}} type="number" value="{{=num}}" readonly="readonly" chash="{{ item2.chash }}" chashz="z{{ item2.chash }}" cpid ="{{ item.id }}" canshu="{{ item2.name }}" data="cs{{ item.id }}_{{ indexx }}">
                    <button class="btjiahao" type="button" data="cs{{ item.id }}_{{ indexx }}">十</button>
                </div>

            </div>

            {{# }); }}



        </div>

        {{# } }}

    </li>


{{# }); }}


    
</script>

        
    <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-12" style="float:right;right:1px;left:auto;bottom:58px;overflow:hidden;width:100%;border-left: 1px solid #ebebeb;">

        <div class="mui-scroll">
            <ul class="mui-table-view" id="view">

            </ul>
        </div>

    </div>



     


    <div id="picture" class="mui-popover mui-popover-action mui-popover-bottom">
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;margin:0px;">

            <li class="mui-table-view-cell mui-media mui-col-xs-4"  >
                <div class="anniu" > 购买数量</div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                <div class="anniu" ><input type="text" placeholder="普通输入框" class="shurukuang" readonly="readonly"  value="6" style="height:35px;line-height:35px;border-radius:30px;"> </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                <div class="anniu" > <div class="mui-btn mui-btn-primary" onclick="anqingchu();">清除</div> </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="1"> 1 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="2"> 2 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="3"> 3 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="4"> 4 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="5"> 5 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="6"> 6 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="7"> 7 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke" data="8"> 8 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu shuruke"  data="9"> 9 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4">
                <div class="anniu" > <a href="#picture" class="mui-btn mui-btn-primary">取消</a> </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                <div class="anniu shuruke" data="0"> 0 </div>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                <div class="anniu" > <div class="mui-btn mui-btn-primary" onclick="queren();">确认</div> </div>
           </li>

        </ul>
    </div>

</body>
</html>
<?php include QTPL.'foot.php';?>
<script type="text/javascript">
    var PAGE   = 0;
    var CPID   = 'SOSO_<?php echo $HTTP['1'];?>';
    var xuanzhi= '';
    var WCHE = false;

    function woqu( name ){

        if( name == '') return '';
        return name.replace(/_/g,' ');
    }


    function gengxinx(){

        for(var i in GOUCHE){


              

                if( $("[chashz=z"+i+"]").length > 0){
                    data = $("[chashz=z"+i+"]").attr('data');
                    $("#"+data).find('.btshuru').val(GOUCHE[i]);
                    $("#"+data).find('.btjianhao').show();
                    $("#"+data).find('.btshuru').show();
                }

        }


    }


    function duqushuju(LAAA){

        mui.ajax( HTTP + 'json.php' ,{

            data:{ y:'cplist',d:'get',cpid:CPID,page:PAGE },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                if( data.token && data.token != '') TOKEN = data.token;

                if( data.code == 1 ){

                    WCHE = false;

                    DATA = data.data;

                    var gettpl = document.getElementById('demo').innerHTML;

                    laytpl(gettpl).render(DATA, function(html){

                        if(PAGE < 2)
                             $("#view").html( html );
                        else  $("#view").append(html);
                    });

                }else{ 

                    WCHE =true;
                    if( PAGE < 2 ){
                         $("#view").html( '<div class="mui-card"><div class="mui-card-content"><div class="mui-card-content-inner" style="text-align:center;color:red;height:160px;line-height:110px;font-size:20px;"> 没有数据 </div></div></div>');
                    }
                }


                 if( LAAA == 1 ){

                    if( WCHE ){
                        /* 结束下拉 */

                        mui('#pullrefresh').pullRefresh().endPullupToRefresh(true);
                    
                    
                    }else mui('#pullrefresh').pullRefresh().endPullupToRefresh();

                }else{

                    mui('#pullrefresh').pullRefresh().endPulldownToRefresh();

                }

            },error:function(xhr){
                    dataerror(xhr , '读取列表' );
                }
        });
    }


    function chushidata( data ){

        CPID = data;

         mui('#pullrefresh').pullRefresh().refresh(true);
        mui('#pullrefresh').pullRefresh().endPullupToRefresh(false);
        mui('#pullrefresh').pullRefresh().scrollTo(0,0,100);
       


        PAGE   = 1;


        duqushuju(2);
    }


    function anqingchu(){

        $(".shurukuang").val('0');
    }


    function jiahaoback( data,zhis,DATRA ){

        ANNIU = true;

        
        $("#"+data).find('.btshuru').val(zhis);
        $("#"+data).find('.btjianhao').show();
        $("#"+data).find('.btshuru').show();

        xweizhi =  Math.floor(Math.random()*20+1);
        yweizhi = Math.floor(Math.random()*50+1);



        var top  = $("#"+data).find('.btshuru').offset().top +xweizhi;
        var left = $("#"+data).find('.btshuru').offset().left +yweizhi;


        var suij = Math.round(Math.random()*100+1);
        $("body").append('<span  class="woquyss'+suij+' mui-icon mui-icon-mczdan" style="z-index:999999;position:absolute;color:#0bbe06;font-size:28px;top:'+top+'px;left:'+left+'px;display:block;width:30px;height:30px;border-radius: 100%;"></span>');
            
        var mbtop  = $(".mui-icon-mcgwc").offset().top-10;
        var mbleft = $(".mui-icon-mcgwc").offset().left+20;

        suiji = (mbtop - top) * Math.floor(Math.random()*5+2);

       // suiji = Math.floor(Math.random()*szi+100);

        $(".woquyss"+suij).animate({ width: "0px", height: "0px", top:mbtop, left:mbleft,opacity:0.1 }, suiji  ,function(){
        
         setgwnum( DATRA );
        $(".woquyss"+suij).remove();

        });




        
    
    }
    
    function shanchuok(data,zhis,DATRA){

        ANNIU = true;
        
        $("#"+data).find('.btshuru').val(0);
        $("#"+data).find('.btjianhao').hide();
        $("#"+data).find('.btshuru').hide();

        setgwnum( DATRA );
    
    
    
    }


    function queren(){

        shuliang = $(".shurukuang").val() * 1 ;

        if( shuliang < 1 ){

                tcpid =  $("#"+ xuanzhi ).find('.btshuru').attr('cpid');
                chash = $("#"+ data ).find('.btshuru').attr('chash');
                shanchugo( tcpid ,chash ,shanchuok ,xuanzhi);
                mui('#picture').popover('toggle');

        }else {

            tcpid =  $("#"+ xuanzhi ).find('.btshuru').attr('cpid');
            canshu = $("#"+ xuanzhi ).find('.btshuru').attr('canshu');

            jiarugo( tcpid , shuliang , canshu , jiahaoback ,xuanzhi );

        
            mui('#picture').popover('toggle');
        } 
    }


    mui.init({

        pullRefresh: {
            container: '#pullrefresh',
            down: {
                callback: pulldownRefresh
            },
            up: {
                contentrefresh: '正在加载...',
                callback: pullupRefresh
            }
        }

    });


    function pulldownRefresh() {

        setTimeout(function() {

            PAGE = 0;
            chushidata( CPID );
            
        }, 500);

    }


    function pullupRefresh() {

        setTimeout(function() {

           
            PAGE++;
            duqushuju(1);

        }, 500);
    }

    if (mui.os.plus) {
        mui.plusReady(function() {

            mui('#pullrefresh').pullRefresh().pullupLoading();

        });
    } else {
        mui.ready(function() {
            mui('#pullrefresh').pullRefresh().pullupLoading();
        });
    }
     

    mui.ready(function() {

        thd     = $(window).height();
        gaode   = $("#navfoot").css('height').replace('px','') ;
        jisugoa = thd - gaode;

        $("#jstyperl").css({ height : jisugoa + "px"});


        $( ".sub-nav li" ).click( function(){

            var cid = $(this).attr('data');
           
            $(".sub-nav li" ).removeClass( "active" );
            $(this).addClass( 'active' );
             PAGE = 0;
            chushidata( cid );

        });


        $(".main-nav li.dalei").click(function(){
        
            $(".main-nav li.dalei").removeClass('active');
            $(this).addClass('active');

            tzhi  = true;

            $(this).find(".sub-nav li").each( function(){

                if( $(this).hasClass('active') && tzhi ) tzhi = false;

            });

            if( tzhi ){ 

                $(".sub-nav li" ).removeClass( "active" );
                $(this).find(".sub-nav li").first().addClass('active');
                var cid = $(this).attr('data');
                PAGE = 0;
                chushidata( cid );
            }

        });

        mui("#picture").on('tap','.shuruke',function(){
    
            data = $( this ).attr('data') * 1;

            if(! isNaN( data ) ){

                zhi = $(".shurukuang").val();
                if( zhi == '0' ) zhi = '';
                $(".shurukuang").val(zhi+data);
            }
            $(this).css({"background":"#007aff",'color':'#fff'});

            $DDDg = $(this);

            $(this).animate({  }, 100,function(){
            
            
             $DDDg.css({"background": "#fff", color: "#797979"});

            
            });


        });
        
    
            

        mui("#view").on('tap','.btjiahao',function(){

            if( ! ANNIU ) return false;

            /* 加号 */
            data = $( this ).attr('data');
            zhis = $("#"+ data ).find('.btshuru').val() * 1;
            if(zhis < 1) $("#"+data).find('.btshuru').val(1);
            zhis +=1;

            tcpid =  $("#"+ data ).find('.btshuru').attr('cpid');
            canshu = $("#"+ data ).find('.btshuru').attr('canshu');

            jiarugo( tcpid , zhis , canshu , jiahaoback,data );

        });

        mui("#view").on('tap','.guigexuan',function(){

         
            if( ! ANNIU ) return false;

            data = $(this).attr('data');
            disp = $("#chanpid"+data).find(".xzguige").css('display');

            if(disp == 'none'){

                $("#chanpid"+data).find(".xzguige").show();
                $(this).html('收起');

                $(this).css({ 'color':'#ff7400','border': '1px solid #ff7400;' });


                /*
                fan = $(".mui-table-view").offset().top;
                $(".mui-scroll").css({
        
                    transform: 'translate3d(0px, '+(fan-125)+'px, 0px) translateZ(0px)'
                });

                */




            }else{

                $("#chanpid"+data).find(".xzguige").hide();
                $(this).html('选规格');
                $(this).css({ 'color':'#0bbe06','border': '1px solid #0bbe06;' });
            }
        });

        mui("#view").on('tap','.btshuru',function(){

            /* 输入 */
            data = $(this).attr('data');
            zhis = $("#"+data).find('.btshuru').val() *1;


            $(".shurukuang").val(zhis);
            xuanzhi = data;
            mui('#picture').popover('toggle');

        });

        mui("#view").on('tap','.btjianhao',function(){

            /* 减号 */
            if( ! ANNIU ) return false;

            data = $(this).attr('data');
            zhis = $("#"+data).find('.btshuru').val() * 1;

            zhis -= 1;

            tcpid  = $("#"+ data ).find('.btshuru').attr('cpid');
            canshu = $("#"+ data ).find('.btshuru').attr('canshu');

            if(zhis < 1) {

                chash = $("#"+ data ).find('.btshuru').attr('chash');
                shanchugo( tcpid ,chash ,shanchuok ,data);

            }else jiarugo( tcpid , zhis , canshu , jiahaoback,data );


        });

        gouwuche(1);

     });

</script>
<?php if( strstr( $_SERVER['HTTP_USER_AGENT'] , "essenger" )  && $LANG['kjwxid'] != '' ) include QTPL.'weixin.php'; ?>