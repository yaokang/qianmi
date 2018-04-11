<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;

$yuntype = logac('yuntype');
$YFFS = logac('yunfs');
$_SESSION['paydd'] = time();

$CPID = (float)(isset( $HTTP['2']) ? $HTTP['2'] : 0 );
$NUM  = (int)  (isset( $HTTP['3']) ? $HTTP['3'] : 1 );
$CSHU = (int)  (isset( $HTTP['4']) ? $HTTP['4'] : 1 );

if( $NUM < 1 ) $NUM = 1;
$_SESSION['shangyibu'] = mourl($URI);
$YUNFEIJI  = $yunfei = $huobi0 = $huobi1 = $huobi2  = 0;

$ZONGLIANG = $BAOCAN =  $YUNJL = array();

$SHANGJIA = array('0' => '官方','2' => '骏飞商家');
$cunzia   = false;
$xiang = danye( $CPID ,'',1);

if( ! $xiang) msgbox('非法产品id',WZHOST);

if( $xiang['off'] != 2 )msgbox('', $xiang['link'] );


 if( $xiang['canshu'] != '') $xiang['canshu'] = unserialize( $xiang['canshu'] );

        $JIAGE = isset( $xiang['canshu']['jiage'] ) ? $xiang['canshu']['jiage'] : array() ;

        $jiage = $xiang['jiage'];
        $CSU = '';
        
        $i = 0;
        foreach( $JIAGE as $k => $v ){

            if($i == $CSHU){
            $CSU = $k;
            break;
            }

        
        $i++;
        }

        $GUIGE =  count( $JIAGE );
     

        if(  $GUIGE > 0 && $GUIGE < $CSHU+1 )msgbox('非法规格', $xiang['link']);



        



        if( $CSU == '' ) $CSU = key($JIAGE);

        if(isset( $JIAGE[ $CSU ]) )  $jiage = (float)$JIAGE[ $CSU ];
        else{

            $CSU = '';
        }

    

        if( $jiage < 0 ) msgbox(str_replace('_',' ',$CSU) .' 缺货 ' , $xiang['link'] );

        if( $xiang['xiangou'] > 0 && $xiang['xgtype'] > 0 ){

            if( $jiage < 0.001 ) {

                $xiang['xgtype']  = 2;
                if($xiang['xiangou'] < 1 || $CONN['xiangou0'] == 1 ) $xiang['xiangou'] = 1 ;
                $xiang['xgdata'] = $xiang['xiangou'];

            }

            $XGTYPE = logac('xgtype');

            if( $NUM >= $xiang['xiangou'] )msgbox(  $XGTYPE[$xiang['xgtype']].$xiang['xgdata'].' 超过数量2 '.$xiang['xiangou'] , $xiang['link'] );


            $yigou = xiangou( $USERID  , $xiang );
            $zuida = $xiang['xiangou'] - $yigou;

            if( $zuida <= 0 )msgbox(  $XGTYPE[$xiang['xgtype']].$xiang['xgdata'].' 超过数量 '.$xiang['xiangou']  , $xiang['link'] );

            if( $NUM > $zuida ){ 

                $NUM = $zuida;
            }

        }



        $SHANGJIN = 0;

        $SHJIA = $xiang['shid'];
        $xiang['num'] = $NUM;
        $zji = $NUM * $jiage;

        if( $xiang['huobi'] == '0'){

            $huobi0   += $zji;  /*货币金额*/
            $SHANGJIN += $zji;  /*总金额*/

        }else if( $xiang['huobi'] == '1')
            $huobi1  += $zji;
        else if( $xiang['huobi'] == '2')
            $huobi2  += $zji;

        $JINZHONG = $xiang['num'] * $xiang['jinzhong'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <style>
    .mui-card{margin:10px 0px;}
    body{padding-bottom:58px;}
    b{font-weight:normal;}
    .mui-card .mui-icon {font-size:20px;}
    .mui-card .mui-icon b{color:#000;font-size:14px;}

    .mui-card .mui-icon-map b{color:#8f8f94;}
    .mui-btn-block{padding:5px 0px;margin:3px;}
    .xzguige{display:block;}

    .btxzkan{ position:relative;float:right;top:10px;margin-right:8px;}
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
    .m-order-item{padding:0px 8px;}
    .mui-table-view-cell:after{left:0px;}
    
    </style>

</head>
<body>


    <header id="header" class="mui-bar mui-bar-nav">

        <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>"></a>
        <h1 class="mui-title">订单确认</h1>
        <a href="<?php echo mourl( $CONN['userword']);?>" style="padding:0px;margin:0px;font-size:25px;" class="mui-icon mui-icon-contact mui-btn-link mui-pull-right">
        
        </a>
    </header>


     <div class="mui-content" style="background:transparent;">

    <?php  $SHOUHUO = $D ->setbiao('shouhuo')-> where( array( 'uid' => $USERID )) ->order('off desc,id desc') -> find(); 
        if( $SHOUHUO ){
    ?>
        <input type="hidden" id="address_id" value="<?php echo $SHOUHUO['id']?>" />
        <input type="hidden" class="jisuandiqu" value="<?php echo $YUNFEIJI = jisuandiqu(  $SHOUHUO['diqu'] );?>" />
        <div class="mui-card">
            <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'list');?>">
                <div class="mui-card-header"> 
                    <span class="mui-icon mui-icon-contact" style="color:#8a6de9;"> <b><?php echo $SHOUHUO['xingming'];?></b></span>
                </div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <span class="<?php echo $SHOUHUO['off'] == 1?'mui-icon mui-icon-map" style="color:Red;':'mui-icon mui-icon-location';?>"> <b><?php echo $SHOUHUO['beizhu'];?> </b></span>
                    </div>
                </div>
                <div class="mui-card-footer">
                    <span class="mui-icon mui-icon-phone" style="color:#1db489;">  <b> <?php echo $SHOUHUO['shouji'];?> </b></span>
                </div>
            </a>
        </div>

    <?php }else{ ?>


        <div class="mui-card">

            <div class="mui-card-content">
                <div class="mui-card-content-inner" style="text-align:center;">
                    <h4>您还没有添加地址噢~</h4>
                    <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'list');?>" class="btn btn-warning navbar-btn">新增地址</a>
                </div>
            </div>

        </div>

    <?php } ?>


    <?php 

                $hongbao = hongbao( $USERID );
                $x = '<option value="0"> （暂无可用'.$CONN['hongbao'].'） </option>';

                if( $hongbao ){

                    $x = '<option value="0"> （选择你的'.$CONN['hongbao'].'） </option>';

                    foreach( $hongbao as $xiangq ){

                        $x .= '<option value="'.$xiangq['id'].'" data="'.$xiangq['dayukeyong'].'" youhui="'.$xiangq['shengyujine'].'"> （'.$CONN['hongbao'].' '.$xiangq['shengyujine'].' 满 '.$xiangq['dayukeyong'].' 可用） </option>';

                    }
                }
                
                ?>
                <div class="mui-card">
                    <select name="hongid" class="mui-btn mui-btn-block" > <?php echo $x;?> </select>
                </div>



     
            
        
                <ul id="view" class="mui-table-view m-cartlist">



               
                    <li class="mui-table-view-cell">
                    
                    
                    
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
                                    x <?php echo $xiang['num'];?>
                                </div>
                                



                            </div>
                        </div>

                    </div>
                    
                    
                    
                    
                    
                    
                    
                   
                    </li>  
                 


                        </ul>
                    </div>
                </div>
            </li>


          
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
                 
            </div>
<?php


if( $xiang['yunid'] > 0){

    /*存在运费id*/
    $KUIXQ = yunfeiid( $xiang['yunid'] );

    $JILIANGFS = $KUIXQ['type'];



    if( $KUIXQ && $KUIXQ['off'] == '0' ){

        $YUFXQ   = unserialize( $KUIXQ['data'] );    /* 快递模版详情 */
        $BAODATA = unserialize( $KUIXQ['baodata'] ); /* 快递包邮详情 */
        $KUAIZUHE = array();

     

        if( $YUFXQ ){
       
            foreach( $YUFXQ as $KUDLX => $KUDTYPE ){

                unset( $KUDTYPE['ding'] );

                $MOREN = $KUDTYPE['0'];
                unset( $KUDTYPE['0'] );

                if( $KUDTYPE ){

                    foreach( $KUDTYPE as $DIQUSX  ){

                        if( strpos( ','.$DIQUSX['diqu'].',' , ','.$YUNFEIJI.',') !== false){

                            $MOREN = $DIQUSX;
                            break;
                        }
                    }
                     
                }
            $KUAIZUHE[$KUDLX]  = $MOREN;
            }

        }

        if( $BAODATA ){

            unset( $BAODATA['ding'] );
            $biaozuhe = array();

            foreach($BAODATA as $baosju){

                $biaozuhe[$baosju['type']][] = $baosju;
            }
            foreach( $biaozuhe as $kuitype => $dezhi ){

                                    /* $kuitype 快递类型*/
                                    $morenbaoyou = $dezhi['0']; unset( $dezhi['0'] );

                                    if( $dezhi ){

                                        foreach( $dezhi as $DIQUSX  ){

                                            if( strpos( ','.$DIQUSX['diqu'].',' , ','.$YUNFEIJI.',') !== false){
                                                $morenbaoyou = $DIQUSX;
                                                break;
                                            }
                                        }
                                    }

                $BAYOMO[$kuitype] = $morenbaoyou;
            }
        }

        foreach( $KUAIZUHE  as $zzk => $zzv ){

                $xjiage  = yunjiage( $JINZHONG , $zzv );

                $miaoshu = '';

                if( isset( $BAYOMO[ $zzk]) ){

                        $baoxc = $BAYOMO[ $zzk];
                        $BAOJIAN  = (float)$baoxc['jian'];
                        $BAOJINE= (float)$baoxc['mian'];

                        if( $BAOJINE > 0 && $BAOJIAN > 0  ){

                            if( $SHANGJIN  >=  $BAOJINE &&  $JINZHONG >= $BAOJIAN )  $xjiage =  0;
                            $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 并且 满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';

                        }else if( $BAOJINE > 0  ){

                            if( $SHANGJIN  >= $BAOJINE   )  $xjiage =  0;
                            $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 包邮';

                        }else if( $BAOJIAN > 0  ){

                            if( $JINZHONG  >=  $BAOJIAN )  $xjiage =  0;
                            $miaoshu = '满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';
                        }
                
                }

                $YUNJL[$SHJIA][$JILIANGFS][$zzk] = array('cpjine'=>$SHANGJIN, 'jine' =>  $xjiage ,'miaoshu' => $miaoshu,'jinshu' => $JINZHONG  );
        }

    }





}

?>

   
            <div class="mui-card">
                <ul class="mui-table-view">

                <li class="mui-table-view-cell mui-checkbox" style="background:#fff;padding:8px 2px;height:50px;line-height:50px;">
                    <label>

                        <b style="float:left;height:30px;line-height:30px;margin-left:5px;font-weight:normal;"><span class="mui-icon mui-icon-mccyue" style="color:#007aff;"></span> 余额( <?php echo $USER['jine'];?> )支付</b>
                        
                    </label>
                        <input name="checkbox1" value="Item 3" type="checkbox" class="pay-items" >
                    </li>

                  <li class="mui-table-view-cell"><span class="mui-icon mui-icon-mcczjia" style="color:green;"></span> 总价 <p class="mui-pull-right"> <span class=" jihuobi" style="color: Red;"> <?php  echo  $HUOBIICO['0'].sprintf('%.2f',$huobi0);?> </span>
                    <span class=" jihuobi" style="color:#4cd964;"> <?php if( $huobi1  > 0) echo  $HUOBIICO['1'].$huobi1;?> </span>
                    <span class=" jihuobi" style="color:#007aff;"> <?php if( $huobi2  > 0) echo  $HUOBIICO['2'].$huobi2;?> </span>
                    </p>
                    </li>


                    <li class="mui-table-view-cell"> <span class="mui-icon mui-icon-mccyfei" style="color:#FF6600;"></span> 运费

                    <span class="mui-pull-right orange" id="method_money"  style="color:Red;"><?php echo $HUOBIICO['0']?><?php echo sprintf('%.2f',$yunfei);?></span>


                    </li>
                      <input type="hidden" class="jshuobi0 chanpinjia" value="<?php echo $huobi0;?>" title="金额"/>
                <input type="hidden" class="jshuobi1"   value="<?php echo $huobi1;?>" title="积分"/>
                <input type="hidden" class="jshuobi2"   value="<?php echo $huobi2;?>" title="货币"/>
                <input type="hidden" class="yunfeizhi"  value="<?php echo $yunfei;?>" title="运费"/>
                <input type="hidden" class="youhuijuan" value="0" title="优惠卷" />
                <input type="hidden" class="payjine"    value="0" title="最终支付金额">
                <input type="hidden" class="userjine"   value="<?php echo $USER['jine'];?>">
                <input type="hidden" class="userjifen"  value="<?php echo $USER['jifen'];?>">
                <input type="hidden" class="userhuobi"  value="<?php echo $USER['huobi'];?>">


                <?php  $huobi0+=$yunfei;?>

                    <li class="mui-table-view-cell"> <span class="mui-pull-right" id="card_money"  ><?php echo $HUOBIICO['0']?>0.00</span>
                    
                    <span class="mui-icon mui-icon-mccyhui" style="color:#9900FF;"></span> <?php echo $CONN['hongbao']?>抵扣

                     </li>


                </ul>
            </div>
 
    </div>


    <div style="position: fixed;left:0px;bottom:0px;z-index:2;background:#fff;width:100%;">

        <ul class="mui-table-view">

            <li class="mui-table-view-cell" style="height:50px;line-height:36px;">
                    总计:<span class="jihuobi0 jihuobi"><?php  echo  $HUOBIICO['0'].$huobi0;?></span>
                    <span class="jihuobi1 jihuobi"><?php if( $huobi1  > 0) echo  $HUOBIICO['1'].$huobi1;?></span>
                    <span class="jihuobi2 jihuobi"><?php if( $huobi2  > 0) echo  $HUOBIICO['2'].$huobi2;?></span>
                    <button type="button" class="mui-btn mui-btn-primary" onclick="return tijiao();">提交订单</button>
            </li>

        </ul>
    </div>
</body>
</html>
<?php include QTPL .'foot.php';?>
<script type="text/javascript">
var PAYFF    = 0;
var SHANGYUN = <?php echo json_encode( $YUNJL );?>;
var FANGSHI  = <?php echo json_encode( $yuntype );?>;
var SHANGJIA = <?php echo json_encode( $SHANGJIA );?>;
var KUAIDI   = <?php echo json_encode( $YFFS );?>;
    TOKEN    = '<?php echo  wenyiyz( 'ding/'.$USERID ,  '' , $Mem );?>';
var bixushou = '<?php echo $cunzia?1:0?>';


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

function payzhifu( payfs ){


        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'ding',d:'put',dingid:payfs,ttoken: TOKEN},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){


                if( data.token && data.token != '') TOKEN = data.token;


                mui.toast ( data.code == -1  ? '支付失败查看详情' : '支付成功'  ,{url:"<?php echo mourl( $CONN['userword']. $CONN['fenge'].'myding');?>" });

           

            },error:function(xhr){

                dataerror(xhr , '支付订单' );
            }

        });

}


