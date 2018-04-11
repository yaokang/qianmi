<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');



$NUM = 20;

include QTPL.'head.php';
?>

    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
          <span class="pull-right navbar-func">
                          <a href="<?php echo mourl( $CONN['userword'] );?>" class="navbar-login"><span class="glyphicon fdayicon fdayicon-login"></span></a>
                            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>" class="navbar-cart">
                <span class="glyphicon fdayicon fdayicon-cart"></span>
              </a>
          </span>
          <span class="navbar-title"><?php echo $DATA['name']?></span>
        </div>
      </div>
    </nav>

    <section class="m-component-prolist" id="m-prolist">
                <div id="container">      
            <ul class="list-unstyled">

                <?php 
                
                $DATAS = neirlist( $TJ = array( 'cid'=> xjcid($DATA['id'])  ,'page' => $PAGE,'num'=> $NUM,'total'=>1) , 'center' , $D ); 
                
                
                if( $DATAS['date'] ){

                    foreach( $DATAS['date'] as $ong ){

                        if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                        else $ong['canshu'] =  array();

                        $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                        $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;

                ?>
                 
                <li>
                    <a href="<?php echo $ong['link'];?>" title="<?php echo $ong['name'];?>">
                        <img class="lazy pull-left" data-original="<?php echo pichttp($ong['tupian']);?>"  src="/images/DefaultImg@2x.png">
                        <div class="m-prolist-info" >
                            <h3><?php echo $ong['name'];?></h3>
                            <?php if($ong['canshu'] ){ ?><h4><?php echo $shuju['name'].'：'.$shuju['0']['canshu'];?></h4><?php } ?>
                            <h5><?php echo $HUOBIICO[$ong['huobi']] ;?><?php echo $jiage <=0? $ong['jiage']: $jiage;?></h5>
                            <span class="m-prolist-car" onclick="lijigo( <?php echo $ong['id'];?>);return false;"><i class="glyphicon fdayicon fdayicon-procart"></i></span>
                        </div>
                    </a>
                </li>

                <?php } } ?>
                 
               
                            </ul>
        </div>  
              
       <div class="topheight"></div>
      <div class="text-center m-component-more ajax_loading" onclick="gundong(1000);">     
          <span class="glyphicon  fdayicon fdayicon-loading"></span>加载更多...

      </div>
<?php include QTPL.'foot.php'?>
<script>
var PAGE = <?php echo (int) $PAGE;?>;
var NUM  = <?php echo (int) $NUM ;?>;
var CPID = <?php echo (float) $DATA['id'];?>;
var SPAG = 1;

function jiexidata(DATA ){

        html = '';

        $.each(DATA,function(k,val){


           
             


            html +='<li><a href="'+val.link+'" title="'+val.name+'"> <img class="lazy pull-left" src="'+val.tupian+'" ><div class="m-prolist-info" ><h3>'+val.name+'</h3>';

            if(val.canshu != '')
            html +='<h4>'+val.canshu+'</h4>';

           html +=' <h5>'+val.huobi+val.jiage+'</h5><span class="m-prolist-car" onclick="lijigo( '+val.id+');return false;"><i class="glyphicon fdayicon fdayicon-procart"></i></span> </div> </a></li>';

        
        });



        $("#container .list-unstyled").append( html );


}




function dingdancha(){

        $.post(HTTP + "json.php?rand="+Math.random(),{y:'cplist',d:'get',num:NUM,page:PAGE,cpid:CPID}, function( data ) {
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