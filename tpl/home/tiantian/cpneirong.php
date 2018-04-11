<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT'); 

$PAGE = 1;
$NUM  = 10;

include QTPL.'head.php'; ?>
<nav class="navbar navbar-default navbar-fixed-top m-component-nav">
    <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
            <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
            <span class="pull-right navbar-func">

                <a href="<?php echo mourl( $CONN['userword'] );?>" class="navbar-login"><span class="glyphicon fdayicon fdayicon-login"></span></a>

                <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>" class="navbar-cart"><span class="glyphicon fdayicon fdayicon-cart"></span></a>

            </span>
            <span class="navbar-title"><?php echo $DATA['name'];?> </span>
        </div>
    </div>
</nav>

<?php
function fenjiexi( $ni ){

    $ZIFU = (int) $ni;

    if( $ZIFU  < 1) return '<i class="glyphicon fdayicon fdayicon-star-full"></i>';
    $X = '';
    if( $ni - $ZIFU > 0 ) $X = '<i class="glyphicon fdayicon"></i>';
    return str_repeat( '<i class="glyphicon fdayicon fdayicon-star-full"></i>',$ZIFU).$X;

}

if($DATA['canshu'] !='') $DATA['canshu'] = unserialize($DATA['canshu']) ;
else $DATA['canshu'] =  array();

$CHANPINYES = true;

$JIAGE = isset($DATA['canshu']['jiage']) ? $DATA['canshu']['jiage']: array();

$shuju = isset($DATA['canshu']['shuju']) ? reset($DATA['canshu']['shuju']):array();

$jiage = isset($DATA['canshu']['jiage']) ? (float)reset($DATA['canshu']['jiage']):$DATA['jiage'];

