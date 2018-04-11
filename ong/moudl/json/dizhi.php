<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
/*

收货地址处理
get   获取收货地址列表
post  新增收货地址
delete 删除收获地址
put    修改收货地址  lx = 1 默认收货 其他修改值

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

$D = db( 'chengshi' );


if( $MOD == 'get' ){

    /*读取数据*/
    $yiji = $D->where(array('shangji'=>0))->select();
    if($yiji){
        foreach($yiji as $ong){
            $erji = $D->where(array('shangji'=>$ong['diqu']))->select();
            if($erji){ 
                $city = array();
                foreach($erji as $key){
                    $sanji = $D->where(array('shangji'=>$key['diqu']))->select();
                    if($sanji){
                        $area = array();
                        foreach($sanji as $val){
                            $area[] = array(
                                'name'=>$val['name'],
                                'diqu'=>$val['diqu'],
                                );
                        }
                    }
                    $city[] = array(
                        'name'=>$key['name'],
                        'diqu'=>$key['diqu'],
                        'area'=>$area,
                        );
                }
            }
        $SHUJU[] = array(
            'name'=>$ong['name'],
            'diqu'=>$ong['diqu'],
            'city'=>$city,
            );
        }
    }
}else if( $MOD == 'post' ){



}else if( $MOD == 'put' ){



}else if( $MOD == 'delete' ){



}

$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG );