<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');

$PAGE = 1;
include QTPL .'head.php';
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
<style>
.geweiyidd li{overflow:hidden;}
.jihuobi{margin:0px 5px;}
</style>
    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header text-center clearfix">
              <a class="navbar-func pull-left" href="<?php echo $xiang['link'];?>"><span class="glyphicon fdayicon fdayicon-navback"></span></a>
              <span class="navbar-title">订单确认</span>
            </div>
        </div>
    </nav>

    <section class="m-component-order" id="m-order">
        <ul class="list-unstyled m-order-content">
        <?php  $SHOUHUO = $D ->setbiao('shouhuo')-> where( array( 'uid' => $USERID )) ->order('off desc,id desc') -> find(); ?>
            <li>
                <div class="m-order-item">

                <?php if( !$SHOUHUO  ){?>
                    <input type="hidden" id="address_id" value="0" />
                    <input type="hidden" class="jisuandiqu" value="0" />
                    <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'list');?>" class="m-order-address">
                                                    <span class="pull-right">请选择</span>送货地址
                    </a>
                <?php }else{ ?>

                    <div class="m-order-item">
                        <input type="hidden" id="address_id" value="<?php echo $SHOUHUO['id']?>" />
                        <input type="hidden" class="jisuandiqu" value="<?php echo $YUNFEIJI = jisuandiqu(  $SHOUHUO['diqu'] );?>" />

                        <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'list');?>" class="m-order-address">
                            <?php echo $SHOUHUO['xingming'].' '.$SHOUHUO['shouji'];?>
                            <?php if( $SHOUHUO['zuoji'] != '' ){ ?>
                                <span class="orange">[ <?php echo $SHOUHUO['zuoji'];?> ]</span>
                            <?php } ?>
                            <p><?php echo $SHOUHUO['beizhu'];?></p>
                        </a>
                    </div>

                <?php } ?>
                </div>
            </li>


            <li>
                
                <div class="m-order-item">
                <?php 

                $hongbao = hongbao( $USERID );
                $x = '<option value="0"> （暂无可用'.$CONN['hongbao'].'） </option>';

                if( $hongbao ){

                    $x = '<option value="0"> （选择你的'.$CONN['hongbao'].'） </option>';

                    foreach( $hongbao as $xiangq ){

                        $x .= '<option value="'.$xiangq['id'].'" data="'.$xiangq['dayukeyong'].'" youhui="'.$xiangq['shengyujine'].'"> （'.$CONN['hongbao'].' 抵扣 ：&nbsp;&#165;&nbsp;'.$xiangq['shengyujine'].' 满 '.$xiangq['dayukeyong'].' 可用） </option>';

                    }
                }
                
                ?>
                <select name="hongid" class="w-select" style="margin-left: 8px;width: 98%;height:30px;line-height:30px;border-width:0px;display:block;border-style:none;"> <?php echo $x;?> </select>
                </div>
                
            </li>

            
            <li>
                <div class="m-order-item">
                    <div class="clearfix m-order-prolist-tips"><span class="glyphicon fdayicon fdayicon-unfold pull-right" id="m-order-prolist"></span>商品清单</div>
                    <div class="m-cartlist">
                        <ul class="list-unstyled">

   

                    <li><!--<?php echo $xiang['link']?> -->
                        <a href="javascript:void(0);">
                            <img class="lazy pull-left" data-original="<?php echo $xiang['tupian']?>" alt="" src="/images/DefaultImg@2x.png" style="display: block;">
                            <div class="m-cartlist-info">
                                <h3><?php echo $xiang['name']?></h3>
                                <h4><?php echo str_replace( '_',' ',$CSU );?> </h4>
                                <h5><?php echo $HUOBIICO[$xiang['huobi']]?>  <?php echo $jiage;?> </h5>
                            </div>
                        </a>
                        <span class="m-cartlist-nums">x <?php echo $xiang['num'];?></span>
                    </li>  

                        </ul>
                    </div>
                </div>
            </li>


             <li>
             <div class="m-payment-content " id="payment_content">
              
                <!-- 支付方式-->
                <ul class="list-unstyled m-payment-list">

                <?php 
                $woqu = xitongpay( '0' );
                $x    = '';

                if( $woqu ){

                    $z = 0;
                    echo '<input type="hidden" name="paytype" value="'.$woqu['0']['id'].'">';
                    foreach( $woqu as $ong ){ ?>

                    <li class="pay-item" data="<?php echo $ong['id']?>">
                         <div class="m-payment-item">
                             <label for="pay1">
                                 <img src="<?php echo pichttp($ong['suoluetu']);?>" style="height:20px;margin-right:16px;"/><?php echo $ong['name']?>
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay" <?php echo $z=='0'?' style="display:block;"':''?>></span>
                         </div>
                    </li>

                <?php $z++;
                        }
                    }
                ?>


                
            <li class="pay-items" data="<?php echo $ong['id']?>">
                         <div class="m-payment-item">
                             <label for="pay1">
                                 <img src="<?php echo pichttp($ong['suoluetu']);?>" style="height:20px;margin-right:16px;"/>余额( <?php echo $USER['jine'];?> )支付 
                                 <p class="activity"></p>                             </label>
                             <span class="glyphicon fdayicon fdayicon-pay" <?php echo $z=='0'?' style="display:block;"':''?>></span>
                         </div>
            </li>

            <div class="shangjiande"  id="shangjia<?php echo $SHJIA;?>"></div>

               


                   

                </ul>
            </div>
             </li>

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


            <li>
                <div class="m-order-item">
                    <span class=" jihuobi pull-right orange"> <?php if( $huobi0  > 0) echo  $HUOBIICO['0'].$huobi0;?> </span>
                    <span class=" jihuobi pull-right"> <?php if( $huobi1  > 0) echo  $HUOBIICO['1'].$huobi1;?> </span>
                    <span class=" jihuobi pull-right orange"> <?php if( $huobi2  > 0) echo  $HUOBIICO['2'].$huobi2;?> </span>
                商品总价
                </div>
              
                <div class="m-order-item">
                    <span class="pull-right orange" id="method_money" money="0.00">￥<?php echo $yunfei;?></span>运费
                </div>
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
                
                <div class="m-order-item">
                    <span class="pull-right" id="card_money" money="0.00">￥0.00</span><?php echo $CONN['hongbao']?>抵扣
                </div>
                
            </li>
        </ul>
    </section>

