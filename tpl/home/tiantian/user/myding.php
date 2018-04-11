<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
$NUM  = 8;
include QTPL .'head.php';
$FAOFF = logac('faoff');
$PAYOFF = logac('payoff');

$limit = listmit( $NUM , $PAGE);
$D = db('dingdan');
dingguoqi( $USERID );

?>

    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>      
          <a class="navbar-func pull-right" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart');?>"><span class="glyphicon fdayicon fdayicon-cart"></span></a>     
          <span class="navbar-title">我的果园</span>
        </div>
      </div>
    </nav>

    <section class="m-component-user" id="m-user">
      <div class="m-userorder-tab">

        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#undone" role="tab" data-toggle="tab" onclick="switchOrder(1);">未完成</a></li>
          <li role="presentation"><a href="#done" role="tab" data-toggle="tab" onclick="switchOrder(2);">已完成</a></li>
          <li role="presentation"><a href="#cancal" role="tab" data-toggle="tab" onclick="switchOrder(3);">已取消</a></li>
        </ul>
        <div class="tab-content">
          <!-- 未完成订单 -->
            <div role="tabpanel" class="tab-pane fade in active m-user-order lixingin1" id="undone">
                                      <div class="m-cartlist">
                  <ul class="list-unstyled">

                    <?php 


                    $DATA = $D ->where( array( 'uid' => $USERID , 'type' => 0 , 'off !=' => 3, 'faoff !=' => 8 ) ) -> limit( $limit ) ->order('id desc')-> select();

                    if( !$DATA ) $DATA = array();

                    $D ->  setbiao('dingdanx');
                    
                    foreach( $DATA as $ONG){

                        $danxing = $D ->where( array( 'orderid'=> $ONG['orderid'])) ->order('id asc')-> find();
                        if( ! $danxing ) $danxing = array();
                    ?>


                    <li>
                        <div class="m-orderinfo"><span class="pull-right m-ordering">
                        <?php if($ONG['off'] == 2) echo $FAOFF[ $ONG['faoff']];else echo $PAYOFF[$ONG['off']]?>

                        </span>订单编号：<?php echo $ONG['orderid'];?></div>


                        <a href="<?php echo $LINKURL = mourl( $CONN['userword'].$CONN['fenge'].'chading','',$CONN['fenge'].$ONG['orderid'].$CONN['houzui']);?>">
                            <img class="lazy pull-left" data-original="<?php echo pichttp($danxing['tupian']);?>"  src="/images/DefaultImg@2x.png" alt="">
                            <div class="m-cartlist-info">
                                <h3><?php echo $danxing['name'];?></h3>

                                <?php if( $danxing['canshu'] != '' ){  ?>

                                <h4>规格：<?php echo str_replace( '_',' ', $danxing['canshu'] );?></h4>

                                <?php } ?>
                            </div>
                        </a>


                        <div class="m-ordertotal">
                            <span>官方</span>
                            <span>共 <strong><?php echo $ONG['fakuaidi'];?></strong> 件商品 </span>
                            <span>实付款<strong>￥<?php echo $ONG['payjine'] - (float)$ONG['fakuaima'];?></strong></span>
                        </div>

                        <div class="m-orderfun">
                            <?php if($ONG['off'] < 2){ ?>

                                    <a href="<?php echo $LINKURL;?>" class="btn btn-default btn-sm" style="color:red;"> 立即支付 </a>
                                    <a href="<?php echo $LINKURL;?>" class="btn btn-default btn-sm btn-order-confirm"> 查看详情 </a>

                            <?php }else if($ONG['off'] == 2 && $ONG['faoff'] == 2){ ?>

                                    <a href="<?php echo $LINKURL;?>" class="btn btn-default btn-sm btn-order-confirm" style="color:green;"> 确定收货 </a>

                            <?php }else{ ?>

                                    <a href="<?php echo $LINKURL;?>" class="btn btn-default btn-sm btn-order-confirm"> 查看详情 </a>

                            <?php } ?>
                        </div>
                    </li>
                    <?php } ?>


                                      </ul>
                  </div>
                              </div>
            <!-- 未完成订单 -->
            <!-- 已完成订单 -->
            <div role="tabpanel" class="tab-pane fade m-user-order  lixingin2" id="done">
                <div class="m-cartlist">

                <ul class="list-unstyled">
                </ul>


                </div>
            </div>
            <!-- 已完成订单 -->
            <!-- 已取消订单 -->
            <div role="tabpanel" class="tab-pane fade m-user-order lixingin3" id="cancal">
                <div class="m-cartlist">


                <ul class="list-unstyled">
                </ul>



                </div>
            </div>
            <!-- 已取消订单 -->
        </div>    
      </div>
      <div class="topheight"></div>
      <div class="text-center m-component-more ajax_loading" onclick="gundong(1000);">     
        <span class="glyphicon  fdayicon fdayicon-loading"></span>加载更多...

      </div>
    </section>