?>
<section class="m-component-prodetail" id="m-prodetail">
    <div class="m-proslide">
        <div class="frame" id="proslide">
            <ul class="slidee">
            <?php

                $tupian = array($DATA['tupian']);
                if( $DATA['tupianji'] != '' )$tupian = unserialize( $DATA['tupianji'] );

                foreach($tupian as $tu){?>
                    <li><img src="<?php echo $tu;?>"></li>
            <?php } ?>
            </ul>
        </div>

        <ul class="slidebtn"></ul>
    </div>

    <div class="m-pro-parameter">

        <h3><?php echo $DATA['name'];?></h3>
        <h4 class="m-proselect-item" data-sid="1" >
        <?php   $SHUJU = isset( $DATA['canshu']['shuju'] )?$DATA['canshu']['shuju'] :array();
                $zifu = '';

                if( $SHUJU ){
  
                $LXX = 0;
                
                
                foreach(  $SHUJU as  $k => $zong ){
                
                
                ?>
            <ul class="sys_spec_text goumaican list-unstyled clearfix" id="canshuda<?php echo $LXX;?>">
                <li style="width:68px;"><?php echo $zong['name'];?>: </li>
                <?php 
                
                if( isset( $zong['name'] ))unset($zong['name']);

                $xx = 0;
                
                
                foreach($zong as $zhicn){



                    if($xx == 0) $zifu.=$zhicn['canshu'].'_';


                    
                ?><li class="canshu <?php echo $xx==0?' selected':''?>"id="z<?php echo $LXX;?>xiaocanshu<?php echo $xx;?>" data="<?php echo $xx;?>" pid="<?php echo $LXX;?>" title="<?php echo $zhicn['canshu'];?>">
                    <a href="javascript:;" title="<?php echo $zhicn['canshu'];?>"><?php echo $zhicn['canshu'];?></a><i class="glyphicon fdayicon fdayico  n-proselect"></i>
                </li><?php $xx++;} ?>
                </ul>
                
                <?php $LXX++;
                 
                   if(isset( $JIAGE[$zifu]))  $jiage = (float)$JIAGE[$zifu];

                
                
                } ?><script>var JIAGE = <?php echo json_encode($JIAGE );?>;</script>
                <?php } ?>


        </h4>


        <h4 style="min-height:40px;"> 
            <?php if($zifu != '' ){ ?>
            购买规格:<span class="xcansu"> <?php echo str_replace('_',' ',$zifu);?></span>
            <?php } ?>

            <div class="num_sel_lage pull-right clearfix">

                <span class="inC">-</span>
                <input type="text" id="buy_num"  value="1">
                <span class="deC">+</span>

            </div>

        </h4>

        <h5 class="clearfix">

            ￥<span class="price"><?php echo $jiage;?></span>
            <?php if($DATA['yuanjia'] > 0){ ?>
                <del>￥<span class="originalcost"><?php echo $DATA['yuanjia'];?></span></del>
            <?php } ?>

            <div class="pull-right">                  
                <button type="button" class="btn btn-warning add-cart jiarugouwu">加入购物车</button>
                <button type="button" class="btn btn-danger lijigoumai">立即购买</button>
            </div>
        </h5>
    </div>

    <div class="m-pro-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#proinfo" role="tab" data-toggle="tab">详细信息</a></li>
            <li role="presentation"><a href="#proappraise" role="tab" data-toggle="tab">用户评价</a></li>
          </ul>
          <div class="tab-content">

            <div role="tabpanel" class="tab-pane fade in active m-pro-info" id="proinfo">

                <div class="app-detail">
                    <?php echo $DATA['neirong'];?>
                </div>

            </div>
            
             <div role="tabpanel" class="tab-pane fade m-pro-appraise" id="proappraise">
               <!-- 用户评价 -->
               <?php
                    $TOTT = $D -> setbiao('dingdanx');

                    

                    $hao    = $TOTT -> where( array( 'cpid' => $DATA['id'] ,'pingoff' => '2','miaosufen IN' => '5,4' )) -> total();
                    $zhong  = $TOTT -> where( array( 'cpid' => $DATA['id'] ,'pingoff' => '2','miaosufen IN' => '3,4' ) ) -> total();
                    $cha    = $TOTT -> where( array( 'cpid' => $DATA['id'] ,'pingoff' => '2','miaosufen IN' => '1,2' )) -> total();
                   
                    $zhonghe = $hao+$zhong+$cha;



                    if($zhonghe <= 0) $zhonghe =1;




                   

                    $LIMIT = listmit( $NUM , $PAGE );


                    $SHUJUs = $TOTT -> where( array( 'cpid' => $DATA['id'] , 'pingoff' => '2' ) ) ->limit( $LIMIT ) ->order('id desc')-> select();

               
               ?>

               <dl class="clearfix " >
                  <dt class="pull-left">
                    <div class="m-appraise-mgs">
                      <div class="m-appraise-mgsinner">
                        <span class="glyphicon fdayicon fdayicon-appraise"></span>
                      </div>
                    </div>
                  </dt>
                  <dd class="pull-right m-appraise-progress">
                    <div id='good-div'>
                        <span class="pull-left m-progress-tip">很好:</span>
                        <span class="pull-right m-progress-num text-right"><?php echo $henhao1 = sprintf('%.1f',$hao/$zhonghe *100) ; ?>%</span>                   
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo  $henhao1; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo  $henhao1; ?>%">
                            <span class="sr-only"><?php echo  $henhao1; ?>% Complete (warning)</span>
                          </div>
                        </div>                      
                    </div>
                    <div id='normal-div'>
                        <span class="pull-left m-progress-tip">一般:</span>
                        <span class="pull-right m-progress-num text-right"><?php echo $henhao2 = sprintf('%.1f',$zhong/$zhonghe *100); ?>%</span>
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo  $henhao2; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo  $henhao2; ?>%">
                            <span class="sr-only"><?php echo  $henhao2; ?>% Complete (warning)</span>
                          </div>
                        </div>                      
                    </div> 

                    <?php   $henhao = 100-$henhao1-$henhao2;

                    if( $henhao == 100) $henhao = '0.0'; 
                    
                    ?>
                    <div id='bad-div'>
                        <span class="pull-left m-progress-tip">失望:</span>
                        <span class="pull-right m-progress-num text-right"><?php echo $henhao ; ?>%</span>
                        <div class="progress">
                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo  $henhao; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo  $henhao; ?>%">
                            <span class="sr-only"><?php echo  $henhao; ?>% Complete (warning)</span>
                          </div>
                        </div>                      
                    </div>
                  </dd>
               </dl>  

               
               <div class="proappraise-list">
                   <div class="modal fade bs-appraise-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content appraise-img-dialog">
                        <img src="http://cdn.fruitday.com/product_pic/1111/1/1-370x370-1111-YPY2AS1C.jpg" alt="">
                      </div>
                    </div>
                  </div>

               <ul class="list-unstyled pingluns" >

               <?php
               if( $SHUJUs ){
 
               foreach($SHUJUs as $WO){
                
               ?>

              
               
               <li><div><span class="m-appraise-user"><?php echo $WO['pinguser'];?></span>
               <span class="pull-right m-appraise-star">
                     <?php echo fenjiexi($WO['miaosufen'] );?>
                   
               </span>
               </div><div class="m-appraise-content"><blockquote><?php echo $WO['miaoshu']?></blockquote>
               <?php if($WO['ptupianji'] != ''){

                 $tupiji = unserialize($WO['ptupianji'] );
               
               ?>
               <ul class="list-unstyled clearfix m-appraise-imgItem">


               <?php foreach($tupiji as $zhi){ ?>

                    <li><img class="lazy" src="<?php echo pichttp($zhi);?>" data-original="<?php echo pichttp($zhi);?>" alt="" style="display: inline;"></li>

               <?php }?>
               

               
               </ul>

               <?php } ?>
               
               </div><div class="m-appraise-data"><?php echo date( 'Y-m-d H:i:s',$WO['pingtime'] );?></div></li>
               
             

               <?php } }else $NODATA = '1'; ?>


               
   
               </ul>

                <?php if( !isset( $NODATA )){ ?>
                    <div class="topheight"></div>
                <?php } ?>
                <div class="text-center m-component-more ajax_loading" onclick="gundong(1000);">
                    <span class="glyphicon  fdayicon fdayicon-loading"></span>加载更多...
                </div>
            </div>

	      


            </div>
          </div>
        </div>
    </section>

