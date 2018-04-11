<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';
$GWC  = $Mem -> g( 'gouwuche/'. $USERID );
if( ! is_array( $GWC ) ) $GWC = array();
$huobi0 = $huobi1 = $huobi2 = 0;
?>
<style>
.jihuobi{color:red; margin-right:5px;}
</style>
<nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header text-center clearfix">
      <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
      <span class="pull-right navbar-func">
                  <a href="<?php echo mourl( $CONN['userword'] );?>" class="navbar-login"><span class="glyphicon fdayicon fdayicon-login"></span></a>        
                
      </span>
      <span class="navbar-title">购物车</span>
    </div>
  </div>
</nav>

<div class='cart-body' style="padding-bottom:48px;">

<section class="m-component-cart" id="m-cart">
    <div class="m-cartlist">
        <ul class="list-unstyled geweiyidd">
   <?php if( $GWC ){ 

   
      foreach( $GWC as  $k => $gou){ ?>


           <?php if( is_array( $gou ) ){ 


           
           
            foreach($gou as $kv => $xiang){
           ?>

            <li id="<?php echo $kv;?>" danjia="<?php echo $xiang['jiage'];?>" >
                <a  href="<?php echo $xiang['link']?>"  >
                    <img class="lazy pull-left" data-original="<?php echo $xiang['tupian']?>" src="/images/DefaultImg@2x.png" alt="">
                    <div class="m-cartlist-info">
                        <h3><?php echo $xiang['name']?></h3>
                        <h4>
                        规格：<?php echo str_replace( '_',' ',$xiang['canshu'] );?>  </h4>

                        <h5> <?php echo $HUOBIICO[$xiang['huobi']]?>
                        
                        <?php echo $xiang['jiage'];?></h5>
                    </div>
                </a>
                                 <span class="m-cartlist-delete" data="<?php echo $kv;?>"><i class="glyphicon fdayicon fdayicon-delete"></i></span>
                 <div class="m-cart-numswrap">
                    <div class="num_sel_lage pull-right clearfix">
                        <span class="inC" data="<?php echo $kv;?>">-</span>
                        <input type="text" data="<?php echo $kv;?>"  name='qty' autocomplete='on' value="<?php echo $xiang['num'];?>"  >
                        <span class="deC"  data="<?php echo $kv;?>">+</span>
                    </div>
                </div>

                <input type="hidden" value="<?php echo $zji = $xiang['num'] * $xiang['jiage']; ?>" class="jiage  huobi<?php echo $xiang['huobi']?>"  />
                            </li>

                <?php

                if( $xiang['huobi'] == '0')
                    $huobi0  += $zji;
                else if( $xiang['huobi'] == '1')
                    $huobi1  += $zji;
                else if( $xiang['huobi'] == '2')
                    $huobi2  += $zji;
               
                
                
                
                } } ?>


    

       

    <?php } }else{  ?>

    <div class="text-center"><span class="glyphicon fdayicon fdayicon-procart"></span><h4>您的购物车现在是空的噢~</h4><h5>现在就去选购吧</h5><a href="/" class="btn btn-warning navbar-btn">去逛逛</a></div>

    <?php } ?>

             
        </ul>    
    </div>






    </section>
<input type="hidden" id="dsp_page" value="1">

<nav class="navbar navbar-default navbar-fixed-bottom m-component-foot" role="navigation">
  <div class="container">
    <div class="navbar-text navbar-left pull-left m-cart-disbursement">合计：

    <span class="jihuobi0 jihuobi"><?php  echo  $HUOBIICO['0'].$huobi0;?></span>
    <span class="jihuobi1 jihuobi"><?php if( $huobi1  > 0) echo  $HUOBIICO['1'].$huobi1;?></span>
    <span class="jihuobi2 jihuobi"><?php if( $huobi2  > 0) echo  $HUOBIICO['2'].$huobi2;?></span>
   
   

   
      
    </div> 
    <button type="button" class="btn btn-warning navbar-btn pull-right" onclick="return jiesuan();">去结算</button>
  </div>
</nav>

</div>
<?php include QTPL .'foot.php';?>
<script>


function jiesuan(){

      

    lenn = $(".m-cartlist li").length;

    if( lenn == '0' ){

        MessageBox.errorFadeout('没有产品',1000 , HTTP);
        return false;
    
    }

    MessageBox.loading('<?php echo mourl( $CONN['userword'].$CONN['fenge'].'ding' );?>');


}


function bianjiok(biaoshi , shuliang){

        danjia =  $("#"+biaoshi).attr('danjia');

        jiage = danjia *  shuliang;

        $("#"+biaoshi+" [name=qty]").val( shuliang  );

        $("#"+biaoshi+" input.jiage").val( (jiage) );
        tongjizshu();
}


function shancok(id){



    MessageBox.show('删除成功',500);

    $("#"+id).remove();

    if( $(".geweiyidd li").length  < 1){
      $(".m-cartlist").html('<div class="text-center"><span class="glyphicon fdayicon fdayicon-procart"></span><h4>您的购物车现在是空的噢~</h4><h5>现在就去选购吧</h5><a href="/" class="btn btn-warning navbar-btn">去逛逛</a></div>');

      $(".m-carttips").remove();
    }

    tongjizshu();

}


function tongjizshu(){

        huobi0 =huobi1 = huobi2  =  0;
        if( $(".huobi0").length ){


            $("input.huobi0").each(function(){
            
                huobi0 += $(this).val()*1;
            
            });


            $(".jihuobi0").html( $HUOBIICO[0] + ( huobi0.toFixed(2)) );


        
          
        } else $(".jihuobi0").html( '');



        if( $(".huobi1").length ){

            $("input.huobi1").each(function(){
            
                huobi1 += $(this).val()*1;
            
            });


            $(".jihuobi1").html( $HUOBIICO[1] + huobi1 );


        
          
        } else $(".jihuobi1").html('');

        if( $(".huobi2").length ){

             $("input.huobi2").each(function(){
            
                huobi2 += $(this).val()*1;
            
            });


            $(".jihuobi2").html( $HUOBIICO[2] + huobi2 );


        
          
        } else $(".jihuobi2").html('');

       



}



$(function(){



    $(".deC").click(function(){

        var biaoshi = $(this).attr('data');

        /*  +  */
        var sl = $("#"+biaoshi+" [name=qty]").val() * 1;


        if( sl < 1) sl = 1;
        if( isNaN( sl ) ) sl = 1;

        shuliang = ( sl + 1 );

         bianji(biaoshi, shuliang , bianjiok );


       
    
    
    });

    $(".inC").click(function(){

        var biaoshi = $(this).attr('data');
        var sl = $("#"+biaoshi+" [name=qty]").val() * 1;

        if( sl < 2) sl = 2;
        if( isNaN( sl ) ) sl = 2;

        shuliang = ( sl - 1  );

        bianji(biaoshi, shuliang , bianjiok );

        /* - */

    
    
    });


    $("[name=qty]").change(function(){ 

        var biaoshi = $(this).attr('data');
        var shuliang = $(this).val() * 1;
        if( shuliang < 1) shuliang = 1;
        if( isNaN( shuliang ) ) shuliang = 1;

        bianji(biaoshi, shuliang , bianjiok );

    });



    $(".m-cartlist-delete").click(function(){

        /* 删除 */
        var biaoshi = $(this).attr('data');
        shanchu(biaoshi, shancok );

    });




});
</script>