function tijiao(){

    /* 提交支付 */
    lenn = $(".m-cartlist li").length;
    if( lenn == '0' ){

        mui.toast ( '没有产品'  ,{url:HTTP });

        return false;
    
    }


    hongid = $("[name=hongid]").val(); /* 红包id */
    shouid = $("#address_id")  .val(); /*收货地址id*/


    if( bixushou == 1){

        if( shouid < 1 ){

            mui.toast ( '请选择收货地址');

            return false;
        }
    }
    $ZIFU = {};

    $(".shangjiaxinxi").each( function(){
    
    
        varlu = $(this).val();
        xuan  = $(this).attr('name');
        $ZIFU[ xuan ] = varlu;

    });


    mui.ajax( HTTP + 'json.php' ,{

            data:{y:'ding',d:'delete',hongid:hongid,shouid:shouid,youfei:$ZIFU,cpid:<?php echo $CPID;?>,num:<?php echo $NUM;?>,canshu:<?php echo $CSHU;?>,ttoken: TOKEN},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                if( data.token && data.token != '') TOKEN = data.token;

                if ( data.code == 2 ){

                    xiaid  = data.data.orderid;

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
                                mui.toast ( '支付中...'  ,{url:HTTP+ "pay.php?y=pay&jine="+(-cha)+"&paytype="+payfashi+"&order="+xiaid  });
                            }

                        }else{

                            mui.toast ( '支付中...'  ,{url:HTTP+ "pay.php?y=pay&jine="+payjine+"&paytype="+payfashi+"&order="+xiaid+"&cha=13"  });

                        }


                    }
                }

           

            },error:function(xhr){

                dataerror(xhr , '提交订单' );
            }

        });




   

}



