<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');


$PAYID  = $PAYAC['payid']  ; //支付的id
$PAYKEY = $PAYAC['paykey'] ; //支付的key
$PAYZH  = $PAYAC['zhanghao']; //微信登录id
$PAYMM  = $PAYAC['beizhu']; //微信登录key

$PAYHT  = 'http://www.faka.la/pay.php'; //支付通信地址
$TYID   = 1; //支付方式

$PAYYB  = WZHOST.'pay/yb'.anquanqu( $PAYAC ['payfile'] ).'.php'; //异步连接地址
$PAYTB  = WZHOST.'pay/tb'.anquanqu( $PAYAC ['payfile'] ).'.php'; //同步连接地址


if( strstr($_SERVER['HTTP_USER_AGENT'], "jfwlapp") || ( $SHOUJI && !strstr($_SERVER['HTTP_USER_AGENT'], "essenger")) ){




$lujing =  ONGPHP.'moudl/pay/zszhifu.php';;

if(file_exists($lujing)){
    
    include $lujing;
    exit();
}



}




if( $PLAYFS  == '1'){//充值处理

   /*
    $DINGID['orderid']; //订单id
    $DINGID['payjine']; //订单金额
    $DINGID['tongyiid'] ;  //备注
   */

    $DINGID['payjine'] = $DINGID['payjine'] *100;

    $CANSHU = array(  'appid'  => $PAYZH ,
                     'mch_id'  => $PAYID,
                   'nonce_str' => md5( $DINGID['orderid']),
                        'body' => 'PAY',
                      'attach' => $DINGID['tongyiid'] ==''? $DINGID['orderid'] :$DINGID['tongyiid'],
                'out_trade_no' => $DINGID['orderid'],
                   'total_fee' => $DINGID['payjine'],
            'spbill_create_ip' => IP(),
                  'time_start' => date('YmdHis'),
                  'notify_url' => $PAYYB
    );

     if( strstr( $_SERVER['HTTP_USER_AGENT'], "essenger")  &&  $USER['weixin']  != '' && $CONN['gzhzf'] == 1 ){
    
                $CANSHU['trade_type'] = 'JSAPI';

                $CANSHU['openid'] =  $USER['weixin'];

     }else  $CANSHU['trade_type'] = 'NATIVE';

     $CANSHU = argSort( $CANSHU );
     $CANSH  = getarray( $CANSHU );

     $CANSHU['sign'] = strtoupper( md5( $CANSH . '&key='.$PAYKEY ));

     $xml ='<xml>';
     foreach( $CANSHU as $k =>$v ) $xml .= "<$k>$v</$k>";
     $xml .='</xml>';

     $fanhui = post($xml,'https://api.mch.weixin.qq.com/pay/unifiedorder?');
     $woqu = str_replace(array('<','>'),'',$fanhui);

     $p = xml_parser_create();
     xml_parse_into_struct($p, $fanhui, $vals, $index);
     xml_parser_free($p);

    

     if( $vals ){

         $shuju = array();

         foreach( $vals as $zhis)  $shuju[ strtolower( $zhis['tag'] ) ] = isset( $zhis['value']) ? $zhis['value'] :'';

        

         if( $shuju['return_code'] == 'SUCCESS'){

              if( $shuju['trade_type'] == 'JSAPI'){ 

                  $FHSIGN  =  array(
                                  'appId' => $PAYZH ,
                              'timeStamp' => time(),
                               'nonceStr' => md5(time().rand(1,9999)),
                                'package' => 'prepay_id='.$shuju['prepay_id'],
                               'signType' => 'MD5',
                  );

                  $CANSHU = argSort($FHSIGN);
          
                  $CANSH = getarray($CANSHU);

                  $CANSHU['sign'] = strtoupper(md5($CANSH.'&key='.$PAYKEY));

                 ?>
                    <html lang="zh-CN">
                         <head>
                          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
                          <meta name="format-detection" content="telephone=no">
                         </head>
                         <body>

                            <a href="#" style="color:REd;padding:10px;display:block;text-align:center;">请完成支付</a>

                         </body>
                    </html>
                       <script type="text/javascript" >

                              function onBridgeReady(){
                
                                WeixinJSBridge.invoke( 'getBrandWCPayRequest', {
                                           "appId" :"<?php echo $FHSIGN['appId'];?>",
                                           "timeStamp":"<?php  echo $FHSIGN['timeStamp'];?>",
                                           "nonceStr":"<?php  echo $FHSIGN['nonceStr'];?>",
                                           "package":"<?php  echo $FHSIGN['package'];?>",  
                                           "signType":"<?php echo $FHSIGN['signType'];?>",
                                           "paySign":"<?php echo $CANSHU['sign'];?>" 
                                       }, function(res){     
                                          if(res.err_msg == "get_brand_wcpay_request:ok" ) { 
                        
                                                  window.location.href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'payding'.$CONN['fenge'].$DINGID['orderid'] );?>";
                                          } else window.location.href="<?php echo WZHOST?>";
                                  }
                               ); 
                            }

                            if ( typeof WeixinJSBridge == "undefined"){

                               if( document.addEventListener ){
                                   document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                               }else if (document.attachEvent){
                                   document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
                                   document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                               }
                            }else{
                                
                               onBridgeReady();
                            }
                     </script>

              <?php
              }else if( $shuju['trade_type'] == 'NATIVE') {

                        $DATA['name'] = '支付订单';
                        $PAGE = 0;

                        include QTPL.'saoma.php';

               }
          
          
          
          }else msgbox('', WZHOST );
 

    }




}else if($PLAYFS  == '2'){ //异步通信

      $raw_post_data = file_get_contents( 'php://input' , 'r' ); 
      $raw_post_data = $raw_post_data ? $raw_post_data : $GLOBALS['HTTP_RAW_POST_DATA'] ;

      if( $raw_post_data ){

          $xml = $raw_post_data;
          $p   = xml_parser_create();
          xml_parse_into_struct($p, $xml, $vals, $index);
          xml_parser_free( $p );

        if( $vals ){

            $shuju = array();

            foreach( $vals as $zhis) $shuju[ strtolower( $zhis['tag'] ) ] = isset( $zhis['value']) ? $zhis['value'] :'';

            unset( $shuju['xml'] );

            $SIGN = $shuju['sign'];

            unset( $shuju['sign'] );

            $CANSHU = argSort($shuju);

            $CANSH = getarray($CANSHU);

            $xcxiay  = strtoupper(md5($CANSH.'&key='.$PAYKEY));

            if(  $xcxiay == $SIGN){

                   chongzhifan( $shuju['transaction_id'] , (float)($shuju['cash_fee']/100) , $shuju['out_trade_no'] );

                   echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';

             }else echo '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[NO]]></return_msg></xml>';

        } else     echo '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[NO]]></return_msg></xml>';

   }else           echo '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[NO]]></return_msg></xml>';



}else if($PLAYFS  == '3'){ //同步返回

          if( strstr($_SERVER['HTTP_USER_AGENT'], "jfwlapp")) {

            exit('APP ok');
          
          }else msgbox('', WZHOST );
          

}