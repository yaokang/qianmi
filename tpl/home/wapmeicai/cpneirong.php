<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');

$PICT = array( $DATA['tupian']);

if( $DATA['tupianji'] != '' ) $PICT = unserialize( $DATA['tupianji'] ); 

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
           if(url.value== "") alert('请填写关键字');
           else  window.location.href="<?php echo mourl($CONN['sosoword'],'',$CONN['fenge']);?>"+url.value+"<?php echo $CONN['houzui'];?>";
           return false;
        }
    </script>

    <style>
        .xzguige{display:block;}

        .btxzkan{ width:95px;position:relative;float:right;top:10px;margin-right:8px;}
        .btxzkan *{text-align:center;height:35px;border-radius: 100%;line-height:35px;padding:0px;margin:0px;position:absolute;font-size: 12px;border-color:#ebebeb;}

        .btjianhao{display:none;/* - */ width:30px;left:0px;z-index:1;color:#0bbe06;font-weight:bold;}
        input.btshuru{ display:none;/* 输入框 */width:65px;left:15px;height:35px;border-width:1px 0px;padding:0px;margin:0px;border-color:#ebebeb;}
        .btjiahao {/* + */width:35px;left:60px;z-index:1;color:#0bbe06;font-weight:bold;}


        .xuanzeguig{border-top:1px solid #ebebeb;padding:3px 0;}
        .xuanzeguig label{width:138px;color:#999;height:60px;}

        .xuanzeguig label b{color:#ff7400;font-size:18px;display:block;line-height:30px;}
        .mui-card-content .tupianji img{width:100%;}

        .fhdingbu{display:block;border:1px solid #0bbe06;width:30px;height:30px;line-height:30px;background:#fff;text-align:center;position:fixed;right:58px;bottom:58px;border-radius: 50%;color:#0bbe06;z-index:88;}
        .fhdingbu{display:none;}

        .anniu{height:35px;line-height:35px;}
        .shuruke{ border:1px solid #eee;height:35px;line-height:35px;border-radius:30px; }

        </style>
   
    </head>
 <body >
        <header id="header" class="mui-bar mui-bar-nav">
            <a class=" mui-icon mui-icon-back  mui-pull-left " href="<?php 
            if(strstr( $_SERVER['HTTP_USER_AGENT'], 'jfwlapp2' ) ){
               echo "javascript:test('one')";
            }else{
                echo '/';
            }
            ?>"></a>
            <h1 class="mui-title">商品详情</h1>
            <a class="mui-icon mui-icon-mcgwc mui-pull-right" style="margin-right:8px;margin-top:5px;" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>"> <span class="mui-badge" style="left:70%;top:0px;padding:2px 8px;display:none;">0</span></a>
        </header>

        <div class="mui-content" style="background:#edf0ef;">

            <div id="slider" class="mui-slider" >
            <div class="mui-slider-group mui-slider-loop" style="min-height:100px;">

                <div class="mui-slider-item mui-slider-item-duplicate">
                        <img  src="<?php echo  pichttp(end ($PICT));?>" alt="<?php echo $DATA['name'];?>">
                    </div>
                
                <?php

                

                    foreach( $PICT as $ONG ){
                ?> 
                    <div class="mui-slider-item">
                        <img  src="<?php echo pichttp( $ONG) ;?>" alt="<?php echo $DATA['name'];?>">
                    </div>

                <?php }?>

                <div class="mui-slider-item mui-slider-item-duplicate">
                         <img  src="<?php echo  pichttp(reset ($PICT));?>" alt="<?php echo $DATA['name'];?>">
                    </div>
             
            </div>
           
        </div>


        <div class="mui-card" style="margin:0px;">
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <?php echo $DATA['name'];?>
                    </div>
                </div>
            </div>


            <?php

               if($DATA['canshu'] !='') $DATA['canshu'] = unserialize( $DATA['canshu'] );
                else $DATA['canshu'] =  array();


                $shuju = isset( $DATA['canshu']['shuju'] ) ? reset( $DATA['canshu']['shuju'] ) : array();
                $jiage = isset( $DATA['canshu']['jiage'] ) ? (float)reset( $DATA['canshu']['jiage'] ) : $DATA['jiage'] ;


                $ZICAN = array( array( 'name'=> $shuju ? $shuju : '' , 'jiage' => $DATA['jiage'],'chash' => md5( $DATA['id'].'_' )  ));

                if( isset( $DATA['canshu']['jiage'] ) ){

                    $ZICAN = array();

                    foreach( $DATA['canshu']['jiage'] as $kk => $vv){

                        $zjiage = $vv =='' ? $DATA['jiage']: $vv;
                        if($zjiage <  0)  continue;
                        $ZICAN[] = array( 'name'=>  $kk , 'jiage' =>  $zjiage ,'chash' => md5( $DATA['id'].'_'.$kk ) );
                        p($ZICAN);

                    }
                }

            ?>




        <div class="mui-card" style="margin:10px 0px;" id="view">
                <div class="mui-card-content">
                        <div class="xzguige" style="clear:both;">

                        <?php foreach($ZICAN as $k => $vv){?>

                        <div class="mui-input-row xuanzeguig" id="cs<?php echo $DATA['id'].'_'.$k?>">

                <label>
                
                
               <b><?php echo $HUOBIICO[$DATA['huobi']]?><?php echo $vv['jiage']?> </b><?php echo str_replace('_',' ', $vv['name'])?> 
               
                
                </label>
                <div class="btxzkan">
                    <button class="btjianhao"  type="button" data="cs<?php echo $DATA['id'].'_'.$k?>">一</button>
                    <input  class="btshuru"  type="number" value="0" readonly="readonly" chash="<?php echo $vv['chash']?>" cpid ="<?php echo $DATA['id']?>" canshu="<?php echo $vv['name'];?>" chashz="z<?php echo $vv['chash'];?>" data="cs<?php echo $DATA['id'].'_'.$k?>">
                    <button class="btjiahao" type="button" data="cs<?php echo $DATA['id'].'_'.$k?>">十</button>
                </div>

            </div>

        <?php } ?>







                        </div>
                 </div>
              </div>


        <div class="mui-card" style="margin:8px 0px;">
                <div class="mui-card-header">  <span class="mui-icon mui-icon-image" style="color:#0bbe06;"> <b style="color:#000;font-size:14px;">详情描述</b> </span></div>
                <div class="mui-card-content" >

                <?php if( $ZDATA['kuozanform'] != '' ){
                
                $KUOZAN = unserialize( $ZDATA['kuozanform'] );
                $KUOZHI = unserialize( $DATA['kuozan'] );

                if( !$KUOZHI ) $KUOZHI = array();

                ;


                
                ?>
                
                    <ul class="mui-table-view">

                        <?php if( $KUOZAN ){
                        $ii = 0;
                        foreach($KUOZAN as   $ONGG){
                        ?>

                        <li class="mui-table-view-cell"><?php echo $ONGG['扩展标题'];?> <span class="mui-badge mui-badge-primary"><?php echo isset($KUOZHI[$ii]) ? $KUOZHI[$ii] : '';?></span></li>

                        <?php  $ii++;}} ?>
                       

                    </ul>
            

                <?php } ?>

                    <div class="mui-card-content-inner tupianji" style="border-top:1px solid #ccc;">

                        <?php echo $DATA['neirong'];?>
                      
                    </div>
                </div>
            
            </div>


</div>

        

   
        <a class="mui-icon mui-icon-arrowthinup fhdingbu" href="javascript:gotop();"></a>
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
    
            

<script src="<?php echo DQTPL?>js/mui.lazyload.js"></script>
<script src="<?php echo DQTPL?>js/mui.lazyload.img.js"></script>
</body>
</html>
<?php include QTPL.'foot.php';?>
<script>

    var xuanzhi= '';
    var WCHE = false;


    mui.init({ swipeBack:true });

    function gotop(){

        mui.scrollTo(0,500);

    }

    function anqingchu(){

        $(".shurukuang").val('0');
    }

     function gengxinx(){

        for(var i in GOUCHE){


              

                if( $("[chashz=z"+i+"]").length > 0){


                   
                   data = $("[chashz=z"+i+"]").attr('data');
                  

                    $("#"+data).find('.jia').val(GOUCHE[i]);
                    $("#"+data).find('.btjianhao').show();
                    $("#"+data).find('.btshuru').show();
                }

        }


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

        suiji = (top - mbtop) * Math.floor(Math.random()*5+2);


        $(".woquyss"+suij).animate({ width: "0px", height: "0px", top:mbtop, left:mbleft,opacity:0.1 }, suiji  ,function(){
        
       
        $(".woquyss"+suij).remove();

        });

        setgwnum( DATRA );





        
    
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



    var slider = mui("#slider");
    slider.slider({ interval: 5000 });

    (function($) {
            
        $(document).imageLazyload({
            placeholder: '<?php echo DQTPL?>images/60x60.gif'
        });


    })(mui);


    mui.ready(function() {

        thd = $(window).height();

        $(window).scroll(function() {

            gun = $(window).scrollTop();
            if( gun - thd  > 10) $(".fhdingbu").show();
            else $(".fhdingbu").hide();

        });


        gouwuche(1);

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

            <?php if(strstr( $_SERVER['HTTP_USER_AGENT'], 'jfwlapp2' ) ){?>
                test('two');
            <?php }?>

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

            <?php if(strstr( $_SERVER['HTTP_USER_AGENT'], 'jfwlapp2' ) ){?>
                test('two');
            <?php }?>

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

    });

</script>

<script type="text/javascript">



/**
*  该函数英语桥接
* model --->所在商品的所有属性
*type  ---->按钮类型   －－》》三种类型  one－－－>代表返回首页
*                                     two---->代表单独购买
*                                     three--->代表开团
*
*/

function test(type){

    
    WebViewBridge.send ( type ) ;


}


</script>