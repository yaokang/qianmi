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

if( $MOD == 'get' ){
    /*读取数据*/

    $PAGE = (int)( isset( $_POST['page'] ) ? $_POST['page'] : 1 );
    $NUM  = (int)( isset( $_POST['num']  ) ? $_POST['num'] : 16 );
    $LX   = (int)( isset( $_POST['lx']  ) ? $_POST['lx'] : 1 );

    if( $NUM < 16 ) $NUM = 16;
    if( $NUM > 88) $NUM = 88;

    $D  = db( 'hongbao' );

    $WHERE = array( 'uid' => $USERID );

    if( $LX == '2'){
        /*使用完成*/
        $WHERE['off'] = 1;
    
    
    }else if( $LX == '3'){
        /*过期了*/
        $WHERE['off'] = 2;
    
    
    }else{
        /*可以使用*/

        $WHERE['off'] = 0;
    
    
    }

    $limit = listmit( $NUM , $PAGE);

    $DATA = $D ->where( $WHERE )->limit( $limit )->order('id desc')-> select();
  

    if( $DATA ){

        $HONGBAO = logac('hongbaooff');

        foreach( $DATA as $ONG ){

            $SHUJU[] = array( 'jine' => $ONG['haobaojine'] ,
                               'man' => $ONG['dayukeyong'] ,
                             'sheng' => $ONG['shengyujine'] ,
                             'atime' => date( $CONN['timegeshi'] , $ONG['atime'] ),
                             'gtime' => date( $CONN['timegeshi'] , $ONG['gtime'] ),
                               'off' => $ONG['off'],
                           'offname' => $HONGBAO[ $ONG['off'] ],
                            'beizhu' => $ONG['beizhu'],
                             'id' => $ONG['id']
                        );

        }

        $CODE = 1;

    }else $CODE = -1;




}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/


}else if( $MOD == 'delete' ){
    /*删除数据*/


}

$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG );