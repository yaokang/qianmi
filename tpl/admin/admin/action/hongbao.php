<?php if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT');

$D = db('hongbao');
$hongbaooff = logac('hongbaooff');
$hongbaotype = logac('hongbaotype');
$hongbaofanwei = logac('hongbaofanwei');
$ICO = array( '&#xe6e1;',
              '&#xe6e0;',
              '&#xe690;',
              '&#xe631;'

        );
$JINLOG = logac('jinelog');


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
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>js/webuploader/webuploader.css" />
<script type="text/javascript" src="<?php echo TPL;?>js/kindeditor/kindeditor-all-min.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/kindeditor/lang/<?php echo $CONN['htlang']?>.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo TPL;?>js/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
<script src="http://cache.amap.com/lbs/static/es5.min.js"></script>
<script src="http://webapi.amap.com/maps?v=1.4.5&key=674820a4021d581cd3fbc1e4ca2e06ca"></script>
<script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
<style>
</style>
<title><?php echo $LANG['adminac'][$_GET['action']];?></title>
</head>
<body>
<?php 
   
    $CONN['hnum'] = 10;

    $PAGE  = (int) isset( $_GET['page']) ? $_GET['page'] : 0;

    $ORDER = 'id desc';

    $limit = listmit( $CONN['hnum'] ,$PAGE);

    if( isset( $_GET['fenqu']) && $_GET['fenqu'] !='' )$WHERE['sid'] =  $_GET['fenqu'];

    if( isset( $_GET['type']) && $_GET['type'] !='' )$WHERE['uid'] =  $_GET['type'];

    if( isset( $_GET['type2']) && $_GET['type2'] !='' )$WHERE['off'] =  $_GET['type2'];

    if( isset( $_GET['start']) && $_GET['start'] != '') $WHERE[ 'atime >='] = strtotime( $_GET['start']);

    if( isset( $_GET['end']) && $_GET['end'] != '') $WHERE[ 'atime <='] = strtotime( $_GET['end']);

    $ZSHU = $D ->where( $WHERE ) -> total();

    $DATA = $D ->where( $WHERE )-> limit( $limit )->order( $ORDER )-> select();


    if(! $DATA) $DATA = array();

    if(isset($_GET['mode']) && $_GET['mode'] == 'add' && isset($_POST['token'])){

        $_POST['atime'] = time();

        if($_POST['mima'] != ''){

            $_POST['mima'] = mima($_POST['mima']);

            $_POST['ispass'] = 1; 

        }else{

            $_POST['ispass'] = 0;

        }

        $fanhui = $D->insert($_POST);

        if( $fanhui){ 

            unset( $_POST['submit']);

            adminlog($USER['id'], 5 , serialize( array( 'ac' => $AC , 'mo' => $MO ,'id'=> $fanhui ,'data'=> $_POST  )));

            adminmsgbox( $LANG['add'].$LANG['chenggong'] );
         
        }else msgbox( $LANG['add'].$LANG['shibai'], '?'.getarray( $_GET));

    }elseif(isset($_GET['mode']) && $_GET['mode'] == 'del'){

        //p($_GET);die;

        if(!yztoken('token',$AC)) msgbox( $LANG['token'], '0');

        $ID = (int) ( isset( $_GET['id'])? $_GET['id']:0);

        $WHERE['id']  =  $ID;
        
        $DATA = $D ->where( $WHERE )-> find();

        if(! $DATA ) adminmsgbox($LANG['shujuno']);

        $DATAS = $D ->where($WHERE) -> delete();

        if( $DATAS){

                 adminlog($USER['id'], 4 , serialize( array( 'ac' => $AC , 'mo' => $MO , 'id'=> $ID,'yuan'=> $DATA  )));

                 msgbox( $LANG['yishanchu'] , '1');
           
        }else msgbox( $LANG['shanchusb'] , '0');

    }


?>

