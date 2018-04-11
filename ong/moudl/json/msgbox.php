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

    if( $NUM < 16 ) $NUM = 16;
    if( $NUM > 88 ) $NUM = 88;

    $D  = db( 'msgbox' );

    $WHERE = array('off' => 2 , '(' => 'and', 'uid' => $USERID , 'OR uid' => 0 , ')'=>'' );

    $limit = listmit( $NUM , $PAGE);

    $DATA = $D ->where( $WHERE )->limit( $limit )->order('yuedu asc,id desc')-> select();

    $GONGYUE =  $Mem ->g('gongyue/'.$USERID);
  

    if( $DATA ){

        $JINE = logac('msgbox');

        foreach( $DATA as $ONG ){

            $ONG['atime'] = date( $CONN['timegeshi'] , $ONG['atime']);
            $ONG['ctime'] = date( $CONN['timegeshi'] , $ONG['ctime']);
            $ONG['typename'] =  isset( $JINE[$ONG['type']])?  $JINE[$ONG['type']]: '' ;

            if( $ONG['uid'] == '0'){

                if(isset( $GONGYUE[$ONG['id']] )) $ONG['yuedu'] = 1;

            }

            $SHUJU[] = $ONG;

        }

        $CODE = 1;

    }else $CODE = -1;




}else if( $MOD == 'post' ){
    /*新增数据*/

    $ID = (float)( isset( $HTTP['id'] ) ?  $_POST['id'] : 0 ) ;

    $CAN = $D ->where( array( 'id' => $ID))-> find();

    if( !$CAN || $CAN['off'] != 2 ) exit( json_encode( apptongxin( array()  ,'404', '-1' , '不存在' ) ) );

    if( $CAN['uid'] != 0 && $CAN['uid'] != $USERID ) exit( json_encode( apptongxin( array()  ,'404', '-1' , '你无法查看' ) ) );

    if( $CAN['uid'] < 1){

        $GONGYUE =  $Mem ->g('gongyue/'.$USERID);

        if( ! isset( $GONGYUE[$CAN['id']] )){

            $GONGYUE[$CAN['id']]  = 1;
            $Mem ->s( 'gongyue/'.$USERID , $GONGYUE );

        }

        $CAN['ctime'] = date( $CONN['timegeshi'] ,time() );
        $CAN['yuedu'] = 1;
    
    }else{

        if($CAN['yuedu'] != 1 ){

            $D->where(array('id' => $CAN['id'])) -> update( array( 'yuedu' => 1 ,'ctime' => time() ));
            $CAN['ctime'] = date( $CONN['timegeshi'] ,time() );
            $CAN['yuedu'] = 1;
        }

    }

    $CAN['atime'] = date( $CONN['timegeshi'] ,$CAN['atime'] );

    $CODE = 1;
    $SHUJU = $CAN;



}else if( $MOD == 'put' ){
    /*修改数据*/


}else if( $MOD == 'delete' ){
    /*删除数据*/


}

$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG );