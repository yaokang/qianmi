<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');

plus( array('p','jiami','jianli','mima','shanchu','qcurl','qfopen','x','memcc','txtcc','db','isutf8','setsession','pagec','pinyin','ip','post','funciton','sslget','sslpost','vcode','update','mysqlcc') );

if($CONN['HTTP'] != '' || $CONN['WAPHTTP'] != ''){

          if( $CONN['HTTP'] != $_SERVER ['HTTP_HOST'] && $CONN['WAPHTTP'] != $_SERVER ['HTTP_HOST']  ){

                header('HTTP/1.1 301 Moved Permanently');

                if( $CONN['HTTP'] == '') Header("Location: ".$HOSTQZ.$CONN['WAPHTTP']);
                else                     Header("Location: ".$HOSTQZ.$CONN['HTTP']);
                exit();
          }
}



$Memsession =  $Mem = new txtcc();

// setsession( $CONN['sessiontime'] );

// $USERID = $_SESSION['uid'];

$LOCK = ONGPHP.'dsoft.lock';

if( !file_exists( $LOCK ) ){

    msgbox('','install.php');

}
if( ! isutf8( $URI )  ) $URI = iconv( "gb2312" , "UTF-8//IGNORE" ,$URI);

$HUOBI = huobi( $CONN,2 );

$HUOBIICO = array( '￥' , $CONN['jifen'] ,  $CONN['huobi'] , $CONN['hongbao'] );


if( strstr( $URI , $CONN['houzui'].'&')) $URI = str_replace( $CONN['houzui'].'&' , $CONN['houzui'].'?', $URI);

$URI  = ltrim( str_replace( array( '//' , trim( $_SERVER['SCRIPT_NAME'] , '/' ) ), array( '/' , '' ) , $URI ) , $CONN['dir'] );
$TURI = explode( '?' , ltrim( $URI ,'?'));
$URI  = trim( $TURI['0'] , '/');

if( strstr( $URI , '.' )) $URI = str_replace( $CONN['houzui'] , '', $URI);
else                      $URI = 'index';

/*再次强行容错*/
if( $URI == '' ) $URI = 'index';
$HTTP = explode( $CONN['fenge'] , $URI);

$LANG = include QTLANG;

if( count ( $HTTP ) > $CONN['fengenum'] ) error404( $LANG['ERfgum'] );
if( strstr( $URI , '.php' ))              error404( $LANG['ERffhz'] );

if( ( $CONN['huanchun'] > 0 || isset( $_GET['huan']) ) && $HTTP['0'] != $CONN['userword'] ){

    if(  $CONN['yunxing'] == 3)
        $WENJIAN = wlx( ONGPHP.'../'.$URI.'.html' , 2);
    else $WENJIAN = Txpath.'html/'.mima( $CONN['qtpl']. $URI).'.html';

    if( file_exists( $WENJIAN)){ 

        clearstatcache();
        $guoqitime = filemtime( $WENJIAN ) + $CONN['huanchun']; 
        $dangqtime = time();

        if( $dangqtime < $guoqitime){

            $fp = qfopen( $WENJIAN , 'utf-8');
            if( ! isset( $_GET['huan'])) echo $fp;
            die;
        }

        if( isset( $_GET['huan'])) @unlink($WENJIAN);
    }
}


$PAGE = (float)( isset($HTTP['1']) ? $HTTP['1'] : 1 );

if( $HTTP['0'] == $CONN['userword']){
    
    /* 用户模块处理*/

    $QTPLLJ =  QTPL.'user/index.php';

    if( file_exists( $QTPLLJ )){

        $D = db( 'user' );


        include $QTPLLJ;
    }else error404($LANG['ERnofil'].$QTPLLJ);


    

}else if( $HTTP['0'] == $CONN['sosoword']){
    
    /* 搜索处理 */
    $QTPLLJ =  QTPL.'soso.php';
    if( file_exists( $QTPLLJ )){
        $D = db( 'neirong' );


        include $QTPLLJ;
    }else error404($LANG['ERnofil'].$QTPLLJ);

}else if( $HTTP['0'] == 'index'){

    /* 用户模块处理*/
    $QTPLLJ =  QTPL.'index.php';
    if( file_exists( $QTPLLJ ) ){

        $D = db( 'type' );


        include $QTPLLJ;
    }else error404($LANG['ERnofil'].$QTPLLJ);

}else{
    /*数据库查获找*/

    $FAN = chaurl( $HTTP['0'] );

    if( $FAN ){

        neirong( $FAN , $HTTP , $URI , $CONN , $LANG );

    }else error404($LANG['ERnourl'].$HTTP['0']);
}


if( $CONN['huanchun'] > 0 && $HTTP['0'] != $CONN['userword'] ){
    
    if( $CONN['yasuo'] == '1') $content = str_replace( array("\r","\n","\r\n") , '' , ob_get_contents() ); 
    else $content = ob_get_contents();

    jianli($WENJIAN);

    $fp = fopen( $WENJIAN , "w+" );
    fputs ( $fp , $content );
    fclose( $fp );
}

if( isset( $_GET['huan'])) ob_clean();