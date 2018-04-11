<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
$NUM  = 8;
include QTPL .'head.php';
$D = db('hongbao');
$limit = listmit( $NUM , $PAGE);
$hongbaooff = logac('hongbaooff');
hongbao( $USERID );
?>
<style>
.m-user-order  .offzt0,.offzt0{color:#FF0066;}
.m-user-order .offzt1,.offzt1{color:#666;}
.m-user-order  .offzt2,.offzt2{color:#a7a7a7;}
.m-user-order  .offzt3,.offzt3{color:#eee;}
.hongbays{margin:11px 5px 0 8px;}
.hongbays big{font-size:200%;color:red;}
.hongbays sub{color:#a7a7a7;}
{font-size:188%;}
</style>
<body>


    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
          <a class="navbar-func pull-right" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>"><span class="glyphicon fdayicon fdayicon-cart"></span></a>   
          <span class="navbar-title"><?php echo $CONN['hongbao']?></span>
        </div>
      </div>
    </nav>
    <section class="m-component-user" id="m-user">
      <div class="m-userorder-tab">


        <div class="tab-content">
          <!-- 未完成订单 -->
            <div role="tabpanel" class="tab-pane fade in active m-user-order lixingin1" id="undone">
                                      <div class="m-cartlist">
                  <ul class="list-unstyled">

                    <?php 


                    $DATA = $D ->where( array( 'uid' => $USERID)  ) -> limit( $limit ) ->order('id desc')-> select();

                    if( $DATA ){

                    foreach( $DATA as $ONG ){
                    ?>
                    <li>
                        <div class="m-orderinfo"><span class="pull-right m-ordering offzt<?php echo $ONG['off'] ?>">
                        <?php echo $hongbaooff[$ONG['off']]?> </span>
                        
                        
                        <?php echo $CONN['hongbao']?>：<?php echo $ONG['haobaojine'];?> 元 满 <b style="color:red;"><?php echo $ONG['dayukeyong']?></b> 元 可用</div>


                        <a href="javascript:void(0);" style="height:68px;">
                            
                            <span class="glyphicon fdayicon fdayicon-coupon offzt<?php echo $ONG['off'] ?>" style="margin:0 ;float:left;"></span>
                           
                            <span style="display:inline-block;float:left;" class="hongbays">  <big> ￥<?php echo $ONG['shengyujine'];?></big>  <sub> / ￥<?php echo $ONG['haobaojine'];?></sub> </span>
                        </a>


                        <div class="m-ordertotal">
                            <span> 过期时间 <?php echo date( $CONN['timegeshi'], $ONG['gtime']);?></span>
                        </div>
                    </li>
                    <?php }}else{ ?>

                    <div class="m-component-order" style="background:#fff;min-height:300px;">
                        <div class="text-center ">
                            <span class="glyphicon fdayicon fdayicon-coupon"></span>
                            <h4>您还没有优惠券噢~</h4>
                        </div>
                    </div>

                    <?php } ?>


                </ul>
            </div>
           </div>
           
           
        </div>    
      </div>
      <div class="topheight"></div>
      <div class="text-center m-component-more ajax_loading" onclick="gundong(1000);">     
          <span class="glyphicon  fdayicon fdayicon-loading"></span>加载更多...

      </div>
    </section>

    


         
       


	



<?php include QTPL.'foot.php'; ?>

<script>
var PAGE = <?php echo (int) $PAGE;?>;
var NUM  = <?php echo (int) $NUM ;?>;
var SPAG = 1;
var HONGBAO = '<?php echo $CONN['hongbao']?>';


function jiexidata(DATA ){

        html = '';

        $.each(DATA,function(k,val){


             html += '<li title="'+val.id+'"><div class="m-orderinfo"><span class="pull-right m-ordering offzt'+val.off+'">'+val.offname+' </span>'+HONGBAO+'：'+val.jine+' 元 满 <b style="color:red;">'+val.man+'</b> 元 可用</div><a href="javascript:void(0);" style="height:68px;"><span class="glyphicon fdayicon fdayicon-coupon offzt'+val.off+'" style="margin:0 ;float:left;"></span><span style="display:inline-block;float:left;" class="hongbays">  <big> ￥'+val.sheng+'</big>  <sub> / ￥'+val.jine+'</sub> </span></a><div class="m-ordertotal"> <span> 过期时间 '+val.gtime+'</span></div></li>';
        

        
        });



        $("#undone .list-unstyled").append( html );


}




function dingdancha(){

        $.post(HTTP + "json.php?rand="+Math.random(),{y:'hongbaolist',d:'get',num:NUM,page:PAGE}, function( data ) {
            $(".ajax_loading").hide();
           
           if(data.code == 1){

                SPAG = 1;
                jiexidata( data.data );

           }else {
           
                  MessageBox.errorFadeout('已到最后一页',500);
           }
            


        }).error(function( data ){

            $(".ajax_loading").hide();
        
            dataerror( data ,'<?php echo $CONN['hongbao'];?>');
    
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


$(function(){
   
    
        $( window ).scroll( function () {

            var top = parseInt( $(this).scrollTop() );
            gundong( top );

        });




});


</script>
