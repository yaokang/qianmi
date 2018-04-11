<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
$MOD = isset( $HTTP['2'] )? $HTTP['2'] : 'list';
$ID = isset( $HTTP['3'] )? $HTTP['3'] : '0';
$D -> setbiao ( 'shouhuo' );
$DATA = array( 'diqu' => 0,'off' => 0 ) ;
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
    body{background: #f5f5f5;padding-bottom:100px;}
    .mui-input-row{background:#fff;}
    .mui-input-group .mui-input-row:after{left:0px;}
    .mui-card-link{font-size:14px;color:#0BBE06;}
    .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:33px;width:25px;height:33px;}

    .mui-card{}
    b{font-weight:normal;}
    .mui-card .mui-icon {font-size:20px;}
    .mui-card .mui-icon b{color:#000;font-size:14px;}

    .mui-card .mui-icon-map b{color:#8f8f94;}
    .mui-btn-block{padding:5px 0px;margin:3px;}
    
    </style>
   
    </head>

    <body>



<?php if( $MOD == 'add'){ 
/*添加新的收货地址*/
?>

        <header id="header" class="mui-bar mui-bar-nav">

           <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' );?>"></a>
            <h1 class="mui-title">新增收货地址</h1>
            <a href="javascript:shedit( 'post' );" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">完成</a>
   

        </header>

        <div class="mui-content" style="background:transparent;">

            <div class="mui-content-padded" style="margin: 5px;">

                <form class="mui-input-group">
					<div class="mui-input-row">
						<label>收货人</label>
                        <input type="text" id="xingming" class="text-right" placeholder="" />
						
					</div>

                    <div class="mui-content-padded ">
                
                <div class="col-xs-12 text-right">

                <input type="hidden"  value="<?php echo $DATA['diqu'];?>" name="diqu"  id="yuandiqu" >


                <span class="yddddd" id="chengshiid"> 

                <?php 
             
                      $shuju = chengshiid( $DATA['diqu']);

                      $html ='';

                      for($i = 0;$i< count($shuju) ; $i++){

                          $shujus = chengshi($shuju[$i]);
                          if($shuju[$i] > 0 )unset($shujus['0']);

                          $html.=' <select id="shisso'.$i.'" onchange="shiji'.$i.'(this.value)" class="mui-btn mui-btn-block">';
                                   
                                  foreach($shujus as $k =>$v){

                                      $xb = $i+1;

                                      if( (isset($shuju[$xb]) && $k == $shuju[$xb] ) || $k ==  $DATA['diqu'])
                                           $html.='<option value="'.$k.'" selected="selected">'.$v.' </option>';
                                      else
                                           $html.='<option value="'.$k.'">'.$v.' </option>';
                                  }

                          $html.='</select>';
                      }

                      echo $html;
                ?>
                </span>

                   
              </div>


                
              </div>

                    <div class="mui-input-row">
						<label>详细地址</label>
                        <input type="text" id="xiangqing" class="text-right" placeholder="" />
						
					</div>

                     <div class="mui-input-row">
						<label>收货手机</label>
                        <input type="tel" id="shouji" class="text-right" placeholder="" />
						
					</div>
                    <div class="mui-input-row">
						<label>地址类型</label>
                        <input type="text" id="beizhu" class="text-right" placeholder="家 / 公司 / 其他" />
						
					</div>

                    <div class="mui-input-row mui-checkbox mui-left">
						<label>设为默认地址</label>
						<input name="onoffswitch" class="onoffswitch-checkbox hide" id="myonoffswitch" value="1" type="checkbox" >
					</div>

                   

                    



                </form>

            </div>

        </div>


   

<?php }else if( $MOD == 'edit'){ 

        /* 编辑收货地址 */

        $DATA = $D ->where( array( 'id' => $ID ))->find();
        if( ! $DATA || $DATA['uid'] != $USERID ) msgbox('非法选择', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );

?>

      <input type="hidden" id="selected_id" value="<?php echo $ID;?>">



    <header id="header" class="mui-bar mui-bar-nav">

           <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' );?>"></a>
            <h1 class="mui-title">编辑收货地址</h1>
            <a href="javascript:shedit( 'put' );" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">完成</a>
   

        </header>

        <div class="mui-content" style="background:transparent;">

            <div class="mui-content-padded" style="margin: 5px;">

                <form class="mui-input-group">
					<div class="mui-input-row">
						<label>收货人</label>
                        <input type="text" id="xingming" class="text-right" placeholder="" value="<?php echo $DATA['xingming'];?>" />
						
					</div>

                    <div class="mui-content-padded ">
                
                <div class="col-xs-12 text-right">

                <input type="hidden"  value="<?php echo $DATA['diqu'];?>" name="diqu"  id="yuandiqu" >


                <span class="yddddd" id="chengshiid"> 

               <?php 
             
                      $shuju = chengshiid( $DATA['diqu']);


                      $html ='';

                      for($i = 0;$i< count($shuju) ; $i++){

                          $shujus = chengshi($shuju[$i]);
                          if($shuju[$i] > 0 )unset($shujus['0']);

                         $html.=' <select id="shisso'.$i.'" onchange="shiji'.$i.'(this.value)" class="mui-btn mui-btn-block">';
                                   
                                  foreach($shujus as $k =>$v){

                                      $xb = $i+1;

                                      if( (isset($shuju[$xb]) && $k == $shuju[$xb] ) || $k ==  $DATA['diqu'])
                                           $html.='<option value="'.$k.'" selected="selected">'.$v.' </option>';
                                      else
                                           $html.='<option value="'.$k.'">'.$v.' </option>';
                                  }

                        $html.='</select>';

                      }

                      echo $html;
                    ?>
                </span>

                   
              </div>


                
              </div>

                    <div class="mui-input-row">
						<label>详细地址</label>
                        <input type="text" id="xiangqing" class="text-right" placeholder="" value="<?php echo $DATA['dizhi'];?>"/>
						
					</div>

                     <div class="mui-input-row">
						<label>收货手机</label>
                        <input type="tel" id="shouji" class="text-right" placeholder="" value="<?php echo $DATA['shouji'];?>" />
						
					</div>
                    <div class="mui-input-row">
						<label>地址类型</label>
                        <input type="text" id="beizhu" class="text-right" placeholder="家 / 公司 / 其他"  value="<?php echo $DATA['zuoji'];?>" />
						
					</div>

                    <div class="mui-input-row mui-checkbox mui-left">
						<label>设为默认地址</label>
						<input name="onoffswitch" class="onoffswitch-checkbox hide" id="myonoffswitch" value="1" type="checkbox"  <?php echo $DATA['off']== '1' ? 'checked="checked"':''?>  >
					</div>

                   

                    



                </form>

            </div>

        </div>




<?php }else if( $MOD == 'xuanzhe'){ 

        /* 选择收获地址*/

        $DATA = $D ->where( array( 'id' => $ID ))->find();
        if( ! $DATA || $DATA['uid'] != $USERID ) msgbox('非法选择', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );
       
        $D ->where( array( 'uid' => $USERID ))->update(array('off' => 0 ));
        $fan =  $D ->where( array( 'id' => $ID ))->update(array('off' => 1 ,'atime' => time() ));

   
        if( $fan ){
            userlog(  $USERID , 3 , serialize( array( 'uid' =>  $USERID ,'off' => 1, 'id' => $ID ) ) ) ;

        }

        msgbox('', isset($_SESSION['shangyibu']) ? $_SESSION['shangyibu']: mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' ) );

 }else if( $MOD == 'del'){ 

        /*删除收货地址*/

        $DATA = $D ->where( array( 'id' => $ID ))->find();
        if( ! $DATA || $DATA['uid'] != $USERID ) msgbox('非法删除', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );

        $fan  = $D -> where( array( 'id' => $ID )) -> delete();

        if( $fan ){

            userlog(  $USERID , 4 , serialize( $DATA ) ) ;
            msgbox('删除成功', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );

        }else msgbox('删除失败', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );
      
}else{  /*收货地址列表*/ ?>

        <header id="header" class="mui-bar mui-bar-nav">

           <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php if(isset($_SESSION['shangyibu'])) echo $_SESSION['shangyibu'];else echo mourl( $CONN['userword'] );?>"></a>
            <h1 class="mui-title">收货人列表</h1>
            <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'add');?>" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">添加</a>
   

        </header>

        <div class="mui-content" style="background:transparent;">

        <?php

        $SHOUHUO = $D -> where( array( 'uid' => $USERID )) ->order('off desc,id desc') -> select();
        if( $SHOUHUO ){
            foreach( $SHOUHUO as $anyou ){
        ?>
        <div class="mui-card">
                <div class="mui-card-header"> <span class="mui-icon mui-icon-contact" style="color:#8a6de9;"> <b><?php echo $anyou['xingming'];?></b></span>
                
                <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'edit'.$CONN['fenge'].$anyou['id']);?>" class="m-order-address-edit">
                   <span class="mui-icon mui-icon-compose"></span>
                </a>
                
                </div>
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">

                    <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'xuanzhe'.$CONN['fenge'].$anyou['id']);?>">
                    
                        <span class="<?php echo $anyou['off'] == 1?'mui-icon mui-icon-map" style="color:Red;':'mui-icon mui-icon-location';?>"> <b><?php echo $anyou['beizhu'];?> </b></span>

                    </a>

                    </div>
                </div>
                <div class="mui-card-footer"><span class="mui-icon mui-icon-phone" style="color:#1db489;">  <b> <?php echo $anyou['shouji'];?> </b></span>
                
                <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'del'.$CONN['fenge'].$anyou['id']);?>" class="m-order-address-delete">
                  <span class="mui-icon mui-icon-trash" style="color:red;"></span>
                </a>
                </div>
            </div>


        <?php } }else{ ?>

        <div class="mui-card">

            <div class="mui-card-content">
                <div class="mui-card-content-inner" style="text-align:center;">
                    <h4>您还没有添加地址噢~</h4>
                    <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'add');?>" class="btn btn-warning navbar-btn">新增地址</a>
                 </div>

             </div>

        </div>


        <?php } ?>


        </div>





<?php } ?>
</body>
</html>
<?php include QTPL .'foot.php';
include QTPL .'user/ufoot.php';
?>
<script type="text/javascript">
TOKEN = '<?php echo wenyiyz( 'shouhuo_'.$USERID ,  '' , $Mem );?>';

