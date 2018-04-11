<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;
include QTPL .'head.php';
$MOD = isset( $HTTP['2'] )? $HTTP['2'] : 'list';
$ID = isset( $HTTP['3'] )? $HTTP['3'] : '0';
$D -> setbiao ( 'shouhuo' );
  $DATA = array( 'diqu' => 0,'off' => 0 ) ;
?>
<style>
.jihuobi{color:red; margin-right:5px;}
#chengshiid select{padding:5px;border-color:#f2f2f2;width:98px;}

</style>
<?php if( $MOD == 'add'){ 
       
?>

<nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <input type="hidden" id="selected_id" value="0">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' );?>"><span class="glyphicon fdayicon fdayicon-navback"></span></a>
          <span class="pull-right navbar-func">
              <button type="button" class="btn btn-warning btn-xs" id="editEnd" onclick="shedit( 'post' );">完成</button>
          </span>
          <span class="navbar-title">新增收货地址</span>
        </div>
      </div>
    </nav>



    <section class="m-component-order" id="m-order">
        <div class="container">
            <div class="form-horizontal m-order-address-form" role="form">
              <div class="form-group">
                <label for="xingming" class="col-xs-3 control-label">收货人</label>
                <div class="col-xs-9 text-right">
                  <input type="text" id="xingming" class="text-right" placeholder="" />
                </div>
              </div>
              <div class="form-group">
                
                <div class="col-xs-12 text-right">

                <input type="hidden"  value="<?php echo $DATA['diqu'];?>" name="diqu"  id="yuandiqu" >


                <span class="yddddd" id="chengshiid"> 

               <?php 
             
                      $shuju = chengshiid( $DATA['diqu']);

                      $html ='';

                      for($i = 0;$i< count($shuju) ; $i++){

                          $shujus = chengshi($shuju[$i]);
                          if($shuju[$i] > 0 )unset($shujus['0']);

                         $html.=' <select id="shisso'.$i.'" onchange="shiji'.$i.'(this.value)">';
                                   
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
             
              <div class="form-group">
                <label for="xiangqing" class="col-xs-3 control-label">详细地址</label>
                <div class="col-xs-9 text-right">
                  <input type="text" id="xiangqing" class="text-right" placeholder="" />
                </div>
              </div>
              <div class="form-group">
                <label for="shouji" class="col-xs-3 control-label">收货手机</label>
                <div class="col-xs-9 text-right">
                  <input type="tel" id="shouji" class="text-right" placeholder="" />
                </div>
              </div>
              <div class="form-group">
                <label for="beizhu" class="col-xs-3 control-label">地址类型</label>
                <div class="col-xs-9 text-right">
                  <input type="text" id="beizhu" class="text-right" placeholder="家 / 公司 / 其他" />
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-xs-5 control-label">设为默认地址</label>
                <div class="col-xs-7 text-right">
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox hide" id="myonoffswitch" value='0'>
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <div class="onoffswitch-inner">
                                <div class="onoffswitch-active"></div>
                                <div class="onoffswitch-inactive"></div>
                            </div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div>
                </div>
              </div>
            </div>


        </div>
    </section>

<?php }else if( $MOD == 'edit'){ 

        $DATA = $D ->where( array( 'id' => $ID ))->find();
        if( ! $DATA || $DATA['uid'] != $USERID ) msgbox('非法选择', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );






?>

<nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <input type="hidden" id="selected_id" value="<?php echo $ID;?>">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' );?>"><span class="glyphicon fdayicon fdayicon-navback"></span></a>
          <span class="pull-right navbar-func">
              <button type="button" class="btn btn-warning btn-xs" id="editEnd" onclick="shedit( 'put' );">完成</button>
          </span>
          <span class="navbar-title">编辑收货地址</span>
        </div>
      </div>
    </nav>



    <section class="m-component-order" id="m-order">
        <div class="container">
            <div class="form-horizontal m-order-address-form" role="form">
              <div class="form-group">
                <label for="xingming" class="col-xs-3 control-label">收货人</label>
                <div class="col-xs-9 text-right">
                  <input type="text" id="xingming" class="text-right" placeholder="" value="<?php echo $DATA['xingming'];?>" />
                </div>
              </div>
              <div class="form-group">
               
                <div class="col-xs-12 text-right">

                <input type="hidden"  value="<?php echo $DATA['diqu'];?>" name="diqu"  id="yuandiqu" >


                <span class="yddddd" id="chengshiid"> 

               <?php 
             
                      $shuju = chengshiid( $DATA['diqu']);

                      $html ='';

                      for($i = 0;$i< count($shuju) ; $i++){

                          $shujus = chengshi($shuju[$i]);
                          if($shuju[$i] > 0 )unset($shujus['0']);

                         $html.=' <select id="shisso'.$i.'" onchange="shiji'.$i.'(this.value)">';
                                   
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
             
              <div class="form-group">
                <label for="xiangqing" class="col-xs-3 control-label">详细地址</label>
                <div class="col-xs-9 text-right">
                  <input type="text" id="xiangqing" class="text-right" placeholder="" value="<?php echo $DATA['dizhi'];?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="shouji" class="col-xs-3 control-label">收货手机</label>
                <div class="col-xs-9 text-right">
                  <input type="tel" id="shouji" class="text-right" placeholder="" value="<?php echo $DATA['shouji'];?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="beizhu" class="col-xs-3 control-label">地址类型</label>
                <div class="col-xs-9 text-right">
                  <input type="text" id="beizhu" class="text-right" placeholder="家 / 公司 / 其他"  value="<?php echo $DATA['zuoji'];?>"/>
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-xs-5 control-label">设为默认地址</label>
                <div class="col-xs-7 text-right">

                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox hide" id="myonoffswitch" value="<?php echo $DATA['off'];?>">
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <div class="onoffswitch-inner">
                                <div class="onoffswitch-active"></div>
                                <div class="onoffswitch-inactive"></div>
                            </div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div>

               

                  






                </div>
              </div>
            </div>


        </div>
    </section>

<?php }else if( $MOD == 'xuanzhe'){ 

        $DATA = $D ->where( array( 'id' => $ID ))->find();
        if( ! $DATA || $DATA['uid'] != $USERID ) msgbox('非法选择', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );
       
        $D ->where( array( 'uid' => $USERID ))->update(array('off' => 0 ));
        $fan =  $D ->where( array( 'id' => $ID ))->update(array('off' => 1 ,'atime' => time() ));

   
        if( $fan ){
            userlog(  $USERID , 3 , serialize( array( 'uid' =>  $USERID ,'off' => 1, 'id' => $ID ) ) ) ;

        }

        msgbox('', isset($_SESSION['shangyibu']) ? $_SESSION['shangyibu']: mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' ) );

 }else if( $MOD == 'del'){ 

        $DATA = $D ->where( array( 'id' => $ID ))->find();
        if( ! $DATA || $DATA['uid'] != $USERID ) msgbox('非法删除', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );

        $fan  = $D -> where( array( 'id' => $ID )) -> delete();

        if( $fan ){

            userlog(  $USERID , 4 , serialize( $DATA ) ) ;
            msgbox('删除成功', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );

        }else msgbox('删除失败', mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo') );
      
}else{  ?>
    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href=" <?php if(isset($_SESSION['shangyibu'])) echo $_SESSION['shangyibu'];else echo mourl( $CONN['userword'].$CONN['fenge'].'shouhuo' );?>
       ">
              <span class="glyphicon fdayicon fdayicon-navback"></span>
          </a>
          <a class="navbar-func pull-right" href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'add');?>"><span class="glyphicon fdayicon fdayicon-add"></span></a>
          <span class="navbar-title">收货地址</span>
        </div>
      </div>
    </nav>

  <section class="m-component-order" id="m-order">
  	    <ul class="list-unstyled m-order-addresslist" id="m-orderaddlist">
        <?php

        $SHOUHUO = $D -> where( array( 'uid' => $USERID )) ->order('id desc') -> select();
        if( $SHOUHUO ){
            foreach( $SHOUHUO as $anyou ){
        ?>
        <li class="m-order-item<?php echo $anyou['off'] == 1?' cur':'';?> ">



              <div class="m-order-address" onclick="window.location.href='<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'xuanzhe'.$CONN['fenge'].$anyou['id']);?>';">

               
              
                  <?php echo $anyou['xingming'].' '.$anyou['shouji'];?>

                  <?php if( $anyou['zuoji'] != '' ){ ?>
                  <span class='orange'>[<?php echo $anyou['zuoji'];?>]</span>
                  <?php } ?>
                  <p><?php echo $anyou['beizhu'];?>  </p>


              </div>

              <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'edit'.$CONN['fenge'].$anyou['id']);?>" class="m-order-address-edit">
                  <span class="glyphicon fdayicon fdayicon-edit"></span>
              </a>
              <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'del'.$CONN['fenge'].$anyou['id']);?>" class="m-order-address-delete">
                  <span class="glyphicon fdayicon fdayicon-delete"></span>
              </a>
          </li>

        <?php } }else{ ?>

        <div class="text-center">
           <span class="glyphicon fdayicon fdayicon-local"></span>
           <h4>您还没有添加地址噢~</h4>
           <a href="<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo'.$CONN['fenge'].'add');?>" class="btn btn-warning navbar-btn">新增地址</a>
        </div> 



        <?php } ?>


        </ul>
      </section>
<?php } ?>

<?php include QTPL .'foot.php';?>

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

            MessageBox.errorFadeout( LOFROM[fanhui.biao] + '错误' , 500 );
            return false;
        }

         $.post(HTTP + "json.php",{y:'shouhuo',d:$add,id:id,diqu:diqu,xingming:xingming,xiangqing:xiangqing,shouji:shouji,beizhu:beizhu,moren:moren,ttoken:TOKEN}, function(data ) {

            if ( $add == 'put' )
               MessageBox.show( '修改成功' , 500 );
            else
            MessageBox.show( '添加成功' , 500 );

            window.location.href = "<?php echo mourl(  $CONN['userword'].$CONN['fenge'].'shouhuo');?>";
            
     
        }).error(function( data ){
        
            dataerror( data ,'收货');
    
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

                    }else  $("#chengshiid").append( ' <select id="shisso2" onchange="shiji2(this.value)">' + html +'</select>' );

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
                        else    $("#chengshiid").append( ' <select id="shisso1" onchange="shiji1(this.value)">' + html +'</select>' );

                    }else $("#yuandiqu").val( id ); 

                }else{

                    if(  $("#shisso1").length) $("#shisso1").remove();
                    if(  $("#shisso2").length) $("#shisso2").remove();
                    $("#yuandiqu").val( id ); 
                }

        });
}

$(function(){



 <?php if(  $DATA['off'] == 1 ){ ?>
                    $("#myonoffswitch").click();
 <?php }?>
                    
                    
              

$('.onoffswitch-label').click(function(){
        var $checkbox=$('#myonoffswitch'),
            _val = $checkbox.val();
        if(_val==='0'){
            $checkbox.val('1');
        }else{
            $checkbox.val('0');
        }
    });

});

</script>