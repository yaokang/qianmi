<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');?>
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
    .mui-table-view-cell:after{left:0px;}
    .xuzejine{}

    .xuzejine li{height:70px;line-height:70px;}
    .xuzejine li span{height:56px;line-height:56px;display:block;text-align:center;width:88%;margin:7px auto;border:1px solid #c8c7cc;border-radius:6px;color:#077604;font-size:22px;}

    .xuzejine li.mui-selected span{border:1px solid red;color:#0BBE06;}

    .xuzejine li input{width:88%;height:56px;line-height:56px;font-size:14px;border-radius:6px;}
    .xuzejine li.mui-selected input{border:1px solid red;}

    </style>
</head>
<body style="padding-bottom:66px;">

       

    <header id="header" class="mui-bar mui-bar-nav">

        <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title">充值</h1>
        <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'jine');?>" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">记录</a>
    </header>

   
        <button type="button" class="mui-btn mui-btn-success mui-btn-block" id="paypay" style="height:50px;line-height:50px;padding:0px;margin:1%;width:98%;position:fixed;bottom:0px;z-index:999;" >立 即 充 值</button>
   
    <div class="mui-content" style="background:transparent;padding-top:40px;">

        <ul class="mui-table-view mui-table-view-radio">
            <?php  
                $PAY = xitongpay( '0' );
                if( $PAY ){ 
                    $z = 0;
                    echo '<input type="hidden" name="paytype" value="'.$PAY['0']['id'].'">';
                    foreach( $PAY as $ONG ){
            ?><li class="mui-table-view-cell<?php echo $z=='0'?' mui-selected':'';?>" data="<?php echo $ONG['id']?>">
                <a class="mui-navigate-right">
                  <img src="<?php echo pichttp($ONG['suoluetu']);?>" style="height:30px;float:left;">
                  <b style="float:left;height:30px;line-height:30px;margin-left:5px;font-weight:normal;"><?php echo $ONG['name'];?></b>
                </a>
            </li><?php $z++; } } ?>
        </ul>

        <input type="hidden" name="zhifue" value="10">



        <ul class="mui-table-view mui-grid-view mui-grid-9 xuzejine" style="background:#fff;pdding:0px;margin-top:10px;">

            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-selected" data="10" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>10</span>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4" data="20" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>20</span>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4" data="50" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>50</span>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4" data="100" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>100</span>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4" data="300" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>300</span>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4" data="500" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>500</span>
            </li>
             <li class="mui-table-view-cell mui-media mui-col-xs-4" data="1000" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>1000</span>
            </li>
             <li class="mui-table-view-cell mui-media mui-col-xs-4" data="2000" style="border-color:#fff;padding:0px;">
                <span><?php echo $HUOBIICO['0']?>2000</span>
            </li>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;">
                    <input type="text" value="" class="qijine" placeholder="<?php echo $HUOBIICO['0']?> 其他金额" />
            </li>

        </ul>

    </div>

</body>
</html>
<?php 
$_SESSION['paydd'] = time();
include QTPL.'foot.php';
?>
<script>


$(function(){
   
   $(".mui-table-view-radio li").click(function(){
   
        data = $(this).attr('data');
        $( "[name=paytype]" ).val( data );
       
   
   });


    $(".xuzejine li").click(function(){

        jine = $(this).attr('data');
        $( "[name=zhifue]" ).val( jine );
        $(".xuzejine li").removeClass('mui-selected');
        $(this).addClass('mui-selected');

        

    });


    $(".qijine").change(function(){

        var shuliang = $(this).val() * 1;
        if( isNaN( shuliang ) ) shuliang = 1;
        if( shuliang <0.01) shuliang = 1;

        $(this).val( shuliang );

        $( "[name=zhifue]" ).val( shuliang );

    });


    $("#paypay").click( function(){

        mui.closePopup();

        var jine    = $("[name=zhifue]") .val();
        var paytype = $("[name=paytype]").val();

        mui.toast ('订单提交中...' ,{ duration:500,url: HTTP +'pay.php?y=pay&jine='+ jine + '&paytype='+ paytype  });

    });


});
</script>