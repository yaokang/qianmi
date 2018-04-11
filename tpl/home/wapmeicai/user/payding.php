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
if( ! $DATAA || $DATAA['uid'] != $USERID ) msgbox( '' , mourl( $CONN['userword'] ) );
$PAYTYPE['0'] = '余额支付';

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
    body{padding-bottom:88px;}
    .mui-input-row{background:#fff;}
    .mui-input-group .mui-input-row:after{left:0px;}
    .mui-card-link{font-size:14px;color:#0BBE06;}
    .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:33px;width:25px;height:33px;}
    .hongjine{ font-size:38px;}
    .zhunti{}
    .mui-icon-refresh{ font-size:88px; }
    .mui-icon-refresh b{font-size:12px;}
    .mui-content{background:transparent;}
    .off0 .mui-card-header b{color:red;}
    .off0 .mui-card-content span{color:blue;}
    .off2 *{color:#aaa;}
    .mui-table-view-cell:after{left:0px;}

    .off0{color:#ccc;}
    .off1{color:blue;}
    .off2{color:green;}
    .off3{color:red;}

    </style>
</head>
<body>
    <header id="header" class="mui-bar mui-bar-nav">

        <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title"><?php echo $DATA['name'];?></h1>


    </header>
    
    <button type="button" class="mui-btn mui-btn-success mui-btn-block" id="paypay" style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >返回用户中心</button>

    <div class="mui-content">


        <ul class="mui-table-view">

            <li class="mui-table-view-cell">

                <span> 订单编号 </span>
                <span class="mui-pull-right" style="color:green;"><?php echo $DATAA['orderid'];?></span>

            </li>
              

             <li class="mui-table-view-cell">

                <span> 订单状态 </span>

                <span class="mui-pull-right off<?php echo $DATAA['off'];?>"><?php echo $PAYOFF[$DATAA['off']]?></span>

            </li>

            <li class="mui-table-view-cell">

                <span> 下单时间</span>
                <span class="mui-pull-right" style="color:REd;"><?php echo date( $CONN['timegeshi'] , $DATAA['atime']);?></span>
                
            </li>

            <li class="mui-table-view-cell">

                <span> 支付方式</span>
                <span class="mui-pull-right paytype<?php echo $DATAA['paytype'];?>" ><?php echo $PAYTYPE[$DATAA['paytype']];?></span>

            </li>
       
            <li class="mui-table-view-cell">
                <span> 支付总价 </span>

                <span class="mui-pull-right" style="color:red;"> <?php echo $HUOBIICO['0'].' '.$DATAA['payjine'];?> </span>
               

            </li>

            <?php 

            if( $DATAA['tongyiid'] != '' && $DATAA['type'] == 2){

        
                $shuj = $D ->where( array('tongyiid' => $DATAA['tongyiid'] ,'type' => 0 ))-> select();

                           


                    if( ! $shuj ) $shuj = array();
                       $D -> setbiao( 'dingdanx' );

                   

                    foreach( $shuj as $woqud ){ 

                    $XQING = $D ->where( array('orderid' => $woqud['orderid'] ))->select();

                    $FAHUODE = array();

                    if( $XQING ){

                      


                        foreach( $XQING as $ONG ){

                            $token = md5( $ONG['biaoshi'].'_'. $ONG['beizhu'] );

                            if( ! isset( $FAHUODE[ $token ] )) $FAHUODE[ $token ] = $ONG['biaoshi'].' '. $ONG['beizhu'];
                        
            ?> 
            <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;">

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
            <?php } } } } ?>

            <?php  if( $DATAA['off'] == 2){ ?>
      
                <li class="mui-table-view-cell">

                    <span> 实际支付 </span>
                    <span class="mui-pull-right" style="color:green;"> <?php echo $HUOBIICO['0'].' '.($DATAA['rejine']);?> </span>
                  
                </li>

                <li class="mui-table-view-cell">
                    <span> 支付时间 </span>
                    <span class="mui-pull-right" style="color:green;"> <?php echo date( $CONN['timegeshi'] , $DATAA['xtime']);?></span>

                </li>

            <?php } ?>

        </ul>
    </div>




</body>
</html>
<?php include QTPL .'foot.php';?>

<script>
$("#paypay").click( function(){

mui.toast ('loading...' ,{ duration:500,url: USERUL    });

});

</script>