function suanyunfei(){

    yunfe = 0;

    $(".shangjiaxinxi").each(function(){

        yun = $(this).find("option:checked").attr('data') * 1;
        yunfe += yun;

    });


  

    $(".yunfeizhi"   ).val ( yunfe );
    $("#method_money").html( $HUOBIICO['0'] + ( yunfe.toFixed(2) ) );

    /* 产品金额 */
    chanpinjia  =   $(".chanpinjia").val() * 1;

    /* 优惠金额 */
    youhuijuan  =   $(".youhuijuan").val() * 1;

    $jinbi = yunfe + chanpinjia - youhuijuan;
    if( $jinbi <= 0) $jinbi = 0;
    
    $jinbi = $jinbi;


    $(".payjine").val( $jinbi );
    $(".jihuobi0").html( $HUOBIICO['0'] +$jinbi );

}


function zuheyunfei( SHANGYUN ){

    if( SHANGYUN ){


        for(var di in SHANGYUN ){

            html = '<li><div class="m-order-item">'+SHANGJIA[di]+'<br />';

                yunfei = SHANGYUN[di];

                for( var dd in yunfei ){

                    html+= FANGSHI[dd] +' 运费 <select class="shangjiaxinxi mui-btn mui-btn-block" name="'+di+'-'+dd+'" >';
                    kuaidi = yunfei[dd];

                    for(var ddd in kuaidi){
                        html+='<option value="'+ddd+'" data="'+kuaidi[ddd].jine+'">'+KUAIDI[ddd]+ ' ' +kuaidi[ddd].jine + ' '+HUOBI[0]+' '+ kuaidi[ddd].miaoshu+'</option>';
                    }
                    html+='</select><br />';
                }

            $("#shangjia"+di).html( html+"</div></li>" );
        }
    }
}


