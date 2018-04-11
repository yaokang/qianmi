<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
dingguoqi( $USERID );
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
    body{}
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
    .off1 .mui-card-header b{color:#4cd964;}
    .off2 *{color:#aaa;}
    .mui-card-header{font-size:14px;}

    .off0{color:#ccc;}
.off1{color:blue;}
.off2{color:green;}
.off3{color:red;}
.faoff0{color:#FFCCFF;}
.faoff1{color:#FFCCCC;}
.faoff2{color:#FFCC66;}
.faoff3{color:#6633CC;}
.faoff4{color:#FF0000;}
.faoff5{color:#99CCFF;}
.faoff6{color:#0066CC;}
.faoff7{color:#CC0033;}
.faoff8{color:green;}


    </style>
</head>
<body>

    <header id="header" class="mui-bar mui-bar-nav">

        <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title"><?php echo $DATA['name'];?></h1>
        <a class="mui-icon mui-icon-mcgwc mui-pull-right" style="margin-right:8px;margin-top:5px;" href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>"> <span class="mui-badge" style="left:70%;top:0px;padding:2px 8px;display:none;">0</span></a>

    </header>

<script id="demo" type="text/html">
{{# mui.each(d, function(index, item){ }}

<div class="mui-card " title="{{ item.id }}">

    <div class="mui-card-header">
        
        <span> 订单:{{ item.orderid }} </span>
        <span class="{{ ( item.off == 2 ? 'faoff'+item.faoff : 'off'+item.off ) }}"> {{ ( item.off == 2 ? item.faoffname : item.offname ) }}</span>
    
    </div>
    <div class="mui-card-content">

        <div class="mui-card-content-inner" >
             <img class="mui-media-object mui-pull-left" src="{{ item.tupian }}" style="max-width:50px;width:50px;height:50px; margin-right:10px;">
            <span class="mui-pull-left" style="width:80%;">{{ item.name }}</span>

              <div class="mui-clearfix"></div>
        </div>

    </div>
    <div class="mui-card-footer"> 
        
        <span>共 <b style="color:red;">{{ item.jianshu }}</b> 件 

            实付款 <?php echo $HUOBIICO['0']?><b style="color:green;">{{ (item.shifu).toFixed(2) }}</b>
        
        </span>

        {{#  if(  item.off < 2 ){ }}

               <button class="mui-btn-danger mui-btn-outlined mui-pull-right" style="padding:3px;font-size:12px;" onclick="window.location.href='{{ item.url }}'" > 立即支付 </button>
                <button class="mui-btn-primary mui-btn-outlined mui-pull-right"  onclick="window.location.href='{{ item.url }}'" style="padding:3px;font-size:12px;" > 查看详情 </button>
        {{# }else if( item.off == 2 && item.faoff == 2){ }}

                <button class="mui-btn-success mui-btn-outlined mui-pull-right"  onclick="window.location.href='{{ item.url }}'" style="padding:3px;font-size:12px;" > 确定收货 </button>

       {{# }else{ }}

                <button class="mui-btn-primary mui-btn-outlined mui-pull-right"  onclick="window.location.href='{{ item.url }}'" style="padding:3px;font-size:12px;" > 查看详情 </button>

        {{#  } }}

    </div>

</div>
{{# }); }}
</script>

    <div class="mui-content">
        <div style="padding: 10px 10px;">

            <div id="segmentedControl" class="mui-segmented-control mui-segmented-control-positive">
                <a class="mui-control-item mui-active" href="#item1" data="1">未完成</a>
                <a class="mui-control-item" href="#item2" data="2">已完成</a>
                <a class="mui-control-item" href="#item3" data="3">已取消</a>
            </div>

        </div>

        <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-12" style="float:right;right:1px;left:auto;top:105px;overflow:hidden;width:100%;border-left: 1px solid #ebebeb;">

            <div class="mui-scroll">
                <div  id="view">

                </div>
            </div>

        </div>

    </div>

</body>
</html>
<?php include QTPL.'foot.php';?>
<script>
var PAGE   = 0;
var WCHE = false;
var LX = 0;

mui.init({

        pullRefresh: {
            container: '#pullrefresh',
            down: {
                callback: pulldownRefresh
            },
            up: {
                contentrefresh: '正在加载...',
                callback: pullupRefresh
            }
        }

});

function chushidata( ){

        /* 初始数据  */

        mui('#pullrefresh').pullRefresh().refresh(true);
        mui('#pullrefresh').pullRefresh().endPullupToRefresh(false);
        mui('#pullrefresh').pullRefresh().scrollTo(0,0,100);

        PAGE = 1;
        duqushuju(2);
}


function duqushuju( LAAA ){
        
        /*读取数据*/

        mui.ajax( HTTP + 'json.php' ,{

            data:{ y:'ding',d:'get',type:LX,page:PAGE },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                if( data.token && data.token != '') TOKEN = data.token;

                if( data.code == 1 ){

                    WCHE = false;

                    DATA = data.data;

                    var gettpl = document.getElementById('demo').innerHTML;

                    laytpl( gettpl ).render( DATA , function( html ){

                        if(PAGE < 2)
                              $("#view").html( html );
                        else  $("#view").append(html);

                    });

                }else{ 
                   

                    WCHE =true;

                    if( PAGE < 2 ){
                        $("#view").html( '<div class="mui-card"><div class="mui-card-content"><div class="mui-card-content-inner" style="text-align:center;color:red;height:160px;line-height:110px;font-size:20px;"> 没有数据 </div></div></div>');
                    }
                }



                if( LAAA == 1 ){


                    if( WCHE ){

                        mui('#pullrefresh').pullRefresh().endPullupToRefresh(true);

                    }else mui('#pullrefresh').pullRefresh().endPullupToRefresh();

     

                }else{

                    mui('#pullrefresh').pullRefresh().endPulldownToRefresh();

                }


            },error:function(xhr){

                dataerror(xhr , '读取列表' );
            }

        });


}


function pulldownRefresh() {
        

        /* 下 刷新*/
        setTimeout(function() {

            PAGE = 0;
            chushidata();

        }, 500);

}


function pullupRefresh() {

        /* 上 拉取 */
        setTimeout(function() {

            PAGE++;
            duqushuju(1);

        }, 500);
}


if( mui.os.plus ) {

    mui.plusReady(function() {
        gouwuche();
        mui('#pullrefresh').pullRefresh().pullupLoading();
    });

}else{

    mui.ready(function() {
        gouwuche();
        mui('#pullrefresh').pullRefresh().pullupLoading();
    });
}


mui("#segmentedControl").on('tap','.mui-control-item',function(){

    zhi = $(this).attr('data');
    LX = zhi;
    chushidata();

});
</script>