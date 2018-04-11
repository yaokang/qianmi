<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;


$FAOFF   = logac('faoff');
$ORDERID = isset( $HTTP['2'] ) ? $HTTP['2'] : '';
$KUOMO   = isset( $HTTP['3'] ) ? $HTTP['3'] : 'cha';

 $FAOFF = logac('faoff');
$PAYOFF = logac('payoff');

$PAYTYPE = xitongpay('-1');

if( $ORDERID == '' ) msgbox( '' , mourl( $CONN['userword'] ) );
$D = db('dingdan');

$DATAA = $D ->where( array( 'orderid' => $ORDERID) )-> find();

if( ! $DATAA || $DATAA['uid'] != $USERID || $DATAA['type'] != '0' ) msgbox( '' , mourl( $CONN['userword'] ) );

$PAYTYPE['0'] = '余额支付';
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <style>
    body{padding-bottom:88px;}
    .mui-input-row{background:#fff;}
    .mui-input-group .mui-input-row:after{left:0px;}
    .mui-card-link{font-size:14px;color:#0BBE06;}
    .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:33px;width:25px;height:33px;}
    .hongjine{ font-size:38px;}
    .zhunti{}
    .mui-icon-refresh{ font-size:88px; }
    .mui-icon-refresh b{font-size:12px;}
    .mui-content{background:transparent;}
    .off0 .mui-card-header b{color:red;}
    .off0 .mui-card-content span{color:blue;}
    .off2 *{color:#aaa;}
    .mui-table-view-cell:after{left:0px;}

    .off0{color:#ccc;}
    .off1{color:blue;}
    .off2{color:green;}
    .off3{color:red;}

     .mui-card{}
    b{font-weight:normal;}
    .mui-card .mui-icon {font-size:20px;}
    .mui-card .mui-icon b{color:#000;font-size:14px;}

    .mui-card .mui-icon-map b{color:#8f8f94;}

    .mui-popup{width:auto;}
    
    .mui-table-view-cell{ padding:8px;}

    </style>
</head>
<body>
    <header id="header" class="mui-bar mui-bar-nav">

        <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title"><?php echo $DATA['name'];?></h1>

    </header>

    <div class="mui-content">

        <ul class="mui-table-view">

            <li class="mui-table-view-cell">

                <span> 订单编号 </span>
                <span class="mui-pull-right" style="color:green;"><?php echo $DATAA['orderid'];?></span>

            </li>

            <li class="mui-table-view-cell">

                <span> 订单状态 </span>
                <span class="mui-pull-right off<?php echo $DATAA['off'];?>"><?php if($DATAA['off'] == 2) echo $FAOFF[ $DATAA['faoff']];else echo $PAYOFF[$DATAA['off']]?></span>

            </li>

            <li class="mui-table-view-cell">

                <span> 下单时间</span>
                <span class="mui-pull-right" style="color:REd;"><?php echo date( $CONN['timegeshi'] , $DATAA['atime']);?></span>
                
            </li>

            <?php if($DATAA['off'] == 2){ ?>
            <li class="mui-table-view-cell">

                <span> 支付方式</span>
                <span class="mui-pull-right paytype<?php echo $DATAA['paytype'];?>" ><?php echo $PAYTYPE[$DATAA['paytype']];?></span>

            </li>
            <?php } ?>

            <li >

            <div class="mui-card" style="margin:0px;">
                <div class="mui-card-header"> 
                    <span class="mui-icon mui-icon-contact" style="color:#8a6de9;"> <b><?php echo $DATAA['xingming'];?></b></span>
                </div>

                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <span class="<?php echo $anyou['off'] == 1?'mui-icon mui-icon-map" style="color:Red;':'mui-icon mui-icon-location';?>"> <b> <?php echo $DATAA['shouhuo']?> </b></span>

                    </div>
                </div>

                <div class="mui-card-footer">
                <span class="mui-icon mui-icon-phone" style="color:#1db489;">  <b> <?php echo $DATAA['shouji'];?> </b></span>
                
               
                </div>
            </div>


            </li>
            

                        <?php
                        
                            $D -> setbiao( 'dingdanx' );
                            $XQING = $D ->where( array('orderid' => $DATAA['orderid'] ))->select();

                            $FAHUODE = array();

                            if( $XQING ){


                                foreach( $XQING as $ONG ){

                                    $token = md5( $ONG['biaoshi'].'_'. $ONG['beizhu'] );

                                    if( ! isset( $FAHUODE[ $token ] )) $FAHUODE[ $token ] = $ONG['biaoshi'].' '. $ONG['beizhu'];
                        
                        ?>  
                        <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;">

                <img class="mui-media-object mui-pull-left" src="<?php echo pichttp( $ONG['tupian']);?>" style="max-width:100px;width:100px;height:100px;">
                <div class="mui-media-body">
                
                    <span class="mui-pull-left" style="width:80%;"><?php echo $ONG['name']?></span>
                    
                    <button class="mui-btn-danger mui-btn-outlined mui-pull-right" style="width: 50px; padding: 4px;font-size:12px;" onclick="window.location.href='<?php echo WZHOST.'api.php?action=tiao&id='.$ONG['cpid']?>'" > 详情 </button>

                    <p class="mui-ellipsis mui-pull-left" style="margin-top:20px;width:100%;">
                        <span class="list-col-orange mui-pull-left" style="color: #ff7400;">
                            <?php echo $HUOBIICO[$ONG['huobi']].$ONG['jine']?>
              
                            <b style="color: #999;display:block;font-weight:normal;"><?php echo str_replace( '_',' ',$ONG['canshu'] );?></b>
                        </span>
                        <button class="mui-btn-success guigexuan mui-pull-right" > X <?php echo $ONG['num']?> </button>
                    </p>

                </div>
                
                
            </li>
                        <?php } } ?>

          
             <li class="mui-table-view-cell">

             <span class="mui-icon mui-icon-mcczjia" style="color:green;"></span> 支付总价 

               


                    <span class="mui-pull-right orange"><?php echo $HUOBIICO['0'].' '.$DATAA['jine'];?> 

                    <?php if( $DATAA['jifen'] > 0 ) echo $HUOBIICO['1'].' '.$DATAA['jifen'].' ';?>
                    <?php if( $DATAA['huobi'] > 0 ) echo $HUOBIICO['2'].' '.$DATAA['huobi'].' ';?>
                    
                    
                    </span>
                
               
                
            </li>

            <li class="mui-table-view-cell">

                <span class="mui-icon mui-icon-mccyhui" style="color:#9900FF;"></span> <?php echo $CONN['hongbao'];?>抵扣 
                <span class="mui-pull-right" style="color:Red;"> <?php  $hongbao = sprintf("%.2f",$DATAA['fakuaima']); echo $HUOBIICO['0'].' '.$hongbao;?> </span>

            </li>


            <li class="mui-table-view-cell">

                <span class="mui-icon mui-icon-mccyfei" style="color:#FF6600;"></span> 运费
                <span class="mui-pull-right"><?php echo $HUOBIICO['0'].$DATAA['yunfei'];?></span>

            </li>



            <?php if( $DATAA['off'] == 2 && $DATAA['faoff']  > 1  && $FAHUODE  ){
            echo '';
            foreach( $FAHUODE as $ne ){

                $wuliu = explode( ' ' , $ne );
            
             ?> <!-- <div class="m-order-item" onclick="openurl('物流跟踪','https://m.baidu.com/s?ie=utf-8&wd=<?php echo $ne;?>');"> -->
                <li class="mui-table-view-cell" onclick="openurl('物流跟踪','https://m.kuaidi100.com/result.jsp?nu=<?php echo $wuliu['1'];?>');">

                    <span style="color:green;"> 物流跟踪: <?php echo $wuliu['0'];?> </span>
                    <span class="mui-pull-right"> <?php echo $wuliu['1'];?> </span>
                </li>
                
            <?php }
            
            echo '</li>';
            } 
            
            $payjin = $DATAA['payjine'] - $hongbao;

            $payjin = $payjin < 0 ?0 :$payjin;
            
            ?>

            <?php  if( $DATAA['off'] == 2){ ?>
      
                <li class="mui-table-view-cell">

                    <span> 实际支付 </span>
                    <span class="mui-pull-right" style="color:green;"> <?php echo $HUOBIICO['0'].' '.($DATAA['rejine']);?> </span>
                  
                </li>

                <li class="mui-table-view-cell">
                    <span> 支付时间 </span>
                    <span class="mui-pull-right" style="color:green;"> <?php echo date( $CONN['timegeshi'] , $DATAA['xtime']);?></span>

                </li>

            <?php } ?>

             <?php if($DATAA['off'] < 2 ){ ?>

                <input type="hidden" class="payjine"    value="<?php echo $payjin;?>" title="最终支付金额">
                <input type="hidden" class="userjine"   value="<?php echo $USER['jine'];?>">
          
          
             <div class="m-payment-content " id="payment_content">
              
                <!-- 支付方式-->
                <ul class="mui-table-view mui-table-view-radio">
            <?php  
                $PAY = xitongpay( '0' );
                if( $PAY ){ 
                    $z = 0;
                    echo '<input type="hidden" name="paytype" value="'.$PAY['0']['id'].'">';
                    foreach( $PAY as $ONG ){
            ?><li class="mui-table-view-cell<?php echo $z=='0'?' mui-selected':'';?> pay-item" data="<?php echo $ONG['id']?>">
                <a class="mui-navigate-right">
                  <img src="<?php echo pichttp($ONG['suoluetu']);?>" style="height:30px;float:left;">
                  <b style="float:left;height:30px;line-height:30px;margin-left:5px;font-weight:normal;"><?php echo $ONG['name'];?></b>
                </a>
            </li><?php $z++; } }  ?>


                </ul>


                
            <li class="mui-table-view-cell mui-checkbox" style="background:#fff;padding:8px 2px;height:50px;line-height:50px;">
                    <label>

                        <b style="float:left;height:30px;line-height:30px;margin-left:5px;font-weight:normal;"><span class="mui-icon mui-icon-mccyue" style="color:#007aff;"></span> 余额( <?php echo $USER['jine'];?> )支付</b>
                        
                    </label>
                        <input name="checkbox1" value="Item 3" type="checkbox" class="pay-items" >
                    </li>

               


                   

               
            </div>
             

             <?php } ?>







        </ul>

    </div>




        

                        

     <?php if($DATAA['off'] < 2 ){ ?>

     <button type="button" class="mui-btn mui-btn-success mui-btn-block" onclick="return tijiao();"style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >立即支付</button>


    <?php }else if($DATAA['off'] == 2 && $DATAA['faoff'] == 2){ ?>

        <button type="button" class="mui-btn mui-btn-success mui-btn-block" onclick="return shouhuo();"style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >确定收货</button>

    <?php }else if( $DATAA['faoff'] == '3' && $ONG['pingoff'] == '0' ) { ?>

            <a type="button" href="<?php echo mourl( $CONN['userword'] . $CONN['fenge'].'pinglun'.$CONN['fenge'].$DATAA['orderid'] );?>"  class="mui-btn mui-btn-success mui-btn-block" style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >立即评论</a>

                 

    <?php }else if( $DATAA['faoff'] >= '3' &&  $ONG['pingoff'] > '0' ) { ?>
                
                <a type="button" href="<?php echo mourl( $CONN['userword'] . $CONN['fenge'].'pinglun'.$CONN['fenge'].$DATAA['orderid'] );?>"  class="mui-btn mui-btn-success mui-btn-block" style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >查看评论</a>

    <?php } ?> 

                     

  
<?php include QTPL .'foot.php';?>
<script type="text/javascript">
var PAYFF    = 0;
var xiaid = '<?php echo $DATAA['orderid'];?>';
 TOKEN    = '<?php echo  wenyiyz( 'ding/'.$USERID ,  '' , $Mem );?>';

function openurl( title, url){

        mheight = $(window).height()-150;
        html = '<div style="width:100%;min-width:'+($(window).width()-45)+'px;height:'+mheight+'px;"><iframe frameborder="0" src="'+url+'" style="width:100%;height:100%;"></iframe></div>';

        mui.alert(html,title,'关闭');

}


function shouhuo(){

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'ding',d:'put',dingid:xiaid,ttoken: TOKEN,lx:2},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){


                if( data.token && data.token != '') TOKEN = data.token;

                mui.toast ( data.code == -1  ? '收货失败' : '收货成功'  ,{url:"<?php echo mourl( $CONN['userword'] , '' ,  $CONN['fenge'].'chading'.$CONN['fenge'] );?>"+xiaid+"<?php echo $CONN['fenge'];?>.html" });

            },error:function(xhr){

                dataerror(xhr , '收货' );
            }

        });
}


function payzhifu( payfs ){

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'ding',d:'put',dingid:payfs,ttoken: TOKEN,paylx:2},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){


                if( data.token && data.token != '') TOKEN = data.token;

                mui.toast ( data.code == -1  ? '支付失败查看详情' : '支付成功'  ,{url:"<?php echo mourl( $CONN['userword'] , '' ,  $CONN['fenge'].'chading'.$CONN['fenge'] );?>"+payfs+".html" });

            },error:function(xhr){

                dataerror(xhr , '支付订单' );
            }

        });



}