zuheyunfei( SHANGYUN );
suanyunfei();

$(function(){

    $(".shangjiaxinxi").change(function(){

        suanyunfei();
    });

    $("[name=hongid]").change(function(){
    
        var woq = $(this).val();
        var danjia = $('.chanpinjia').val() * 1 + $(".yunfeizhi").val() * 1;

        if( woq > 0){ 

            var data;

            $(this).find("option").not(function(){ 

                if( this.selected ){
           
                    data =   $(this).attr('data') * 1;
                }
           
            });

        var tidjin;

            if( danjia  >= data  ){

                $(this).find("option").not(function(){ 

                    if(this.selected){

                        tidjin =   $(this).attr('youhui') * 1;
                    }
                });


                if(tidjin > danjia) tidjin = danjia;

                $("#card_money").html($HUOBIICO['0'] + tidjin);
                $(".youhuijuan").val(tidjin);

                var num = danjia - tidjin;
                if(num < 1)num = 0;

                num = num.toFixed(2);

                $(".payjine").val( num );

                $(".jihuobi0").html( $HUOBIICO['0'] +  num );


     

            }else{  

                   $("#card_money").html($HUOBIICO['0'] + '0');
                   $(".youhuijuan").val(0);
                   $(this).val('0');
                   $(".jihuobi0").html( $HUOBIICO['0'] +  danjia );
                   $(".payjine").val( danjia );
                   mui.toast ( "满"+$HUOBIICO['0']+ data + " 才可用" );
  

               }

        }else{

                $("#card_money").html($HUOBIICO['0'] + '0');
                $(".youhuijuan").val(0);
                $(this).val('0');
                $(".payjine").val( danjia );
                $(".jihuobi0").html( $HUOBIICO['0'] +  danjia );
        }
        
    });


});
</script>