function shedit( $add ){

        id       = $("#selected_id").val();
        diqu     = $("#yuandiqu").val();
        xingming = $("#xingming").val();
        xiangqing= $("#xiangqing").val();
        shouji   = $("#shouji").val();
        beizhu   = $("#beizhu").val();
        moren    = $("#myonoffswitch").val();

        canshu = [ "xingming#len#2-30" , "diqu#len#6","xiangqing#len#2-120", "shouji#len#11", ];

        LOFROM["xingming"] = '收货人';
        LOFROM["diqu"] = '区域选择';
        LOFROM["xiangqing"] = '详细地址';
        LOFROM["shouji"] = '收货手机';

        fanhui = yzpost( canshu , { "xingming" : xingming , "diqu" : diqu , "xiangqing" : xiangqing ,  "shouji" : shouji  } );

        if( fanhui.code != 1){

            mui.toast (LOFROM[fanhui.biao] + '错误'  );
            return false;
        }


        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'shouhuo',d:$add,id:id,diqu:diqu,xingming:xingming,xiangqing:xiangqing,shouji:shouji,beizhu:beizhu,moren:moren,ttoken:TOKEN},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

             

                mui.toast ( $add == 'put'?'修改成功':'添加成功'  ,{url:"<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo');?>" });


           

            },error:function(xhr){

                dataerror(xhr , '收货' );
            }
        });




       






}


