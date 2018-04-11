<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
hongbao( $USERID );
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
    </style>
</head>
<body>
    <header id="header" class="mui-bar mui-bar-nav">

        <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title"><?php echo $DATA['name'];?></h1>

    </header>



<script id="demo" type="text/html">
{{# mui.each(d, function(index, item){ }}

<div class="mui-card off{{ item.off }}" title="{{ item.id }}">

    <div class="mui-card-header">
        
        <span> 红包 <b style="font-size:28px;"><?php echo $HUOBIICO['0'];?>{{ item.jine }}</b>  </span>
        <span> {{ item.offname }}</span>
    
    </div>
    <div class="mui-card-content">

        <div class="mui-card-content-inner">
            过期时间: {{ item.gtime }} <br />
            红包金额: {{ item.jine }} 元<br />
            剩余金额: <span>{{ item.sheng }} </span>元<br />

            {{ item.beizhu }}
            
        </div>

    </div>
    <div class="mui-card-footer"> <span>红包满 <b style="color:red;">{{ item.man }}</b> 元可用 </span>

        <span> {{ item.atime }}</span>
        
    </div>

</div>
{{# }); }}
</script>





   
       <div class="mui-content">
        <div style="padding: 10px 10px;">

            <div id="segmentedControl" class="mui-segmented-control mui-segmented-control-positive">
                <a class="mui-control-item mui-active" href="#item1" data="1">可使用</a>
                <a class="mui-control-item" href="#item2" data="2">已使用</a>
                <a class="mui-control-item" href="#item3" data="3">已过期</a>
            </div>

        </div>


     <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-12" style="float:right;right:1px;left:auto;top:105px;overflow:hidden;width:100%;border-left: 1px solid #ebebeb;">

        <div class="mui-scroll">
            <div  id="view">

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

        /*初始数据*/
       
        mui('#pullrefresh').pullRefresh().refresh(true);
        mui('#pullrefresh').pullRefresh().endPullupToRefresh(false);
        mui('#pullrefresh').pullRefresh().scrollTo(0,0,100);
        PAGE = 1;
        duqushuju(2);
        


}


function duqushuju( LAAA ){
        
        /*读取数据*/

        mui.ajax( HTTP + 'json.php' ,{

            data:{ y:'hongbaolist',d:'get',lx:LX,page:PAGE },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                if( data.token && data.token != '') TOKEN = data.token;

                if( data.code == 1 ){

                    WCHE = false;

                    DATA = data.data;

                    var gettpl = document.getElementById('demo').innerHTML;

                    laytpl(gettpl).render(DATA, function(html){

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
                        /* 结束下拉 */

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

        setTimeout(function() {

            PAGE = 0;
            chushidata();

        }, 500);

}

function pullupRefresh() {

        setTimeout(function() {

            PAGE++;
            duqushuju(1);

        }, 500);
}

if (mui.os.plus) {
    mui.plusReady(function() {

        mui('#pullrefresh').pullRefresh().pullupLoading();

    });
} else {
    mui.ready(function() {
        mui('#pullrefresh').pullRefresh().pullupLoading();
    });
}


mui("#segmentedControl").on('tap','.mui-control-item',function(){

    zhi = $(this).attr('data');

    LX = zhi;
    mui.toast ('Loading...',{duration:888});
    chushidata( );
     



});





</script>