<?php 

    if(isset($_GET['mode']) && $_GET['mode'] == 'edit'){

        $id  = $_GET['id'];

        $DATA = $D->where(array('id' => $id))->find();

        $USER = uid($DATA['uid']);
?>
<style>
.yddddd{margin-top:3px;display:block;}
.blue{color:blue;}
.red{color:red;}
.green{color:green;}
.orange{color:orange;}

</style>
<article class="page-container">
    <div id="tab-system" class="HuiTab">
        <form  method="post" class="form form-horizontal" id="form-admin-role-add" enctype="multipart/form-data" >
            <input type="hidden" name="token" value="<?php echo $_SESSION[$AC.$MO];?>" />
            <input type="hidden" name="xibiao" value="<?php echo isset($_POST['xibiao'])? $_POST['xibiao'] : 0;?>" />

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> ID：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd"> <?php echo $DATA['id'];?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 用户名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd blue"> <?php echo $USER['name']?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包金额：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd green"> <?php echo $DATA['hongbaojine']?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包剩余金额：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="yddddd red"> <?php echo $DATA['shengyujine']?> </span>
                </div> 
            </div>

             <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包数量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd"> <?php echo $DATA['num']?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包描述：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="yddddd"> <?php echo $DATA['miaoshu']?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div style="border:0 1px grey;">
                        <img src="<?php echo $DATA['tupian']?>" alt="" height=200px; style="margin-left: 10px;">
                    </div>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包定位：</label>
                <div class="formControls col-xs-8 col-sm-9" style="height: 300px; width: 800px;">
                    <div id="container"></div>
                </div> 
            </div>

            <script>
                var map = new AMap.Map('container', {
                    pitch:75,
                    viewMode:'3D',
                    zoom: 17,
                    expandZoomRange:true,
                    zooms:[3,20],
                    center:[119.97857,31.81457],
                });

                marker = new AMap.Marker({
                    icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
                    position: [119.97857,31.81457]
                });
                marker.setMap(map);

            </script>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包范围：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="yddddd"> <?php echo $hongbaofanwei[$DATA['fanwei']]?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包类型：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="yddddd orange"> <?php echo $hongbaotype[$DATA['type']]?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包状态：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="yddddd <?php echo $DATA['off'] == 0 ? 'green' : 'red';?>"> <?php echo $hongbaooff[$DATA['off']]?> </span>
                </div> 
            </div>
            
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包链接：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd blue"> <?php echo $DATA['lianjie']?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包发放时间：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd"> <?php echo date('Y-m-d H:i:s',$DATA['atime'])?> </span>
                </div> 
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"> 红包抢完时间：</label>
                <div class="formControls col-xs-8 col-sm-9">
                     <span class="yddddd"> <?php echo date('Y-m-d H:i:s',$DATA['jtime'])?> </span>
                </div> 
            </div>
        </form>
    </div>
</article>

<?php }elseif(isset($_GET['mode']) && $_GET['mode'] == 'add'){ 



?>

<article class="page-container">
    <div id="tab-system" class="HuiTab">
        <form  method="post" class="form form-horizontal" id="form-admin-role-add" enctype="multipart/form-data" >
            <input type="hidden" name="token" value="<?php echo token();?>" />

            <?php 
                foreach($LANG['hongbaoother'] as $wk => $wv){
                    echo houtaifenjie( $wv, $wk , (isset( $DATA[$wk] ) ? $DATA[$wk]:'' ) , $LANG['placeholderyes']);
                }

            ?>

            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" name="submit" type="submit" value="&nbsp;&nbsp;<?php echo $LANG[ $_GET['mode'] ];?>&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </div>
</article>

<?php }else{?>
 <nav class="breadcrumb"> <i class="Hui-iconfont">&#xe67f;</i> <?php echo $LANG['home']?> <span class="c-gray en">&gt;</span> <?php echo $LANG['adminac'][$_GET['action']];?> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="<?php echo $LANG['shuaxin'];?>" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <div class="text-c"> 
        <form method="get">
            <input type="hidden" value="<?php echo $AC;?>" name="action" />
            <span class="select-box" style="width:108px">
                 <select name="type2" class="select"> <option value=""> <?php echo $LANG['allquan'];?></option> <?php echo ywselect($hongbaooff, isset($_GET['type2']) ?$_GET['type2']:'');?> </select> 
            </span>
            <input type="text" name="start"  value="<?php echo isset($_GET['start']) ?$_GET['start']:'';?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',lang:'<?php echo $CONN['htlang']?>'})" id="datemin" class="input-text Wdate" style="width:168px;">
            -
            <input type="text" name="end" value="<?php echo isset($_GET['end']) ?$_GET['end']:'';?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d',dateFmt:'yyyy-MM-dd HH:mm:ss',lang:'<?php echo $CONN['htlang']?>'})" id="datemax" class="input-text Wdate" style="width:168px;">

            

            <input type="text" class="input-text" style="width:100px" placeholder="<?php echo $LANG['uid']?>"  name="type" value="<?php echo isset( $_GET['type']) ? $_GET['type'] : '';?>">

            

            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> <?php echo $LANG['sousuo'];?></button>

        </form>
    </div>
<style>
i.ysss0{color:green;}
i.ysss1{color:#9900FF;}
i.ysss2{color:#5a98de;}
i.ysss3{color:red;}

</style>


 <div class="cl pd-5 bg-1 bk-gray mt-20"> 
<span class="l"> <a href="javascript:;" onclick="product_edit('新增','?action=hongbao&amp;mode=add')"  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> <?php echo $LANG['add'];?> </a> 
    </span>
    <span class="r"> <?php echo $LANG['gongyou'];?> <strong id="tiaoshu"><?php echo $ZSHU;?></strong>  </span>
 
 </div>


<div class="mt-20">

    <table class="table table-border table-bordered table-hover table-bg table-sort">
         <thead>

            <tr class="text-c">
                <th> ID </th>
                
                <th> 用户名 </th>
                    
                <th> 红包金额 </th>

                <th> 红包剩余金额 </th>
                
                <th> 红包数量 </th>
            
                <th> 红包类型 </th>

                <th> 红包状态 </th>

                <th> 红包发放时间 </th>

                <th> 操作 </th>
                
            </tr>
        </thead>
      <tbody>
 <?php 
 
 $_SESSION[$AC] = token();

 if( $DATA){

        $UUID = array();
        
        foreach( $DATA as $ONG){ 
            
            $user = uid($ONG['uid']);
                          
                        
    ?>
        <tr>  
            <td style="text-align: center;"> <?php echo $ONG['id']?> </td>    
            <td style="text-align: center; color:blue;"> <?php echo $ONG['uid'] == 0 ? '系统发布' : $user['name']?> </td>
            <td style="text-align: center; color:red;"> <?php echo $ONG['hongbaojine']?> </td>
            <td style="text-align: center; color:green;"> <?php echo $ONG['shengyujine']?> </td>
            <td style="text-align: center; color:orange;"> <?php echo $ONG['num']?> </td>
            <td style="text-align: center;"> <?php echo $hongbaotype[$ONG['type']]?> </td>
            <td style="text-align: center;color:<?php if($ONG['off'] == 0){echo 'grey';}elseif($ONG['off'] == 1){echo 'red';}else{echo 'green';}?>"> <?php echo $hongbaooff[$ONG['off']];?> </td>    
            <td style="text-align: center;"> <?php echo date('Y-m-d H:i:s',$ONG['atime'])?> </td>
            <td style="text-align: center;">
                <a title="编辑" href="javascript:;" onclick="product_edit('编辑','?action=hongbao&amp;mode=edit&amp;id=<?php echo $ONG['id']?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i></a>
                <?php if($ONG['uid'] == 0){?>
                <a title="<?php echo $LANG['del'];?>" href="javascript:;" onclick="admin_del(this,<?php echo $ONG['id']?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont" style="color:green;">&#xe6e2;</i></a>
                <?php }?>
            </td>
        </tr>



<?php  } }else {  ?>
        <tr class="text-c">
            <td colspan="15"> 
                   <span class="label label-warning radius"><?php echo $LANG['noshuju'];?></span>
            </td>
        </tr>
<?php } ?>

         </tbody>
      </table>
   </div>
</div>





<div class="page">

   <?php 
   
   
  
   if($ZSHU > $CONN['hnum']){

            $_GET['guan'] = isset($_GET['guan']) ? $_GET['guan'] :'';
            $_GET['start'] = isset($_GET['start']) ? $_GET['start'] :'';
            $_GET['end'] = isset($_GET['end']) ? $_GET['end'] :'';
            $_GET['fenqu'] = isset($_GET['fenqu']) ? $_GET['fenqu'] :'';
            $_GET['type'] = isset($_GET['type']) ? $_GET['type'] :'';
            $_GET['type2'] = isset($_GET['type2']) ? $_GET['type2'] :'';
     
            echo pagec( $LANG['PAGE'], $CONN['hnum'], $ZSHU, $CONN['hpage'], $PAGE, '?action='.$_GET['action'].'&page=','&guan='.$_GET['guan'].'&start='.$_GET['start'].'&end='.$_GET['end'].'&type='.$_GET['type'].'&type2='.$_GET['type2'].'&fenqu='.$_GET['fenqu'] );
  } 
  
?>


</div>

<?php }?>


<?php include HTPL.'foot.php'; ?>

<script type="text/javascript" src="<?php echo TPL;?>js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>h-ui/js/layer.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>h-ui/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="<?php echo TPL;?>js/lib/Validform.min.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/Switch/bootstrapSwitch.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/webuploader/webuploader.js"></script>
<script type="text/javascript" src="<?php echo TPL;?>js/My97DatePicker/WdatePicker.js"></script>

<script>
    var token ='<?php echo $_SESSION[$AC]?>';

    function product_edit(title,url){

        var index = layer.open({
            type: 2,
            title: title,
            content: url,
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