function shiji2( id ){



        $("#yuandiqu").val(id);

}

function shiji1( id ){


        $.getJSON("<?php echo $CONN['dir']?>api.php?action=chenshi&id=" + id ,function( FANHUI ){

            if( FANHUI.code == 1 ){

                var html  = '';
                var shuju = FANHUI.data;
                var  ii   = 0;

                if( shuju ){

                    $.each( shuju, function( i, field){

                        if( ii == 0) $("#yuandiqu").val( i );
                        html +='<option value="'+i+'">'+field+'</option>';
                        ii++;

                    });

                    if(html == '' ){

                        if( $("#shisso2").length ){

                            $("#shisso2").remove();
                        }

                        $("#yuandiqu").val( id ); 

                    }else if(  $("#shisso2").length > 0){

                        $("#shisso2").html( html);

                    }else  $("#chengshiid").append( ' <select id="shisso2" onchange="shiji2(this.value)" class="mui-btn mui-btn-block">' + html +'</select>' );

                }else{

                    if( $("#shisso2").length ){

                        $("#shisso2").remove();
                    }

                    $("#yuandiqu").val( id ); 
                }

            }else if(  $("#shisso2").length ) {

                if( $("#shisso2").length ){

                    $("#shisso2").remove();
                }

                $("#yuandiqu").val( id ); 
            }

        });
}



function shiji0(id){

        if( id < 1){
   
              if(  $("#shisso1").length) $("#shisso1").remove();
              if(  $("#shisso2").length) $("#shisso2").remove();

              $("#yuandiqu").val('0');
              return ;
        }

        if( $("#shisso2").length ) $("#shisso2").remove();

        $.getJSON("<?php echo $CONN['dir']?>api.php?action=chenshi&id=" + id ,function( FANHUI ){

                if( FANHUI.code == 1 ){

                    var html = '';
                    var shuju = FANHUI.data;

                    if( shuju ){

                        var get  = 0 ;
                        var  ii = 0;

                        $.each( shuju, function( i , field ){

                            if( ii == 0){

                                $("#yuandiqu").val(i);
                                get = i;
                            }

                            html +='<option value="'+i+'">'+field+'</option>';
                            ii++;

                        });



                        if( get > 0) shiji1( get );
                        else  $("#yuandiqu").val(id); 

                        if(html == '' ){

                            if(  $("#shisso1").length) $("#shisso1").remove();
                            if(  $("#shisso2").length) $("#shisso2").remove();
                            $("#yuandiqu").val( id ); 

                        }else if( $("#shisso1").length > 0 )
                                $("#shisso1").html( html);
                        else    $("#chengshiid").append( ' <select id="shisso1" onchange="shiji1(this.value)" class="mui-btn mui-btn-block">' + html +'</select>' );

                    }else $("#yuandiqu").val( id ); 

                }else{

                    if(  $("#shisso1").length) $("#shisso1").remove();
                    if(  $("#shisso2").length) $("#shisso2").remove();
                    $("#yuandiqu").val( id ); 
                }

        });
}

$(function(){




});

</script>