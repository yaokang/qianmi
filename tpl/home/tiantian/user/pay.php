<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';

//chongzhifan(  orderid() , 20 , '20161102141450386050' );
?>
<style>
.pay-item{cursor:pointer;}
.vals{padding:20px 0 0 10px;}
.vals li {
    padding:6px 3px;
    font-size: 1rem;
    color: #aaa;
    border: solid 1px #aaa;
    box-sizing: border-box;
   
   
    width: 25%;
    overflow: hidden;
    text-align: center;
    margin:8px;
    cursor: pointer;
    border-radius: .2rem;
    float:left;
}
.vals li.selected {
    border-color: #ff4c42;
    color: #ff4c42;
}

.vals li input{float:left;}
</style>
  <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
          <span class="navbar-title">充值</span>
        </div>
      </div>
    </nav>
    <section class="m-component-order" id="m-order">
        <div class="container m-ordersuc">
            
            <div class="m-order-item">
                <div class="recharge-vals">
        <div class="recharge-title">请选择充值金额（元）</div>
        
                      <input type="hidden" name="zhifue" value="5">

        <ul class="vals layout-box">
                  
                               
            <li class="box-col selected" data="5">5</li>
                      
                               
            <li class="box-col " data="10">10</li>
                      
                               
            <li class="box-col " data="20">20</li>
                      
                               
            <li class="box-col " data="100">100</li>
             
                               
            <li class="box-col " data="200">200</li>
             
            <li class="box-col recharge-li">
               <input type="text" class="w-input-input" style="width:88px;border:0px;" placeholder="其他金额" pattern="[0-9]*">
            </li>

          
        </ul>
        <div style="clear:both;"></div>

    </div>
            </div>
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

                   

                </ul>
            </div>

            <div class="m-ordersuc-paybtn">
              <button type="button" class="btn btn-warning btn-block" id="paypay">立即支付</button>
            </div>
            
        </div>    
    </section>



<?php

    $_SESSION['paydd'] = time();
    include QTPL.'foot.php';

?>
<script type="text/javascript">
var ZUIJINE = '<?php echo (float) $CONN['payjine'];?>';
$( function(){

    $(".pay-item").click(function(){

        $(".fdayicon-pay").hide();
        data = $( this ).attr( 'data' );
        $( "[name=paytype]" ).val( data );
        $( this ).find('.fdayicon-pay').show();

    });

    $(".vals li").click(function(){

        jine = $(this).attr('data');

         $("[name=zhifue]") .val(jine);

        $(".vals li").removeClass('selected');



        $(this) . addClass('selected');

    });

    $(".w-input-input").change( function(){ 

        var shuliang = $( this ).val() * 1;
        if( shuliang < ZUIJINE) shuliang = ZUIJINE;
        if( isNaN( shuliang ) ) shuliang = ZUIJINE;
        $(this).val( shuliang );
        $("[name=zhifue]").val(shuliang);

    });

    $("#paypay").click( function(){

        var jine    = $("[name=zhifue]") .val();
        var paytype = $("[name=paytype]").val();
        window.location.href= ( HTTP +'pay.php?y=pay&jine='+ jine + '&paytype='+ paytype );

    });



});
</script>
