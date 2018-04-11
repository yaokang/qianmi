<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');
$PAGE = 1;

$FAOFF   = logac('faoff');
$ORDERID = isset( $HTTP['2'] ) ? $HTTP['2'] : '';
$KUOMO   = isset( $HTTP['3'] ) ? $HTTP['3'] : 'cha';

 $FAOFF = logac('faoff');
$PAYOFF = logac('payoff');

$PAYTYPE = xitongpay('-1');

if( $ORDERID == '' ) msgbox( '' , mourl( $CONN['userword'] ) );
$D = db('dingdan');

$DATAA = $D ->where( array( 'orderid' => $ORDERID) )-> find();
if( ! $DATAA || $DATAA['uid'] != $USERID || $DATAA['type'] != '0' || $DATAA['off'] != 2 ) msgbox( '无法评论' , mourl( $CONN['userword'] ) );
if( $DATAA['faoff'] < 3) msgbox( '无法评论' , mourl( $CONN['userword'] ) );
$PAYTYPE['0'] = '余额支付';

$pingoff = logac('off');

function fenjiexi( $ni ){

    $ZIFU = (int) $ni;

    if( $ZIFU  < 1)  $ZIFU = 1 ;

    $sy =5-$ZIFU;
    $X ='';

    if( $sy > 0 )$X = str_repeat( '<i class="glyphicon  mui-icon mui-icon-star-filled"></i>', $sy);
   
    return str_repeat( '<i class="glyphicon  mui-icon mui-icon-star-filled" style="color:Red;"></i>',$ZIFU).$X;

}

function fenxing( $zhif ){

    switch( $zhif ) {

        case 1 : return '一';break;
        case 2 : return '二';break;
        case 3 : return '三';break;
        case 4 : return '四';break;
        case 5 : return '五';break;
        default: return '一';break;
    }

}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>js/webuploader/webuploader.css" />
<style>
.webuploader-pick{background:Red;}

.glyphicon {font-size:18px;}
.thumbnail{float:left;margin-left:5px;}

.mui-table-view-cell:after{left:0px;}
  body{padding-bottom:88px;background:#fff;}
</style>
</head>
<body>

    <header id="header" class="mui-bar mui-bar-nav">

        <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'myding');?><?php echo mourl( $CONN['userword'].$CONN['fenge'].'myding');?>"></a>
        <h1 class="mui-title"><?php echo $DATA['name'];?></h1>
        <a href="<?php echo mourl( $CONN['userword']);?>" style="padding:0px;margin:0px;font-size:25px;" class="mui-icon mui-icon-contact mui-btn-link mui-pull-right"></a>

    </header>


    

    <div class="mui-content" id="m-order">
        <ul class="mui-table-view">
           
           
              

                        <?php
                        
                            $D -> setbiao( 'dingdanx' );
                            $XQING = $D ->where( array('orderid' => $DATAA['orderid'] ))->select();

                            $FAHUODE = array();


                            $tubiao = 0;
                            



                            if( $XQING ){



                                foreach( $XQING as $ONG ){

                                    $token = md5( $ONG['biaoshi'].'_'. $ONG['beizhu'] );

                                    if( ! isset( $FAHUODE[ $token ] )) $FAHUODE[ $token ] = $ONG['biaoshi'].' '. $ONG['beizhu'];
                        
                        ?>  <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;">

                <img class="mui-media-object mui-pull-left" src="<?php echo pichttp( $ONG['tupian']);?>" style="max-width:100px;width:100px;height:100px;">
                <div class="mui-media-body">
                
                    <span class="mui-pull-left" style="width:80%;"><?php echo $ONG['name']?></span>
                    
                    <button class="mui-btn-danger mui-btn-outlined mui-pull-right" style="width: 50px; padding: 4px;font-size:12px;" onclick="window.location.href='<?php echo WZHOST.'api.php?action=tiao&id='.$ONG['cpid']?>'" > 详情 </button>

                    <p class="mui-ellipsis mui-pull-left" style="margin-top:20px;width:100%;">
                        <span class="list-col-orange mui-pull-left" style="color: #ff7400;">
                            <?php echo $HUOBIICO[$ONG['huobi']].$ONG['jine']?>
              
                            <b style="color: #999;display:block;font-weight:normal;"><?php echo str_replace( '_',' ',$ONG['canshu'] );?></b>
                        </span>
                        <button class="mui-btn-success guigexuan mui-pull-right" > X <?php echo $ONG['num']?> </button>
                    </p>

                </div>
                
                
            </li>
                            
                            <li class="mui-table-view-cell"> <p class="pingfen">商品评分: <?php echo fenjiexi( $ONG['miaosufen'] );?> <b class="fenmiao"> <?php 
                            
                           
                            
                            switch( $ONG['miaosufen'] ) {
                            case 1 : echo '失望 一星';break;
                            case 2 : case 3 : echo '一般 '.fenxing( $ONG['miaosufen']).'星';break;
                            case 4 : case 5 : echo '很好 '.fenxing( $ONG['miaosufen']).'星';break;
                            default:echo '一般 '.fenxing( $ONG['miaosufen']).'星';break;
                            
                            }   
                            
                            ?></b> <?php echo $pingoff[$ONG['pingoff']];?> <input class="pifesu" type="hidden" name="pingfen[<?php echo $ONG['id'];?>]" data="<?php echo $ONG['id'];?>" value="<?php echo $ONG['miaosufen'];?>" /> </p> 
                            
                            <div class="row mui-input-row">
					
                              <textarea contenteditable="true"  placeholder="请详细描述你的问题和意见..." maxlength="100"  name="miaoshu[<?php echo $ONG['id'];?>]" style="height:100px;font-size:12px;" class="mmmshu mui-input-clear question" data="<?php echo $ONG['id'];?>"><?php echo $ONG['miaoshu'];?></textarea> 
				</div>



                            <p style="clear:both;"> </p>
                              
                            <div id="image-list" class="row image-list">
                            
                            
                            
                           

                             <div id="uploader-demo<?php echo $ONG['id'];?>" style="clear:both;" >
    <!--用来存放item-->
    <div id="fileList<?php echo $ONG['id'];?>" class="uploader-list" style="clear:both;">

    <?php

    $TUPIAN = array();

    if(  $ONG['ptupianji'] != '' ){

        $TUPIAN = unserialize( $ONG['ptupianji'] );
        
    
    }else{ 

        $DATAAS = $D -> setbiao('fujian') -> where(array( 'uid' => $USERID ,'type' => 2 ,'guanid' => $ONG['id'] )) -> select();
        if($DATAAS ){
        
         foreach( $DATAAS as $zhi ){
         
           $TUPIAN[] = $zhi['pic'];
         
         }
        }

    }

  

    if(  $TUPIAN ){

        foreach( $TUPIAN as $tuu ){


            echo '<div id="WU_FILE_'.$tubiao.'bbbc" class="file-item thumbnail"> <img src="'.( $tuu ).'" style="width:100px;height:100px;"><div class="info">'
            .$tubiao.'.png</div></div>';
        


        $tubiao++;
        }
        
        
    }

    
    ?>
    
                

    </div>
    <div id="filePicker<?php echo $ONG['id'];?>" style="clear:both;">晒图片</div>

     </div>
</div>
   </li>

                        <?php } } ?>

                  
                
         
           







        </ul>
    </div>

        <?php 

        if( $DATAA['faoff'] == '3' && $ONG['pingoff'] == '0' ) { ?>

        <button type="button" class="mui-btn mui-btn-success mui-btn-block" onclick="return shouhuo();"style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >提交评价</button>



        <?php } ?>
 </body>
 </html>
