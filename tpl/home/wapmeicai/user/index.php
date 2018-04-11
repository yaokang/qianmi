<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');

setsession( $CONN['sessiontime'] );
$IP = ip();

if( isset( $HTTP['2'] ) ) $_SESSION['tuid'] = (float) $HTTP['2'];

$YGAC = $AC = isset( $HTTP['1'] ) ? $HTTP['1'] : 'login' ;


if( isset( $_SESSION['uid'] ) &&  $_SESSION['uid'] > 0 ){

    $USERID = $_SESSION['uid'];

    if( isset( $_SESSION['reback'] ) ) unset( $_SESSION['reback'] );

    $USER = uid( $_SESSION['uid'] );

    /* 会员一登陆 */
    $ACTION = array(   'pay' => '充值',
                   'setting' => '系统设置',
                    'msgbox' => '消息中心',
                      'main' => '个人中心',
                     'quite' => '退出操作',
                      'cart' => '购物车',
                    'myding' => '我的订单',
                      'ding' => '订单支付确认',
                   'payding' => '支付订单查看',
                   'chading' => '查看详细订单',
                   'dingpay' => '订单支付',
                   'shouhuo' => '收获地址',
                     'jifen' => '我的'.$HUOBI['1'],
                      'jine' => '余额',
                     'huobi' => '我的'.$HUOBI['2'],
                   'hongbao' => '我的红包',
                    'goumai' => '直接购买',
                   'pinglun' => '评论',
             );

    if( ! isset( $ACTION[ $AC ] ) ) $AC = 'main';

    if( $USER['off'] == '0' || ( $_SESSION['ip'] != $IP && $USER['yanzhengip'] == 1 && $CONN['yanzhengip'] == '1' )) $AC = 'quite';

    if( $AC == 'quite'){

        unset($_SESSION['uid'] );
        userlog( $USERID , 1 );
        msgbox('', mourl( $CONN['userword'] ));
    }

    $DATA = array( 'name' => $ACTION[$AC] ) ;

    $QTPL = QTPL.'user/'. $AC .'.php';

    if( file_exists( $QTPL ) ) include $QTPL ;
    else error404( $LANG['ERnofil'] . $QTPL );


}else{
        $ACTION = array( 'login' => '登录',
                          'pass' => '找回密码',
                           'reg' => '注册帐号',
                        'klogin' => '快捷登录注册',
        );

        if( ! isset( $ACTION[ $AC ] ) ){
            
            $AC = 'login';

            if( $YGAC != 'quite')
            $_SESSION['reback'] = mourl($URI);

        }

        $DATA = array( 'name' => $ACTION[$AC] ) ;

        $QTPL = QTPL.'user/'. $AC .'.php';

        if( file_exists( $QTPL ) ) include $QTPL ;
        else error404( $LANG['ERnofil'] . $QTPL );

}