<nav class="navbar navbar-default navbar-fixed-bottom m-component-foot" role="navigation">
  <div class="container">
    <div class="navbar-text navbar-left pull-left" id="order_money">

        <span class="jihuobi0 jihuobi"><?php if( $huobi0  > 0) echo  $HUOBIICO['0'].$huobi0;?></span>
        <span class="jihuobi1 jihuobi"><?php if( $huobi1  > 0) echo  $HUOBIICO['1'].$huobi1;?></span>
        <span class="jihuobi2 jihuobi"><?php if( $huobi2  > 0) echo  $HUOBIICO['2'].$huobi2;?></span>

    </div> 
    <button type="button" class="btn btn-warning navbar-btn pull-right" id="order-submit" onclick="return tijiao();">提交订单</button>
  </div>
</nav>

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

    $(".pay-items .fdayicon-pay").hide();

    if( PAYFF == '0'){

        if( $(".userjine").val()*1 > 0 ){ 
            
            PAYFF = 1;
            $( this ).find('.fdayicon-pay').show();

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

    
    $.post( HTTP + "json.php",{y:'ding',d:'put',dingid:payfs,ttoken: TOKEN}, function( data ) {

        if( data.token && data.token != '') TOKEN = data.token;

        if( data.code == -1 ){

            MessageBox.errorFadeout('支付失败查看详情',1000,"<?php echo mourl( $CONN['userword']. $CONN['fenge'].'myding');?>");

        }else if(data.code == 1){

            MessageBox.show('支付成功',1000,"<?php echo mourl( $CONN['userword']. $CONN['fenge'].'myding');?>");

        }

    }).error(function( data ){
        
            dataerror( data ,'支付订单');
    
    });



}


function tijiao(){

    /* 提交支付 */
    lenn = $(".m-cartlist li").length;
    if( lenn == '0' ){

        MessageBox.errorFadeout('没有产品',500,HTTP);
        return false;
    
    }


    hongid = $("[name=hongid]").val(); /* 红包id */
    shouid = $("#address_id")  .val(); /*收货地址id*/


    if( bixushou == 1){

        if( shouid < 1 ){

            MessageBox.errorFadeout('请选择收货地址',500);
            return false;
        }
    }
    $ZIFU = {};

    $(".shangjiaxinxi").each( function(){
    
    
        varlu = $(this).val();
        xuan  = $(this).attr('name');
        $ZIFU[ xuan ] = varlu;

    });

    $.post(HTTP + "json.php",{y:'ding',d:'delete',hongid:hongid,shouid:shouid,youfei:$ZIFU,cpid:<?php echo $CPID;?>,num:<?php echo $NUM;?>,canshu:<?php echo $CSHU;?>,ttoken: TOKEN}, function( data ) {

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

                        MessageBox.loading(HTTP+ "pay.php?y=pay&jine="+(-cha)+"&paytype="+payfashi+"&order="+xiaid);

                    }


                }else{

                    MessageBox.loading(HTTP+ "pay.php?y=pay&jine="+payjine+"&paytype="+payfashi+"&order="+xiaid+"&cha=13");

                }


            }
        }

     
        }).error(function( data ){
        
            dataerror( data ,'提交订单');
    
    });




   

}



function suanyunfei(){

    yunfe = 0;

    $(".shangjiaxinxi").each(function(){

        yun = $(this).find("option:checked").attr('data') * 1;
        yunfe += yun;

    });

    $(".yunfeizhi"   ).val ( yunfe );
    $("#method_money").html( $HUOBIICO['0'] + yunfe );

    /* 产品金额 */
    chanpinjia  =   $(".chanpinjia").val() * 1;

    /* 优惠金额 */
    youhuijuan  =   $(".youhuijuan").val() * 1;

    $jinbi = yunfe + chanpinjia - youhuijuan;
    if( $jinbi <= 0) $jinbi = 0; 
    $(".payjine").val( $jinbi );
    $(".jihuobi0").html( $HUOBIICO['0'] +$jinbi );

}


function zuheyunfei( SHANGYUN ){

    if( SHANGYUN ){


        for(var di in SHANGYUN ){

            html = '<li><div class="m-order-item">'+SHANGJIA[di]+'<br />';

                yunfei = SHANGYUN[di];

                for( var dd in yunfei ){

                    html+= FANGSHI[dd] +' 运费 <select class="shangjiaxinxi w-select" name="'+di+'-'+dd+'" style="margin-left: 8px;width: 98%;height:30px;line-height:30px;border-width:0px;display:block;margin-top:5px;border-style:none;">';
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

                   $(".payjine").val( num );

                $(".jihuobi0").html( $HUOBIICO['0'] +  num );


     

            }else{  

                   $("#card_money").html($HUOBIICO['0'] + '0');
                   $(".youhuijuan").val(0);
                   $(this).val('0');
                   $(".jihuobi0").html( $HUOBIICO['0'] +  danjia );
                   $(".payjine").val( danjia );
                   MessageBox.errorFadeout( "满"+$HUOBIICO['0']+ data + " 才可用" ,500);

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
