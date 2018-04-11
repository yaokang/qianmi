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
    /*用户发放红包
        image           红包图片
        hongbaojine     红包金额
        num             红包数量
        fanwei          红包范围    0 1公里  1 全区  2 全市
        lianjie         红包链接
        type            红包类型    0 广播红包  1 祝福红包
        mima            红包密码
        ispass          红包是否存在密码    0 不存在 1 存在
        longitude       红包经度
        latitude        红包纬度
    */
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $jine = isset($_POST['hongbaojine']) ? $_POST['hongbaojine'] : 0;
    $num = isset($_POST['num']) ? $_POST['num'] : 0;
    $fanwei = isset($_POST['fanwei']) ? $_POST['fanwei'] : '';
    $lianjie = isset($_POST['lianjie']) ? $_POST['lianjie'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $mima = isset($_POST['mima']) ? $_POST['mima'] : '';
    $ispass = isset($_POST['ispass']) ? $_POST['ispass'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';


}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/


}else if( $MOD == 'delete' ){
    /*删除数据*/


}
