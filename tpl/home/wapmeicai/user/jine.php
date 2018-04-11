<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
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
  
    .off2 *{color:#aaa;}
    </style>
</head>
<body>
    <header id="header" class="mui-bar mui-bar-nav">

        <a class=" mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title"><?php echo $DATA['name'];?></h1>
        <a href="javascript:void(0);" style="padding:0px;margin:0px;font-size:20px;" class=" mui-btn-link mui-pull-right">
            <?php echo $USER['jine'];?>
        </a>

    </header>



<script id="demo" type="text/html">
{{# mui.each(d, function(index, item){ }}

<div class="mui-card off0" title="{{ item.id }}">

   
    <div class="mui-card-content">

        <div class="mui-card-header">
        
        <span>  <b style="font-size:28px;{{ (item.jine>0?'color:green;':'color:Red;') }}">{{ (item.jine > 0 ? '+':'') }}{{ item.jine }}</b>  </span>
        <span> {{ item.typename }}</span>
    
      </div>

    {{# if( item.data && item.data != '') { }}

        <div class="mui-card-content-inner">
   
            {{ item.data }}
            
        </div>
     {{# } }}

    </div>
    <div class="mui-card-footer"> <span> Ip: <b style="color:#aaa;font-weight:normal;">{{ item.ip }}</b>  </span>

        <span> {{ item.atime }}</span>
        
    </div>

</div>
{{# }); }}
</script>





   
<div class="mui-content">

    <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-12" style="float:right;right:1px;left:auto;top:45px;overflow:hidden;width:100%;border-left: 1px solid #ebebeb;">

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

            data:{ y:'jine',d:'get',page:PAGE },
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


</script>