<?php include QTPL .'foot.php';?>
<script type="text/javascript">
var PAGE = <?php echo (int) $PAGE;?>;
var NUM  = <?php echo (int) $NUM ;?>;
var SPAG = 1;
var DTYPE = 1;


function jiexidata( DATA ){

        html = '';

        list_status_html = '';

        switch(DTYPE){
            case 1:
                curr_area = '#undone';
                curr_status_class = 'm-ordering';
                break;
            case 2:
                curr_area = '#done';
                curr_status_class = 'm-ordersuc';
                break;
            case 3:
                curr_area = '#cancal';
                curr_status_class = 'm-ordercanl';
                break;
            default:
                return false;
                break;
        }


        $.each(DATA,function(k,val){


            if(val.off < 2){

                val.faoffname = val.offname;

                list_status_html = '<a href="'+val.url+'" class="btn btn-default btn-sm" style="color:red;"> 立即支付 </a> <a href="'+val.url+'" class="btn btn-default btn-sm btn-order-confirm"> 查看详情 </a>';

            }else if( val.off == 2 && val.faoff == 2 ){

                list_status_html ='<a href="'+val.url+'" class="btn btn-default btn-sm btn-order-confirm" style="color:green;"> 确定收货 </a>';

            }else  list_status_html ='<a href="'+val.url+'" class="btn btn-default btn-sm btn-order-confirm"> 查看详情 </a>';


            if(val.off == 3){ 
                
                val.faoffname = val.offname;
                list_status_html = '';
            }

            html+='<li><div class="m-orderinfo"><span class="pull-right '+curr_status_class+'">'+val.faoffname+'</span>订单编号：'+val.orderid+'</div><a href="'+val.url+'"><img class="lazy pull-left" src="'+val.tupian+'"><div class="m-cartlist-info"><h3>'+val.name+'</h3>';
           
            if( val.canshu != '' )
            html +='<h4>规格：'+val.canshu+'</h4>';
            
            html +='</div></a><div class="m-ordertotal"><span>'+val.shangname+'</span><span>共 <strong>'+val.jianshu+'</strong> 件商品 </span><span>实付款<strong>￥'+val.shifu+'</strong></span></div><div class="m-orderfun">'+list_status_html+'</div></li>';

        });

        if( PAGE == 1 )
            $(".lixingin"+DTYPE).find('.list-unstyled').html( html );
        else
            $(".lixingin"+DTYPE).find('.list-unstyled').append( html );
}


function dingdancha(){

        $.post(HTTP + "json.php?rand="+Math.random(),{y:'ding',d:'get',type:DTYPE,num:NUM,page:PAGE}, function( data ) {
            $(".ajax_loading").hide();
           
           if(data.code == 1){

                SPAG = 1;
                jiexidata( data.data );

           }else {
           
                  MessageBox.errorFadeout('已到最后一页',500);
           }
            


        }).error(function( data ){

            $(".ajax_loading").hide();
        
            dataerror( data ,'我的订单');
    
        });



}




function gundong( top ){

        if( $(".topheight").length ){

            taop =  $(".topheight").offset().top;

            top +=  $(window).height()+100;

            if(top > taop  && taop > 100){

                if( SPAG  == 1){

                    SPAG = 0;
                    PAGE++;
                    $(".ajax_loading").show();
                    dingdancha();

                }
            }
        }

}




function switchOrder( lx ){

    SPAG   = 1;
    PAGE   = 1;
    DTYPE  = lx;
    dingdancha();





}



$(function(){
   
    
        $( window ).scroll( function () {

            var top = parseInt( $(this).scrollTop() );
            gundong( top );

        });




});
</script>