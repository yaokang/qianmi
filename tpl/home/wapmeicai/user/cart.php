<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$GWC  = $Mem -> g( 'gouwuche/'. $USERID );
if( ! is_array( $GWC ) ) $GWC = array();
$huobi0 = $huobi1 = $huobi2 = 0;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <style>
    .xzguige{display:block;}

    .btxzkan{ width:95px;position:relative;float:right;top:10px;margin-right:8px;}
    .btxzkan *{text-align:center;height:35px;border-radius: 100%;line-height:35px;padding:0px;margin:0px;position:absolute;font-size: 12px;border-color:#ebebeb;}

    .btjianhao{display:block;/* - */ width:30px;left:0px;z-index:1;color:#0bbe06;font-weight:bold;}
    input.btshuru{ display:block;/* 输入框 */width:65px;left:15px;height:35px;border-width:1px 0px;padding:0px;margin:0px;border-color:#ebebeb;}
    .btjiahao {/* + */width:35px;left:60px;z-index:1;color:#0bbe06;font-weight:bold;}


    .xuanzeguig{padding:3px 0;}
    .xuanzeguig label{width:158px;color:#999;height:60px;padding:0px;font-size:12px;}

    .xuanzeguig label b{color:#ff7400;display:block;line-height:30px;font-weight:normal;font-size:16px;}
    .mui-card-content .tupianji img{width:100%;}

    .fhdingbu{display:none;border:1px solid #0bbe06;width:30px;height:30px;line-height:30px;background:#fff;text-align:center;position:fixed;right:58px;bottom:58px;border-radius: 50%;color:#0bbe06;z-index:88;}

    .mui-table-view-cell{ padding:8px;}

    .mui-table-view img.mui-media-object {max-width:60px;width:60px;height:60px;border:1px solid #efeff4;}

    .anniu{height:35px;line-height:35px;}
    .shuruke{ border:1px solid #eee;height:35px;line-height:35px;border-radius:30px; }
    .cart-empty{text-align:center;padding:58px 0;}

    .jihuobi0{color:Red;}
    .jihuobi1{color:#4cd964;margin-left:8px;}
    .jihuobi2{color:#007aff;margin-left:8px;}
    </style>
   
    </head>

    <body style="padding-bottom:106px;background:#fff;">




   <header id="header" class="mui-bar mui-bar-nav">

        <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>"></a>
        <h1 class="mui-title">订单确认</h1>
        <a href="<?php echo mourl( $CONN['userword']);?>" style="padding:0px;margin:0px;font-size:25px;" class="mui-icon mui-icon-contact mui-btn-link mui-pull-right"></a>
    </header>



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

            <a class="mui-tab-item2 mui-active" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge" style="display:none;"></span></b>
                </span>
                <span class="mui-tab-label">购物车</span>
            </a>

            <a class="mui-tab-item2  " href="<?php echo mourl( $CONN['userword']);?>">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
                <span class="mui-tab-label">我的</span>
            </a>
        </nav>



        
        



        <ul id="view" class="mui-table-view mui-content" style="padding-bottom:0px;">


            <?php if( $GWC ){ 

   
      foreach( $GWC as  $k => $gou){ ?>


           <?php if( is_array( $gou ) ){ 


           
           $i = 1;
            foreach($gou as $kv => $xiang){

                $chash =  md5( $xiang['cpid'].'_'.$xiang['canshu']  );
           ?> <li class="mui-table-view-cell" id="chanpid<?php echo $xiang['cpid'].'_'.$i?>">

                <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red">删除</a>
                    </div>
                    <div class="mui-slider-handle mui-table">
                        <div class="mui-table-cell">

   
                    <img class="mui-media-object mui-pull-left" src="<?php echo $xiang['tupian']?>" style="height:60px;width:60px;">
                    <div class="mui-media-body">
                        <?php echo $xiang['name']?>
                        <div class="xzguige" style="clear:both;">

                            <div class="mui-input-row xuanzeguig" id="cs<?php echo $xiang['cpid'].'_'.$i?>">


                                <input type="hidden" value="<?php echo $zji = $xiang['num'] * $xiang['jiage']; ?>" class="jiage  huobi<?php echo $xiang['huobi']?>"  />

                                <label> <b> <?php echo $HUOBIICO[ $xiang['huobi']].$xiang['jiage'];?> </b>
                                <?php echo str_replace( '_',' ',$xiang['canshu'] );?>

                                </label>
                                <div class="btxzkan">
                                    <button class="btjianhao" type="button" data="cs<?php echo $xiang['cpid'].'_'.$i?>">一</button>
                                    <input class="btshuru"   type="number" value="<?php echo $xiang['num'];?>" readonly="readonly" data="cs<?php echo $xiang['cpid'].'_'.$i?>" chash="<?php echo $chash;?>" chashz="z<?php echo $chash;?>" cpid ="<?php echo $xiang['cpid']?>" canshu="<?php echo $xiang['canshu'];?>" danjia="<?php echo $xiang['jiage'];?>"
                                    
                                    >
                                    <button class="btjiahao" type="button" data="cs<?php echo $xiang['cpid'].'_'.$i?>">十</button>
                                </div>

                            </div>
                        </div>

                    </div>

                    </div>

                    </div>


                </li>


            

                <?php

                if( $xiang['huobi'] == '0')
                    $huobi0  += $zji;
                else if( $xiang['huobi'] == '1')
                    $huobi1  += $zji;
                else if( $xiang['huobi'] == '2')
                    $huobi2  += $zji;
               
                
                $i++;
                
                } } ?>


                <?php } }else{  ?>

                <div class="cart-empty" > 
                
                
                <img src="<?php echo DQTPL?>images/cart_empty.png" > 
                
                <p class="cart-empty-text">购物车还没有商品，快去添加吧</p> 
                
                <a class="mui-btn mui-btn-success mui-btn-block" style="width:50%;margin:0 auto;" href="#" onclick="window.location.href='/'">去购买</a> 
                
                
                </div>

   
    <?php } ?>






                
        </ul>

         <div style="position: fixed;left:0px;bottom:56px;z-index:2;background:REd;width:100%;">
            <ul class="mui-table-view">
                <li class="mui-table-view-cell" style="height:50px;line-height:36px;">
                    总计:<span class="jihuobi0 jihuobi"><?php  echo  $HUOBIICO['0'].$huobi0;?></span>
                    <span class="jihuobi1 jihuobi"><?php if( $huobi1  > 0) echo  $HUOBIICO['1'].$huobi1;?></span>
                    <span class="jihuobi2 jihuobi"><?php if( $huobi2  > 0) echo  $HUOBIICO['2'].$huobi2;?></span>
                    <button type="button" class="mui-btn mui-btn-primary" onclick="return jiesuan();">去结算</button>
                </li>


            </ul>


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

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="1"> 1</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="2"> 2</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="3"> 3</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="4"> 4</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="5"> 5</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="6"> 6</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="7"> 7</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="8"> 8</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke"  data="9"> 9</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <div class="anniu" > <a href="#picture" class="mui-btn mui-btn-primary">取消</a> </div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <div class="anniu shuruke" data="0"> 0</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <div class="anniu" > <div class="mui-btn mui-btn-primary" onclick="queren();">确认</div> </div>
               </li>

            </ul>
        </div>



</body>
</html>
<?php include QTPL.'foot.php';?>
<script>
var xuanzhi ='';
mui.init();
function jiesuan(){

    lenn = $("#view li").length;

    if( lenn == '0' ){

        mui.toast ( '购物车还没有商品' ,{ url:HTTP } );

       
        return false;
    
    }

    mui.toast ( '提交中...' ,{ duration:500, url:'<?php echo mourl( $CONN['userword'].$CONN['fenge'].'ding' );?>' } );




}

function anqingchu(){

    $(".shurukuang").val('0');
}







function gxjine(){

        huobi0 = huobi1 = huobi2 = 0;

        $(".huobi0").each(function(){
        
            huobi0 += $(this).val()*1;

        });

        $(".huobi1").each(function(){
        
            huobi1 += $(this).val()*1;

        });

        $(".huobi2").each(function(){
        
            huobi2 += $(this).val()*1;

        });

        
        $(".jihuobi0").html(  $HUOBIICO['0']+ ( huobi0.toFixed(2) )  );
 
       

        if( huobi1 > 0){
            $(".jihuobi1").html(  $HUOBIICO['1']+ huobi1  );
        
        }else{
             $(".jihuobi1").hide();
        
        }

        if( huobi2 > 0){

            $(".jihuobi2").html(  $HUOBIICO['2']+ huobi2  );
        
        }else{

            $(".jihuobi2").hide();
        
        }

        if( $("#view li").length < 1){

            $(".mui-icon-mcgwc").find(".mui-badge").hide();
            $(".mui-bar-nav").find(".mui-badge").hide();
        
        
        }




}

function jiahaoback( data,zhis,DATRA ){

        ANNIU = true;

        
        $("#"+data).find('.btshuru').val(zhis);

        danjia = $("#"+data).find('.btshuru').attr('danjia') * 1 ;


        $("#"+data).find('.jiage').val( ( zhis * danjia ) );




        $("#"+data).find('.btjianhao').show();
        $("#"+data).find('.btshuru').show();

        xweizhi = Math.floor(Math.random()*20+1);
        yweizhi = Math.floor(Math.random()*50+1);



        var top  = $("#"+data).find('.btshuru').offset().top +xweizhi;
        var left = $("#"+data).find('.btshuru').offset().left +yweizhi;


        var suij = Math.round(Math.random()*100+1);
        $("body").append('<span  class="woquyss'+suij+' mui-icon mui-icon-mczdan" style="z-index:999999;position:absolute;color:#0bbe06;font-size:28px;top:'+top+'px;left:'+left+'px;display:block;width:30px;height:30px;border-radius: 100%;"></span>');
            
        var mbtop  = $(".mui-icon-mcgwc").offset().top-10;
        var mbleft = $(".mui-icon-mcgwc").offset().left+20;

        suiji = (mbtop - top) * Math.floor(Math.random()*3+2);

        $(".woquyss"+suij).animate({ width: "0px", height: "0px", top:mbtop, left:mbleft,opacity:0.1 }, suiji  ,function(){
        
        setgwnum( DATRA );
        gxjine();

        $(".woquyss"+suij).remove();

        });


        gxjine();

    
    }
    
    function shanchuok(data,zhis,DATRA){

        ANNIU = true;
        
        $("#"+data).find('.btshuru').val(0);
        $("#"+data).find('.btjianhao').hide();
        $("#"+data).find('.btshuru').hide();

        $zhuli = data.replace(/cs/,'chanpid');

        $("#"+$zhuli).remove();

        

        setgwnum( DATRA );

        ll = $("#view li").length;

        if( ll < 1 ){

            html ='<div class="cart-empty" ><img src="<?php echo DQTPL?>images/cart_empty.png" > <p class="cart-empty-text">购物车还没有商品，快去添加吧</p>  <a class="mui-btn mui-btn-success mui-btn-block" style="width:50%;margin:0 auto;" href="#" onclick="window.location.href=\'/\'">去购买</a> </div>';
            $("#view").html(html);

        }

        gxjine();

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





mui.ready(function() {


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

        mui('#view').on('slideleft', '.mui-table-view-cell', function(event) {

                var btnArray = ['确认', '取消'];

                var elem = this;

                    data = $(this).find('.btshuru').attr('data');
                    chash = $(this).find('.btshuru').attr('chash');
                    tcpid = $(this).find('.btshuru').attr('cpid');

                    mui.confirm('', '删除产品', btnArray, function(e) {
                        if (e.index == 0) {

                            shanchugo( tcpid ,chash ,shanchuok ,data);

                        } else {

                            setTimeout(function() {
                                mui.swipeoutClose(elem);
                            }, 10);

                        }
                    });

                    



    });


    gouwuche();
});








</script>