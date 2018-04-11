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

$USER = uid( $USERID );
if( !$USER  ) exit( json_encode( apptongxin( array()  ,'401', '-1' , 'logon' ) ) );

if( $MOD == 'get' ){

    /*
    读取订单数据
    page  页码
    num   读取条数
    type  类型 2 已完成 1 未完成 3 已取消
    
    */

    /* 获取用户信息 */
    $ORDERID = isset( $_POST['orderid'] ) ? $_POST['orderid'] : '' ;
    if($ORDERID != ''){
        $D = db('dingdanx');
        $WHERE = array('orderid'=>$ORDERID);
        $DATA = $D->where($WHERE)->select();
        // p($DATA);
        if($DATA){
            foreach($DATA as $ong){
                $SHUJU[] = $ong;
            }
        }
    }else{
        exit( json_encode( apptongxin( array()  ,'401', '-1' , 'orderid' ) ) );
    }




    


}else if( $MOD == 'post' ){

   


}else if( $MOD == 'put' ){

    /*修改数据*/
   







}else if( $MOD == 'delete' ){

    /*删除数据
    
    hongid:0
    shouid:25
    youfei[0-1]:2
    cpid:5
    num:1
    canshu:4
    
    */

   




}

$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG , $YZTOKEN );