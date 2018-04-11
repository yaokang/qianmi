<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';

$FAOFF   = logac('faoff');
$ORDERID = isset( $HTTP['2'] ) ? $HTTP['2'] : '';
$KUOMO   = isset( $HTTP['3'] ) ? $HTTP['3'] : 'cha';

 $FAOFF = logac('faoff');
$PAYOFF = logac('payoff');

$PAYTYPE = xitongpay('-1');

if( $ORDERID == '' ) msgbox( '' , mourl( $CONN['userword'] ) );
$D = db('dingdan');


    $DATA = $D ->where( array( 'orderid' => $ORDERID) )-> find();


if( ! $DATA || $DATA['uid'] != $USERID ) msgbox( '' , mourl( $CONN['userword'] ) );

$PAYTYPE['0'] = '余额支付';
?>

    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo mourl( $CONN['userword']);?>"><span class="glyphicon fdayicon fdayicon-navback"></span></a>      
          <a class="navbar-func pull-right" href="<?php echo $LANG['dingdanlx'];?>"><span class="glyphicon fdayicon  fdayicon-contact"></span></a>     
          <span class="navbar-title">订单详情</span>
        </div>
      </div>
    </nav>

    <section class="m-component-order" id="m-order">
        <ul class="list-unstyled m-order-content m-orderdetail">

            <li id="order-status-li">
                <div class="m-order-item">
                    <span class="pull-right m-ordering"><?php echo $PAYOFF[$DATA['off']]?></span>订单编号 <?php echo $DATA['orderid'];?>
                </div>
                <div class="m-order-item">
                    下单时间 <?php echo date( $CONN['timegeshi'] , $DATA['atime']);?>
                </div>
            </li>

            <li>
                <div class="m-order-item">
                    <span class="pull-right"><?php echo $PAYTYPE[$DATA['paytype']];?></span>支付方式
                </div>
            </li>
       
            <li>
                <div class="m-order-item">
                    <span class="pull-right orange"> <?php echo $HUOBIICO['0'].' '.$DATA['payjine'];?> </span>支付总价
                </div>

            </li>

            <?php 

            if( $DATA['tongyiid'] != '' && $DATA['type'] == 2){
            ?>

            <li>
               <div class="m-order-item">
                    <div class="clearfix m-order-prolist-tips"><span class="glyphicon fdayicon fdayicon-unfold pull-right" id="m-order-prolist"></span>商品清单</div>
                    <div class="m-cartlist">
                        <ul class="list-unstyled">

                        <?php
                        
                         

                            $shuj = $D ->where( array('tongyiid' => $DATA['tongyiid'] ,'type' => 0 ))-> select();


                            if( ! $shuj ) $shuj = array();
                               $D -> setbiao( 'dingdanx' );

                           

                            foreach( $shuj as $woqud ){ 

                            $XQING = $D ->where( array('orderid' => $woqud['orderid'] ))->select();

                            $FAHUODE = array();

                            if( $XQING ){

                              


                                foreach( $XQING as $ONG ){

                                    $token = md5( $ONG['biaoshi'].'_'. $ONG['beizhu'] );

                                    if( ! isset( $FAHUODE[ $token ] )) $FAHUODE[ $token ] = $ONG['biaoshi'].' '. $ONG['beizhu'];
                        
                        ?>  <li>
                                                                <a href="<?php echo WZHOST.'api.php?action=tiao&id='.$ONG['cpid']?>">
                                                                    <img class="lazy pull-left" data-original="<?php echo pichttp( $ONG['tupian'] );?>" src="/images/DefaultImg@2x.png" alt="">
                                    <div class="m-cartlist-info">
                                        <h3><?php echo $ONG['name']?></h3>
                                        
                                        <?php if( $ONG['canshu'] != ''){ ?>
                                        <h4>规格：<?php echo str_replace( '_',' ', $ONG['canshu'] ) ;?></h4>
                                        <?php } ?>

                                        <h5><?php echo $HUOBIICO[$ONG['huobi']].$ONG['jine']?></h5>
                                    </div>
                                </a>
                                <span class="m-cartlist-nums">x <?php echo $ONG['num']?></span>
                            </li>
                        <?php } } } ?>

                        </ul>
                    </div>
                </div>
            </li>


            <?php } ?>

            <?php if( $DATA['off'] == 2){ ?>
      
            <li>
                <div class="m-order-item">
                   <span class="pull-right orange"> <?php echo $HUOBIICO['0'].' '.($DATA['rejine']);?> </span>实际支付
                </div>
            </li>

             <li >
              
                <div class="m-order-item">
                    支付时间 <?php echo date( $CONN['timegeshi'] , $DATA['xtime']);?>
                </div>
            </li>

             <?php } ?>


            


           







        </ul>
    </section>




        

                        

                               

                     

  
<?php include QTPL .'foot.php';?>
<script type="text/javascript">
var PAYFF    = 0;
var xiaid = '<?php echo $DATA['orderid'];?>';
 TOKEN    = '<?php echo  wenyiyz( 'ding/'.$USERID ,  '' , $Mem );?>';


function shouhuo(){
    

    $.post( HTTP + "json.php",{y:'ding',d:'put',dingid:xiaid,ttoken: TOKEN,lx:2}, function( data ) {

        if( data.token && data.token != '') TOKEN = data.token;

        if( data.code == -1 ){

            MessageBox.errorFadeout('收货失败',1000);

        }else if(data.code == 1){

            MessageBox.show('收货成功',1000,"<?php echo mourl( $CONN['userword'] , '' ,  $CONN['fenge'].'chading'.$CONN['fenge'] );?>"+xiaid+".html");

        }

    }).error(function( data ){
        
            dataerror( data ,'收货');
    
    });


}

function payzhifu( payfs ){

    
    $.post( HTTP + "json.php",{y:'ding',d:'put',dingid:payfs,ttoken: TOKEN,paylx:2}, function( data ) {

        if( data.token && data.token != '') TOKEN = data.token;

        if( data.code == -1 ){

            MessageBox.errorFadeout('支付失败查看详情',1000,"<?php echo mourl( $CONN['userword'] , '' ,  $CONN['fenge'].'chading'.$CONN['fenge'] );?>"+payfs+".html");

        }else if(data.code == 1){

            MessageBox.show('支付成功',1000,"<?php echo mourl( $CONN['userword'] , '' ,  $CONN['fenge'].'chading'.$CONN['fenge'] );?>"+payfs+".html");

        }

    }).error(function( data ){
        
            dataerror( data ,'支付订单');
    
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
                    MessageBox.loading(HTTP+ "pay.php?y=pay&jine="+(-cha)+"&paytype="+payfashi+"&paylx=2&order="+xiaid);
                }

            }else{

                MessageBox.loading(HTTP+ "pay.php?y=pay&jine="+payjine+"&paytype="+payfashi+"&order="+xiaid+"&paylx=2");

            }
        }
}


$(function(){

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
 
 
 });
</script>