<?php include QTPL.'foot.php'?>
<script type="text/javascript">
var cpid    = '<?php echo $DATA['id'];?>';
var PAGE = <?php echo (int) $PAGE;?>;
var NUM  = <?php echo (int) $NUM ;?>;
var SPAG = 1;


var jiage   = '<?php echo $DATA['jiage'];?>';
var xuanzhe = '<?php echo $zifu;?>';
function appraisePic(){	
	$('.proappraise-list').delegate('.m-appraise-imgItem>li>img', 'click', function(e){	
		var url=$(this).attr('src');
		$('.bs-appraise-modal-sm').modal('show')	
			.find('.appraise-img-dialog>img').attr({'src': url});
		$('.bs-appraise-modal-sm').on('click', function(){
			$(this).modal('hide')
		})		
	})
}


function fenjiexi( num ){

    ht = '';

    $ZIFU = parseInt(num);
    $X = '';

    if( num - $ZIFU > 0 ) $X = '<i class="glyphicon fdayicon"></i>';

    for(i= 1 ; i < $ZIFU ;i++){
    
    ht +='<i class="glyphicon fdayicon fdayicon-star-full"></i>';
    
    }

    ht +=$X;

    if(ht == '' )return '<i class="glyphicon fdayicon fdayicon-star-full"></i>';



    return ht;

}


function jiexidata( DATA ){

        html = '';



        $.each(DATA,function(k,val){

            html += '<li><div><span class="m-appraise-user">'+val.pinguser+'</span><span class="pull-right m-appraise-star">'+fenjiexi(val.pinfen )+'</span></div><div class="m-appraise-content"><blockquote>'+val.miaoshu+'</blockquote>';

            


             

         
               

               
               

            if(val.tupian  && val.tupian != ''){

                html +='<ul class="list-unstyled clearfix m-appraise-imgItem">';

                TPP = val.tupian;

                for(var i in TPP ){

                    html +=' <li><img class="lazy" src="'+TPP[i]+'" data-original="'+TPP[i]+'" alt="" style="display: inline;"></li>';

                }

                 

                html +='</ul>';


            
            
            }


            html +='</div><div class="m-appraise-data">'+val.pingtime+'</div></li>';



         });




        $(".pingluns").append( html );

}

function dingdancha(){

        $.post(HTTP + "json.php?rand="+Math.random(),{y:'pinglun',d:'get',num:NUM,page:PAGE,cpid:cpid}, function( data ) {
            $(".ajax_loading").hide();
           
           if(data.code == 1){

                SPAG = 1;
                jiexidata( data.data );



              $("#good-div .m-progress-num").html( data.msg.hao+ '%');
              $("#good-div .progress-bar").css({width: data.msg.hao+ '%' } );

              $("#normal-div .m-progress-num").html( data.msg.zhong+ '%');
              $("#normal-div .progress-bar").css({width: data.msg.zhong+ '%' } );
              $("#bad-div .m-progress-num").html( data.msg.cha+ '%');
              $("#bad-div .progress-bar").css({width: data.msg.cha+ '%' } );

               
        


           }else {

              
           
                  MessageBox.errorFadeout('已到最后一页',500);
           }
            


        }).error(function( data ){

            $(".ajax_loading").hide();
        
            dataerror( data ,'评论');
    
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
            if( $(".active .proappraise-list").css('display') == 'block')
            gundong( top );


    });

    $(".goumaican li.canshu").click( function(){

        
        pid = $(this).attr('pid');

        $("#canshuda"+pid+" li.canshu").removeClass('selected');
        $(this).addClass('selected');

        $zifu = '';
        $xian =' ';

         $(".goumaican li.selected").each(function(){
        
            $zifu +=$(this).attr('title')+'_';
            $xian +=$(this).attr('title')+' ';
        
        });



        if( JIAGE[$zifu] || JIAGE[$zifu] === 0 ){

            if( JIAGE[$zifu] == '-1' ){

                 MessageBox.errorFadeout( $xian+'缺货',500);
                 $(".price").html( '--');
            
            
            }else $(".price").html( JIAGE[$zifu] );

        }else $(".price").html( jiage );

        xuanzhe = $zifu;

        $(".xcansu").html($xian );

    });


    $(".jiarugouwu").click( function(){


       lijigo( cpid , $("#buy_num").val() ,xuanzhe );
    
    });

    $(".lijigoumai").click( function(){

        zuhe = 0;

        if(typeof  JIAGE != 'undefined' ){

            z = 0;

            for( var i in JIAGE ){

                if( i == xuanzhe) zuhe = z;
                z++;
            }

            if( JIAGE[xuanzhe] == '-1' ){

                MessageBox.errorFadeout( $xian+'缺货',500);
                return false;
            }
        }

        goumai(  cpid  , $("#buy_num").val() ,zuhe );
    
    });



	appraisePic();




 
 
 });
</script>
