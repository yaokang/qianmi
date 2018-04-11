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

if( $MOD == 'get' ){

    /*读取数据*/
    $ID = (int)(isset($_POST['id']) ? $_POST['id'] :1);
    $D = db('type');

    $SHUJU = $D->where(array('cid'=>$ID,'off'=>'2'))->select();

    if($SHUJU){
        foreach($SHUJU as $ONG){
            $CANSHU[] = array(
                    'id' => $ONG['id'],
                  'name' => $ONG['name'],
              'guanjian' => $ONG['guanjian'],
               'miaoshu' => $ONG['miaoshu'],
                   'cid' => $ONG['cid'],
                );
        }

        $STAT = 200;
        $CODE = 1;
    }else{
        $SHUJU = array();
        $STAT = 404;
        $CODE = -1;
    }


}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/

}else if( $MOD == 'delete' ){
    /*删除数据*/

}


$DATA = apptongxin( $CANSHU  , $STAT , $CODE , $MSG );