<script src="<?php echo TPL; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TPL; ?>h-ui/js/layer.js"></script> 
<script type="text/javascript" src="<?php echo TPL; ?>js/webuploader/webuploader.js"></script>


<script type="text/javascript">
var PAYFF = 0;
var xiaid = '<?php echo $DATAA['orderid'];?>';
 TOKEN    = '<?php echo  wenyiyz( 'ding/'.$USERID ,  '' , $Mem );?>';
var HTTP  = '<?php echo WZHOST;?>';


function shouhuo(){

    pingfen ={};
    miaoshu ={};
    $i= 0;
    
    ketjia = false;

    $(".pifesu").each(function(){

  
    
        tahzi = $(this).val();
        id    = $(this).attr('data');
        pingfen[id] = tahzi;

        if(tahzi == '' ||  tahzi < 1){
            

            layer.msg( '请选择评分' , { time: 1000 });


             ketjia = true;
        
       
        }


    });

    $(".mmmshu").each(function(){

  
    
        tahzi = $(this).val();
        id    = $(this).attr('data');

        if(tahzi == '' ){
            

            layer.msg( '评价商品,不能为空' , { time: 1000 });


             ketjia = true;
        
      
        }


        miaoshu[id] = tahzi;

    });

    if( ketjia ) return false;



    

    $.post( HTTP + "json.php",{y:'pinglun',d:'post',orderid:xiaid,ttoken: TOKEN,pingfen:pingfen,miaoshu:miaoshu}, function( data ) {

        if( data.token && data.token != '') TOKEN = data.token;

        if(data.code == 1){

             layer.msg( '评论成功' , { time: 1000,url:'<?php echo mourl( $CONN['userword'].$CONN['fenge'].'pinglun'.$CONN['fenge'].$ORDERID);?>' });

        }

    }).error(function( data ){

        if( data.responseJSON  ){

            DATA = data.responseJSON;


        }else if( data.responseText ){

            DATA = eval('('+data.responseText +')');

        }else DATA = {};


        if( DATA.token && DATA.token != '') TOKEN = DATA.token;


        if( DATA.msg )
            layer.msg( DATA.msg , { time: 1000 });
        else  layer.msg( '数据错误' , { time: 1000 });

    });
}


