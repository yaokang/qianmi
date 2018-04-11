<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;

include QTPL .'head.php';
$yuntype = logac('yuntype');
$YFFS = logac('yunfs');
$_SESSION['paydd'] = time();

$GWC  = $Mem -> g( 'gouwuche/'. $USERID );
if( ! is_array( $GWC ) ) $GWC = array();

$_SESSION['shangyibu'] = mourl($URI);
$YUNFEIJI  = $yunfei = $huobi0 = $huobi1 = $huobi2  = 0;

/* $YUNFEIJI  默认收货地区 */
$ZONGLIANG = $BAOCAN =  $YUNJL = array();
$SHANGJIA = array('0' => '官方','2' => '骏飞商家',);

//fahongbao('',$USERID,20);
$cunzia = false;
/*
// 包邮方式
商户0  计量方式   运费方式  ( 存在就是包邮 )
商户0  计量方式   运费方式
*/

?>
<style>
.geweiyidd li{overflow:hidden;}
.jihuobi{margin:0px 5px;}
</style>
    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header text-center clearfix">
              <a class="navbar-func pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>"><span class="glyphicon fdayicon fdayicon-navback"></span></a>
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


<?php if( $GWC ){ 

   
        foreach( $GWC as  $k => $gou){

            if( is_array( $gou ) ){ 

                $SHANGJIN = 0;

                $KUAI = array();

                foreach($gou as $kv => $xiang){

                    if( ! $cunzia && $xiang['type'] == '0' ) $cunzia  = true;

                    $zji = $xiang['num'] * $xiang['jiage'];

                    if( $xiang['yunid'] > 0){

                        if( ! isset( $KUAI[$xiang['yunid']] ) )  $KUAI[$xiang['yunid']]  = $xiang['num']*$xiang['jinzhong'];
                        else                                     $KUAI[$xiang['yunid']] += $xiang['num']*$xiang['jinzhong'];
                    }
                    ?>
                    <li><!--<?php echo $xiang['link']?> -->
                        <a href="javascript:void(0);">
                            <img class="lazy pull-left" data-original="<?php echo $xiang['tupian']?>" alt="" src="/images/DefaultImg@2x.png" style="display: block;">
                            <div class="m-cartlist-info">
                                <h3><?php echo $xiang['name']?></h3>
                                <h4><?php echo str_replace( '_',' ',$xiang['canshu'] );?> </h4>
                                <h5><?php echo $HUOBIICO[$xiang['huobi']]?>  <?php echo $xiang['jiage'];?> </h5>
                            </div>
                        </a>
                        <span class="m-cartlist-nums">x <?php echo $xiang['num'];?></span>
                    </li>  
                    <?php
                        if( $xiang['huobi'] == '0'){

                            $huobi0   += $zji;  /*货币金额*/
                            $SHANGJIN += $zji;  /*总金额*/

                        }else if( $xiang['huobi'] == '1')
                            $huobi1  += $zji;
                        else if( $xiang['huobi'] == '2')
                            $huobi2  += $zji;
                }

                echo '<div class="shangjiande"  id="shangjia'.$k.'"></div>';

                /*  
                    $k 商家id 
                    $KUAI 同一商家快递id
                */

                $BAYOMO =  $ZUHEMO = array();  /* 包邮参数组合  选择地区组合运费模版 */
                $liang  = 0;

                if( $KUAI ){

                    /* 商家快递总量 */
                    foreach( $KUAI as $KUID => $KUNUM ){
                        /*
                        $KUID   快递id
                        $KUNUM  快递数量
                        off     等于1 包邮
                        */
                        $KUIXQ = yunfeiid( $KUID );

                        if( $KUIXQ && $KUIXQ['off'] == '0' ){

                            $YUFXQ   = unserialize( $KUIXQ['data'] );    /* 快递模版详情 */
                            $BAODATA = unserialize( $KUIXQ['baodata'] ); /* 快递包邮详情 */

                            if( $YUFXQ ){

                                $KUAIZUHE = array();

                                /* $KUDLX   快递类型 EMS 平邮 包邮
                                   $KUDTYPE 快递类型详情
                                */

                                foreach( $YUFXQ as $KUDLX => $KUDTYPE ){

                                    unset( $KUDTYPE['ding'] );
                                    /* 给与默认运费方式*/
                                    $MOREN = $KUDTYPE['0'];
                                    unset( $KUDTYPE['0'] );

                                    /* 还有其他*/
                                    if( $KUDTYPE ){
                                        /*  $DIQUSX 订单筛选  */
                                        foreach( $KUDTYPE as $DIQUSX  ){

                                            if( strpos( ','.$DIQUSX['diqu'].',' , ','.$YUNFEIJI.',') !== false){
                                                $MOREN = $DIQUSX;
                                                break;
                                            }
                                        }
                                    }
                                    /*给出快递方式 默认价格*/
                                    $KUAIZUHE[$KUDLX]  = $MOREN;
                                }

                                /* 给出计件方式 的快递数据 */
                                $ZUHEMO[$KUIXQ['type']][$KUID] = $KUAIZUHE;
                            }



                            if( $BAODATA ){

                                /* 包邮标识  $KUID  */
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

                                    $BAYOMO[$KUIXQ['type']][$KUID][$kuitype] = $morenbaoyou;
                                }

                            }
                        }
                    }


                    /*
                        $ZUHEMO  0 计量方式 快递id 快递方式
                        $BAYOMO
                    */

                    foreach( $ZUHEMO as $SHJIA => $ZFANS ){

                        /* 同一个计量方式 */
                        if( count($ZFANS) > 1 ){

                            /* 多个计量方式*/
                            $kecuzna = array();

                            /* $ZFANS 快递信息*/
                            foreach($ZFANS as $zzk => $zzv){

                                foreach($zzv as $ttkk => $ttvv){

                                    if( isset($kecuzna[ $ttkk ])) $kecuzna[ $ttkk ]+=1;
                                    else $kecuzna[ $ttkk ] = 1;
                                }
                            }

                            $xuanzhongke = array();

                            foreach( $kecuzna  as $tk => $tv){

                                if( $tv > 1 ) $xuanzhongke[] = $tk;
                            }

                            /* 多个运费 */

                            if( $xuanzhongke ){

                                $liang  = 0;
                                $zongji = array();

                                foreach( $xuanzhongke as $vvvv ){
                                    $liang  = 0 ;

                                    foreach($ZFANS as $zzk => $zzv){

                                        $liang += $KUAI[$zzk];

                                        if( isset( $zzv[$vvvv] ) ) $ttvv = $zzv[$vvvv];
                                        else continue;

                                        $miaoshu = '';
                                        $xjiage  = yunjiage( $liang , $ttvv );

                                        if( ! isset( $zongji[$vvvv] ) ){

                                            $zongji[$vvvv] =array('cpjine'=>$SHANGJIN, 'jine' =>  $xjiage ,'miaoshu' => $miaoshu,'jinshu' => $liang  );
                                       
                                        }else if( $zongji[$vvvv] < $xjiage ){

                                            $zongji[$vvvv] = array( 'cpjine'=>$SHANGJIN,'jine' =>  $xjiage ,'miaoshu' => $miaoshu,'jinshu' => $liang  );
                                        }

                                        /* 可以包邮处理 */

                                        if( isset( $BAYOMO[$SHJIA][$zzk][$vvvv] ) ){

                                            $baoxc   = $BAYOMO[$SHJIA][$zzk][$vvvv];
                                            $BAOJIAN = (float) $baoxc['jian'];
                                            $BAOJINE = (float) $baoxc['mian'];

                                            if( $BAOJINE > 0 && $BAOJIAN > 0  ){

                                                if( $SHANGJIN  >=  $BAOJINE &&  $liang >= $BAOJIAN ) $xjiage =  0;
                                                $miaoshu = '滿'.$BAOJINE.$CONN['jine'].'并且 满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';

                                            }else if( $BAOJINE > 0  ){

                                                if( $SHANGJIN  >= $BAOJINE   ) $xjiage =  0;
                                                $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 包邮';

                                            }else if( $BAOJIAN > 0  ){

                                                if( $liang  >=  $BAOJIAN ) $xjiage =  0;
                                                $miaoshu = '满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';
                                            }

                                            $zongji[$vvvv] =  array('cpjine'=>$SHANGJIN, 'jine' =>  $xjiage ,'miaoshu' => $miaoshu,'jinshu' => $liang  );
                                        }
                                    }
                                }


                                if( $zongji ){

                                    foreach( $zongji as $kx1k => $jiage ){

                                        $YUNJL[ $k ][ $SHJIA ][ $kx1k ] = $jiage;
                                    }
                                }



                            }else{

                                foreach($ZFANS as $zzk => $zzv){

                                    $liang = $KUAI[$zzk];

                                    foreach($zzv as $ttkk => $ttvv){

                                        $xjiage  = yunjiage( $liang , $ttvv );
                                        $miaoshu = '';

                                        if( isset( $BAYOMO[ $k][ $SHJIA][ $ttkk] )){

                                            $baoxc = $BAYOMO[$k][$SHJIA][$ttkk];
                                            $BAOJIAN  = (float)$baoxc['jian'];
                                            $BAOJINE= (float)$baoxc['mian'];

                                            if( $BAOJINE > 0 && $BAOJIAN > 0  ){

                                                if( $SHANGJIN  >=  $BAOJINE &&  $liang >= $BAOJIAN )  $xjiage =  0;
                                                $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 并且 满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';

                                            }else if( $BAOJINE > 0  ){

                                                if( $SHANGJIN  >= $BAOJINE   )  $xjiage =  0;
                                                $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 包邮';

                                            }else if( $BAOJIAN > 0  ){

                                                if( $liang  >=  $BAOJIAN )  $xjiage =  0;
                                                $miaoshu = '满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';
                                            }
                                        }

                                        $YUNJL[$k][$SHJIA][$ttkk] = array('cpjine'=>$SHANGJIN, 'jine' =>  $xjiage ,'miaoshu' => $miaoshu,'jinshu' => $liang  );
                                    }
                                }

                            }


                        }else{

                            /* 独立运费*/;
                            foreach( $ZFANS as $zzk => $zzv ){

                                $liang = $KUAI[$zzk];
                                foreach( $zzv as $ttkk => $ttvv ){

                                    $miaoshu = '';
                                    $xjiage = yunjiage( $liang , $ttvv );

                                    if( isset( $BAYOMO[$SHJIA][$zzk][$ttkk] )){

                                        $baoxc = $BAYOMO[$SHJIA][$zzk][$ttkk];

                                        $BAOJIAN  = (float)$baoxc['jian'];
                                        $BAOJINE  = (float)$baoxc['mian'];

                                        if( $BAOJINE > 0 && $BAOJIAN > 0  ){

                                            if( $SHANGJIN  >=  $BAOJINE &&  $liang >= $BAOJIAN )  $xjiage =  0;
                                            $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 并且 满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';

                                        }else if( $BAOJINE > 0  ){

                                            if( $SHANGJIN  >= $BAOJINE   )  $xjiage =  0;
                                            $miaoshu = '滿'.$BAOJINE.$CONN['jine'].' 包邮';

                                        }else if( $BAOJIAN > 0  ){

                                            if( $liang  >=  $BAOJIAN )  $xjiage =  0;
                                            $miaoshu = '满'.$BAOJIAN.$yuntype[$SHJIA].' 包邮';
                                        }

                                    }

                                    $YUNJL[$k][$SHJIA][$ttkk] = array( 'cpjine'=>$SHANGJIN,'jine' =>  $xjiage ,'miaoshu' => $miaoshu,'jinshu' => $liang  );

                                }
                            }
                        }

                    }

                }
            }
        }



}else{  ?>

    <div class="text-center"><span class="glyphicon fdayicon fdayicon-procart"></span><h4>您的购物车现在是空的噢~</h4><h5>现在就去选购吧</h5><a href="<?php echo WZHOST;?>" class="btn btn-warning navbar-btn">去逛逛</a></div>

<?php } ?>


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

               


                   

                </ul>
            </div>
             </li>




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

    $.post(HTTP + "json.php",{y:'ding',d:'post',hongid:hongid,shouid:shouid,youfei:$ZIFU,ttoken: TOKEN}, function( data ) {

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