function tijiao(){

        if( xiaid != '' ){

            payjine  = $(".payjine").val() ;      /* 支付金额 */
            payfashi = $("[name=paytype]").val(); /* 支付方式 */
            userjine = $(".userjine").val();      /*用户的余额 */

            if( PAYFF == 1 ){

                cha = userjine - payjine;

                if( cha >=0 ){

                    /*余额支付*/
                    payzhifu( xiaid );

                }else{

                    /*金额不足*/
                    mui.toast ( '支付中...'  ,{url:(HTTP+ "pay.php?y=pay&jine="+(-(cha.toFixed(2)))+"&paytype="+payfashi+"&paylx=2&order="+xiaid)});
                }

            }else{

                mui.toast ( '支付中...'  ,{url:(HTTP+ "pay.php?y=pay&jine="+(payjine.toFixed(2))+"&paytype="+payfashi+"&order="+xiaid+"&paylx=2")});

            }
        }
}


$(function(){

     $(".pay-items").click(function(){



    if( PAYFF == '0'){

        if( $(".userjine").val()*1 > 0 ){ 
            
            PAYFF = 1;
           

        }

    }else{

        PAYFF = 0;
        
    }

});


 $(".pay-item").click(function(){

        $(".pay-item .fdayicon-pay").hide();
        data = $( this ).attr( 'data' );
        $( "[name=paytype]" ).val( data );
        $( this ).find('.fdayicon-pay').show();

    });
 
 
 });
</script>