function woqu(){

    $(".thumbnail img").click( function(){


      tongji = $(this).parent('div');
    
    
    img = $( this ).attr("src");


    $.post( HTTP + "json.php",{y:'pinglun',d:'put',orderid:xiaid,ttoken: TOKEN,pic:img}, function( data ) {

            if( data.token && data.token != '') TOKEN = data.token;

            if(data.code == 1){

                tongji.remove();

            }else  layer.msg( data.msg , { time: 1000 });

    }).error(function( data ){


        if( data.responseJSON  ){

            DATA = data.responseJSON;


        }else if( data.responseText ){

            DATA = eval('('+data.responseText +')');

        }else DATA = {};


        if( DATA.token && DATA.token != '') TOKEN = DATA.token;


        if( DATA.msg )
            layer.msg( DATA.msg , { time: 1000 });
        else  layer.msg( '数据错误' , { time: 1000 });


    });





 





 
    });

}

function zhuzi( zhif ){

    switch( zhif ) {

        case 1 : return '一';break;
        case 2 : return '二';break;
        case 3 : return '三';break;
        case 4 : return '四';break;
        case 5 : return '五';break;
        default: return '五';break;
    }

}



$(function(){


<?php  if(  $XQING ){


    foreach( $XQING as $ONG ){ ?>

   var uploader<?php echo $ONG['id'];?> = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    fileVal :'image',
    // swf文件路径
    swf:   HTTP+'tpl/js/webuploader/Uploader.swf',

    // 文件接收服务端。
    server: HTTP+'json.php?y=pinglun&d=delete&uplx=image&dir=image&orderid='+xiaid+'&id=<?php echo $ONG['id'];?>&ttoken='+TOKEN,

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker<?php echo $ONG['id'];?>',

    type: 'image/jpeg',

    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    },
    compress:{
         quality: 70,
         preserveHeaders: true,
          type: 'image/jpeg',
         compressSize: 900
    
    }
});

uploader<?php echo $ONG['id'];?>.on( 'fileQueued', function( file ) {
  
    
    $list = $('#fileList<?php echo $ONG['id'];?>');

    var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img style="width:100px;height:100px;">' +
                '<div class="info">' + file.name + '</div>' +
            '</div>'
            ),
        $img = $li.find('img');


    // $list为容器jQuery实例
    $list.append( $li );

    // 创建缩略图
    // 如果为非图片文件，可以不用调用此方法。
    // thumbnailWidth x thumbnailHeight 为 100 x 100
    uploader<?php echo $ONG['id'];?>.makeThumb( file, function( error, src ) {
          
        if ( error ) {
            $img.replaceWith('<span>不能预览</span>');
            return;
        }

        $img.attr( 'src', src );
    }, 100, 100 );
});

uploader<?php echo $ONG['id'];?>.on( 'uploadProgress', function( file, percentage ) {
    
    var $li = $( '#'+file.id ),
        $percent = $li.find('.progress span');

    // 避免重复创建
    if ( !$percent.length ) {
        $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
    }

    $percent.css( 'width', percentage * 100 + '%' );
});

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
uploader<?php echo $ONG['id'];?>.on( 'uploadSuccess', function( file ) {
 
    $( '#'+file.id ).addClass('upload-state-done');
});

// 文件上传失败，显示上传出错。
uploader<?php echo $ONG['id'];?>.on( 'uploadError', function( file ) {
   
    var $li = $( '#'+file.id ),
        $error = $li.find('div.error');

    // 避免重复创建
    if ( !$error.length ) {
        $error = $('<div class="error"></div>').appendTo( $li );
    }



   

    layer.msg( '上传失败' , { time: 1000,  });

    $error.text('上传失败');
});

// 完成上传完了，成功或者失败，先删除进度条。
uploader<?php echo $ONG['id'];?>.on( 'uploadComplete', function( file ) {

    $( '#'+file.id ).find('.progress').remove();
    woqu();

 
});

uploader<?php echo $ONG['id'];?>.on('uploadSuccess', function(files,response){


              if(response.code == 1){


               $( '#'+files.id ).find('img').attr({"src":response.data.pic});

             

                    layer.msg( "成功" , { time: 1000 });

              
              }else{   
                  
                 
                  layer.msg(response.msg, { time: 1000 });

              }
        

   });



<?php }} ?>

        
    $(".pingfen .glyphicon").click(function(){

    $sji = $(this).parent('p');


    $sji.find('.glyphicon').css({color:'#a7a7a7'})
    
        $(this).css({color:'red'});
        j = 0;
        for(var i= 0; i< 5; i++){

            yanse = $sji.find('.glyphicon').eq(i).css('color');

            if( yanse  == 'rgb(255, 0, 0)'){
                j = i;
            }
        }

        $sji.find('.pifesu').val(j+1);

        var miss = '';
        switch( j+1 ) {
                            case 1 : miss = '失望';break;
                            case 2 : case 3 : miss = '一般';break;
                            case 4 : case 5 : miss = '很好';break;
                            default:miss = '一般';break;
                            
        }
        
        $sji.find('.fenmiao').html(miss +' '+ zhuzi(j+1) +'星');
  

    

        if( j > 0){


            for(var i= 0; i< j; i++){

            yanse = $sji.find('.glyphicon').eq(i).css({color:'red'});

            }
        
        
        }


    });
    
    
 


woqu();

 
});

</script>