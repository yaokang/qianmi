<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
/*

200 操作成功

401 需要登录用户
500 内部服务器错误

304 修改失败
410 删除失败
404 查询失败
406 新增失败

415 非法数据 token错误
exit( json_encode( apptongxin( array()  ,'500', '-1' , 'no mode' ) ) );

*/ 

if( $USERID  < 1 ) exit( json_encode( apptongxin( array()  ,'401', '-1' , 'logon' ) ) );

$_SESSION['paydd']  = time();

if( $MOD == 'get' ){

    /*读取数据
        0 全部正常
        -3 app 专用读取
    */

    $LX = isset($_POST['lx']) ? $_POST['lx'] : 0 ;

    if($LX != '0')
    {
        $LX = '-3';
    }

    $PAY = xitongpay( $LX );

    if($PAY)
    {
        $CODE = 1;

        foreach($PAY as $ONG)
        {
            unset($ONG['paykey']);
            unset($ONG['payid']);
            unset($ONG['zhanghao']);
            unset($ONG['beizhu']);
            unset($ONG['payfile']);
            unset($ONG['adminid']);
            $ONG['suoluetu'] = pichttp($ONG['suoluetu']);
            $SHUJU[] = $ONG;
        }
    }


}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/


}else if( $MOD == 'delete' ){
    /*删除数据*/


}

$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG ,$YZTOKEN );