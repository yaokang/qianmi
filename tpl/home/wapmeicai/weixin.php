<?php if(!defined('ONGPHP'))exit('Error OngSoft');

$jsapi_ticket   =   $Mem ->g( 'jsapi_ticket');

if(! $jsapi_ticket ){

    $access_token =  $Mem ->g('access_token');
                        

    if(!$access_token ){

        $csass = sslget('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$LANG['kjwxid'].'&secret='.$LANG['kjwxkey']);
        $woqi = (array)json_decode($csass);
        $access_token = $woqi['access_token'];
        if( strlen( $access_token ) > 10 )$Mem ->s('access_token',$access_token ,'3600');
    }

    $csafss = sslget('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi');
    $woqdi = (array)json_decode($csafss);
    $jsapi_ticket =  $woqdi['ticket'];
    if(strlen( $jsapi_ticket ) > 10)$Mem ->s('jsapi_ticket',$jsapi_ticket ,'3600');

}

$FHSIGN  =  array(  'timestamp' => time(),
                     'noncestr' => md5(time().rand(1,9999)),
                 'jsapi_ticket' => $jsapi_ticket ,
                          'url' => WZHOST.trim($_SERVER['REQUEST_URI'],'/'),
            );

$CANSHU = argSort($FHSIGN); 
$CANSH  = getarray($CANSHU);
$CANSHU['sign'] = sha1($CANSH);

?>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
var $FENXIN = Array( '<?php echo $LANG['fentitle'];?>',
                     '<?php echo $furl = ( isset( $FENURL ) ? $FENURL : $FHSIGN['url']); echo (  strstr( $furl , "?" ) ? '&':'?');?>tuid='+UID,
                     '<?php echo pichttp( $LANG['fenxiang']);?>',
                     '<?php echo $LANG['fenneiron']?>'
    );

wx.config({
    debug    : false,
    appId    : '<?php echo $LANG['kjwxid'];?>', 
    timestamp: '<?php echo $CANSHU['timestamp'];?>',
    nonceStr : '<?php echo $CANSHU['noncestr'];?>', 
    signature: '<?php echo $CANSHU['sign'];?>',
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']
});

wx.ready(function(){

    wx.onMenuShareTimeline({
        title:  $FENXIN['0'],
        link:   $FENXIN['1'],
        imgUrl: $FENXIN['2'],
        success: function(){


        },cancel: function(){

        }
    });

    wx.onMenuShareAppMessage({
     
        desc : $FENXIN['3'], 
        title: $FENXIN['0'], 
        link : $FENXIN['1'], 
        imgUrl:$FENXIN['2'],
        type: '',
        dataUrl: '', 
        success: function () { 
     
        },cancel: function () { 

        }
    }); 

    wx.onMenuShareQQ({

        desc : $FENXIN['3'],
        title: $FENXIN['0'], 
        link : $FENXIN['1'], 
        imgUrl:$FENXIN['2'],
        success: function () { 

        },cancel: function () { 

        }
    });

    wx.onMenuShareWeibo({
        desc : $FENXIN['3'],
        title: $FENXIN['0'], 
        link : $FENXIN['1'],
        imgUrl:$FENXIN['2'],
        success: function () { 
         
        },cancel: function () { 

        }
    });

    wx.onMenuShareQZone({
        desc : $FENXIN['3'], 
        title: $FENXIN['0'],
        link : $FENXIN['1'],
        imgUrl:$FENXIN['2'],
        success: function () { 

        },cancel: function () { 

        }
    });

});
</script>