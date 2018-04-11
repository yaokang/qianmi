<?php if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT');

$D     = db( 'msgbox' );
$YESNO = logac('yesno');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo TPL;?>js/lib/html5.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/lib/respond.min.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?php echo TPL;?>js/kindeditor/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>js/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>h-ui/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>h-ui/css/style.css" />
<script type="text/javascript" src="<?php echo TPL;?>js/kindeditor/kindeditor-all-min.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/kindeditor/lang/<?php echo $CONN['htlang']?>.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo TPL;?>js/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title><?php echo $LANG['adminac'][$_GET['action']];?></title>
<script>
var updateurl='<?php echo $_SERVER['SCRIPT_NAME'];?>?action=<?php echo $AC;?>&mode=edit&uplx=image&dir=image';
</script>
</head>
<body>
<style>
.td-manage .Hui-iconfont{font-size:22px;}
</style>
<nav class="breadcrumb">

    <i class="Hui-iconfont">&#xe67f;</i> <?php echo $LANG['home']?> 
    <span class="c-gray en">&gt;</span>  <?php echo $LANG['adminac'][$_GET['action']];?>
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="<?php echo $LANG['shuaxin'];?>" > <i class="Hui-iconfont"> &#xe68f; </i> </a> 

</nav>


<?php if( isset( $_GET['mode'])){

         
        $ID   = (float)(isset($_GET['id']) ? $_GET['id'] : 0);
        $DATA = array();


        if( $_GET['mode'] == 'del'){

            if(!yztoken('token',$AC)) msgbox( $LANG['token'], '0');
            $WHERE['id']  =  $ID;
                        
            $DATA = $D ->where( $WHERE )-> find();

            if(! $DATA ) adminmsgbox($LANG['shujuno']);

            $DATAS = $D ->where($WHERE) -> delete();

            if( $DATAS){

                     adminlog($USER['id'], 4 , serialize( array( 'ac' => $AC , 'mo' => $MO , 'id'=> $ID,'yuan'=> $DATA  )));

                     msgbox( $LANG['yishanchu'] , '1');
               
            }else msgbox( $LANG['shanchusb'] , '0');




        }else if( $_GET['mode'] == 'add'  || $_GET['mode'] == 'edit'){



            if( isset($_GET['uplx']) ){    

                 $_GET['uplx'] = isset($_GET['uplx'])?$_GET['uplx']:'image';

                 $DATAS = update($USER['id']);

                 if(  $DATAS['code'] == 1 )  exit( json_encode( array('error' => 0 , 'url' =>  $DATAS['content']['pic']) ));
                 else exit( json_encode( array('error' => 1 , 'message' =>  $DATAS['msg']) ));

            }

            $WHERE['id'] = $ID;


            if( $_GET['mode'] == 'edit' ) $DATA = $D ->where( $WHERE ) ->find();


            if( isset( $_POST['submit'])){
                     
                    if( !yztoken( 'token' , $AC.$MO ) ) msgbox( $LANG['token'], '?'.getarray( $_GET));

                    if( $_GET['mode']  == 'add'){

                        $_POST['atime'] = time();
                        $_POST['ip'] = $IP;

                        $fanhui = $D  -> insert($_POST);

                        if( $fanhui){ 

                            adminlog($USER['id'], 5 , serialize( array( 'ac' => $AC , 'mo' => $MO ,'id'=> $fanhui ,'data'=> $_POST  )));

                            adminmsgbox( $LANG['add'].$LANG['chenggong'] );
                         
                        }else msgbox( $LANG['add'].$LANG['shibai'], '?'.getarray( $_GET));
                    
                    
                    
                    }else if( $_GET['mode']  == 'edit'){

                        $_POST['ctime'] = time();

                        $fan = $D ->where( $WHERE )-> update( $_POST);

                        if( $fan){ 
                  
                            adminlog($USER['id'], 3 , serialize( array( 'ac' => $AC , 'mo' => $MO , 'id'=> $ID,'yuan'=> $DATA, 'data'=> $_POST )));

                            adminmsgbox( $LANG['edit'].$LANG['chenggong']);

                        }else  adminmsgbox( $LANG['edit'].$LANG['shibai']);
                    }


  
            }










            if( $_GET['mode'] == 'add' ){ 

                $shua = $D -> tablejg['1'];

                foreach( $shua as  $k=> $v ){  
                    
                    if($v =='auto_increment');
                    else{ 

                         $DATA[ $k ] = str_replace($k.'_','',$v);
                    }
                }
            }

/*


type      消息的类型

*/
            $cccc = array(
                       'uid' => '接收用户uid',
                      'fuid' =>  '发送uid',
                       'cid' => '回复关联id',
                      'name' => '消息标题',
                      'type' => '消息的类型#select#'.logacto('msgbox'),
                       'off' => $LANG['off'].'#select#'.logacto('off'),
                     'yuedu' => '阅读#select#'.logacto('yesno'),
                   'neirong' => '消息内容#ui#300px;',
                    'tupian' => '消息图片#imgupdate',
                  'tupianji' => '消息图片集合#imgtuji2',
                    'fscoff' => '发送人删除#select#'.logacto('yesno'),
                    'sscoff' => '收件人删除#select#'.logacto('yesno'),
                    
                     'atime' => '评论时间#time',
                     'ctime' => '更改时间#time',
                        'ip' => 'IP#show'
            );
            $_SESSION[$AC.$MO] = token();

        ?>
        <style>
.yddddd{margin-top:3px;display:block;}

.gioge li {border:1px solid #ccc;margin-bottom:20px;padding:10px;}
.gioge li p input{margin-bottom:5px;}

.gioge .Hui-iconfont{font-size:18px;display:inline-block;}
.gioge > li:first-child p   label{width:100%;}

.gioge li p  label{float:left;width:198px;}

.table th, .table td{padding:0px 8px;line-height: 12px;font-size:12px;}
</style>
<article class="page-container">
    <form  method="post" class="form form-horizontal" id="form-admin-role-add" enctype="multipart/form-data" >
    <input type="hidden" name="token" value="<?php echo $_SESSION[$AC.$MO];?>" />
    <?php if( $_GET['mode']  == 'edit' ){ ?>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> id：</label>
            <div class="formControls col-xs-8 col-sm-9">
                 <span class="yddddd"> <?php echo $DATA['id'];?> </span>
            </div> 
        </div>
    <?php }

        foreach( $cccc as $wk => $wv ){ 
            echo  houtaifenjie( $wv, $wk , (isset( $DATA[$wk] ) ? $DATA[$wk]:'' ) , $LANG['placeholderyes']);
        }
            
    ?>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" name="submit" type="submit" value="&nbsp;&nbsp;<?php echo $LANG[ $_GET['mode'] ];?>&nbsp;&nbsp;">
            </div>
        </div>

    </form>

</article>
<?php } ?>
 
<?php }else{ 


    $PAGE  = (int) isset( $_GET['page']) ? $_GET['page'] : 0;

    $limit = listmit( $CONN['hnum'] ,$PAGE);

    $ZSHU = $D ->where( $WHERE ) -> total();

    $DATA = $D ->order( 'id desc' )->where( $WHERE )-> limit( $limit )-> select();

    $_SESSION[$AC] = token();

    if(! $DATA) $DATA = array();

?>
<style>
.td-manage  .Hui-iconfont{font-size:22px;}
.yueoff0{color:red;}
.yueoff1{color:green;}
</style>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
    <span class="l"> <a href="javascript:;" onclick="product_edit('<?php echo $LANG['add'] ?>','?<?php  echo 'action=',$AC,'&mode=add'.(isset($_GET['cid']) && $_GET['cid']!= ''?'&cid='.$_GET['cid'] :'')?>')"  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> <?php echo $LANG['add'];?> </a> 
    </span>
    <span class="r"> <?php echo $LANG['gongyou'];?> <strong id="tiaoshu"><?php echo $ZSHU;?></strong>  </span>
</div>




  <div class="mt-20">

    <table class="table table-border table-bordered table-hover table-bg table-sort td-manage">

        <thead>

            <tr class="text-c">
                <th width="130"> ID </th>
                <th> 指定接收人 </th>
                <th> 指发定送人 </th>
                <th> 消息标题 </th>
                <th> 阅读状态 </th>
                <th> <?php echo $LANG['atime'];?> </th>
                <th> <?php echo $LANG['caozuo'];?> </th>

            </tr>

        </thead>

        <tbody>

        <?php if( $DATA){
              
              $UUID = array('<span style="color:Red;">(无)</span>');
                foreach( $DATA as $ONG){ 

                    if( !isset( $UUID[$ONG['uid']])){
			 
				         $zhi = uid($ONG['uid']);

				        $UUID[$ONG['uid']] = $zhi['name'].' <span style="color:Red;">('.$zhi['uid'].')</span>';
			        }

                    if( !isset( $UUID[$ONG['fuid']])){
			 
				         $zhi = uid($ONG['fuid']);

				        $UUID[$ONG['fuid']] = $zhi['name'].' <span style="color:Red;">('.$zhi['fuid'].')</span>';
			        }
                    
                    
                    ?>

                    <tr class="text-c">

                        <td><?php echo $ONG['id']?></td>
                        <td><?php echo $UUID[$ONG['uid']];?></td>
                        <td><?php echo $UUID[$ONG['fuid']];?></td>
                        <td>
                            <input type="text" class="input-text  size-M" name="name" value="<?php echo $ONG['name']?>"  />
                        </td>

                        <td> <span class="yueoff<?php echo $ONG['yuedu']?>"> <?php echo $YESNO[$ONG['yuedu']]?></span></td>

                        <td> <?php echo $ONG['atime'] > 0? ' <span style="color:blue;">'.date('Y-m-d H:i:s',$ONG['atime']).'</span> ':'No Time' ;?></td>

                        <td>
                                <a title="<?php echo $LANG['edit'] ?>" href="javascript:;" onclick="product_edit('<?php echo $LANG['edit'] ?>','?<?php  echo 'action=',$AC,'&mode=edit&id='.$ONG['id'];?>','<?php echo $ONG['id']?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 

                                <a title="<?php echo $LANG['del'];?>" href="javascript:;" onclick="admin_del(this,<?php echo $ONG['id']?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont" style="color:red;">&#xe6e2;</i></a>

                         </td>

                    </tr>

            <?php }  } ?>
         </tbody>

      </table>

   </div>

</div>

<div class="page">

<?php if( $ZSHU > $CONN['hnum'] ){

        $get = array('uid','shid','orderid','guan','cpid','off','guan','pingoff');
        $ZUU = array();
        foreach( $get as $v ) $ZUU[$v] = !isset( $_GET[$v]) ? '' : $_GET[$v];

        echo pagec( $LANG['PAGE'], $CONN['hnum'], $ZSHU, $CONN['hpage'], $PAGE, '?action='.$_GET['action'].'&page=', '&'.getarray( $ZUU ) ); 
}?>

</div>
<?php  include HTPL.'foot.php'; } ?>
<script type="text/javascript" src="<?php echo TPL;?>js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>h-ui/js/layer.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>h-ui/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>js/lib/Validform.min.js"></script>
<script type="text/javascript">
var token ='<?php echo $_SESSION[$AC]?>';
function product_edit(title,url){

        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });

        layer.full(index);

}

function admin_del(obj,id){

        layer.confirm('<?php echo $LANG['shanchumsgbox'];?>',{title:'<?php echo $LANG['msgbox'];?>',btn:<?php echo json_encode($LANG['msboxbtn']);?>},function(index){
          
              $.getJSON('?action=<?php echo $AC;?>&mode=del&ajson=1&token=' + token + '&id='+id,{},function(data){

                  if(data.token) token = data.token;
              
                  if(data.code == 1){

                       $(obj).parents("tr").remove();

                       shu = $("#tiaoshu").html() *1;

                       $("#tiaoshu").html( shu -1 );

                       layer.msg('<?php echo $LANG['yishanchu'];?>',{icon:1,time:1000});

                  }else  layer.msg( data.msg ,{ icon: 2 ,time : 1000});

              });

        });
}

</script>
</body>
</html>