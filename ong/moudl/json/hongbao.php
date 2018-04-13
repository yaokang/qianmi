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
        miaoshu         红包描述
        image           红包图片
        hongbaojine     红包金额   (float)
        num             红包数量
        fanwei          红包范围    0 1公里  1 全区  2 全市(int)
        lianjie         红包链接
        type            红包类型    0 广播红包  1 祝福红包(int)
        mima            红包密码
        ispass          红包是否存在密码    0 不存在 1 存在(int)
        longitude       红包经度
        latitude        红包纬度
    */
    $D = db('hongbao');

    $miaoshu = isset($_POST['miaoshu']) ? $_POST['miaoshu'] : '';
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $jine = isset($_POST['hongbaojine']) ? $_POST['hongbaojine'] : 0;
    $num = isset($_POST['num']) ? $_POST['num'] : 0;
    $fanwei = isset($_POST['fanwei']) ? (int)$_POST['fanwei'] : '';
    $lianjie = isset($_POST['lianjie']) ? $_POST['lianjie'] : '';
    $type = isset($_POST['type']) ? (int)$_POST['type'] : '';
    $mima = isset($_POST['mima']) ? $_POST['mima'] : '';
    //$ispass = isset($_POST['ispass']) ? (int)$_POST['ispass'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';

    $USER = uid($USERID , 1);
    //判断用户是否填写红包描述信息
    if($miaoshu == ''){
        exit(json_encode(array('code'=>'101','msg'=>'请说点什么...')));
    }
    //判断用户是否选择红包图片
    if($image == ''){
        exit(json_encode(array('code'=>'102','msg'=>'请选择上传图片')));
    }else{
        $image = json_decode($image);
        $image = serialize($image);
    }
    //判断用户的红包金额是否大于0
    if($jine <= 0){
        exit(json_encode(array('code' => '103' , 'msg'=>'红包金额不能小于0')));
    }else{
        if($num <= 0){
            exit(json_encode(array('code'=>'104','msg'=>'红包数量不能小于0')));
        }else{
            //判断红包的平均金额
            $pinjun = $jine*(1-$LANG['hbchoucheng']*0.01)/$num;
            if($pinjun < 0.01){

                exit(json_encode(array('code'=>'105','msg'=>'平均每个用户领取红包不能小于1分钱')));

            }else{
                $hongbaojine = $jine*(1-$LANG['hbchoucheng']*0.01);
            }
            //判断用户是否选择红包范围
            if($fanwei == ''){
                exit(json_encode(array('code'=>'106','msg'=>'请选择红包范围')));
            }
            //判断用户是有权限发放红包链接
            if($lianjie != ''){
                $level = $USER['level'];
                if($level < 1){
                    exit(json_encode(array('code'=>'107','msg'=>'vip会员才能显示连接')));
                }
            }
            //判断用户是否选择红包类型
            if($type == ''){
                exit(json_encode(array('code'=>'108','msg'=>'请选择红包类型')));
            }
            //判断用户的红包密码格式是否正确
            if($mima == ''){
                $ispass = 0;
                $mima = '';
            }else{
                if(strlen($mima) != 4 && !is_int($mima)){
                    exit(json_encode(array('code'=>'109','msg'=>'红包密码格式不正确')));
                }else{
                    $ispass = 1;
                    $mima = mima($mima);
                }
            }
            //判断经纬度是否存在
            if($longitude == '' || $latitude == ''){
                exit(json_encode(array('code'=>'110','msg'=>'经纬度不正确')));
            }
        }
        
    }

    //判断用户用不用余额够不够发红包
    if($USER['jine'] < $jine){
        exit(json_encode(array('code'=>'111','msg'=>'余额不足,请使用微信支付')));
    }else{
        $where = array(
                        'uid' => $USERID,
                        'hongbaojine' => $hongbaojine,
                        'miaoshu' => $miaoshu,
                        'image' => $image,
                        'num' => $num,
                        'fanwei' => $fanwei,
                        'lianjie' => $lianjie,
                        'type' => $type,
                        'mima' => $mima,
                        'ispass' => $ispass,
                        'longitude' => $longitude,
                        'latitude' => $latitude,
                    );


    }

    $charu = $D->insert($where);
    if($charu){
        $kouqian = jiaqian($USERID , $TYPE = 0 , $JINE = -$jine,$JIFEN = 0 , $HUOBI = 0  , $DATA = '用户发放红包' , $ip = ip());
        if($kouqian){
            exit(json_encode(array('code' => '113','msg'=>'扣款失败')));
        }
        exit(json_encode(array('code'=>'200','msg'=>'红包发放成功')));
    }else{
        exit(json_encode(array('code'=>'112','msg'=>'红包生成失败')));
    }
}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/


}else if( $MOD == 'delete' ){
    /*删除数据*/


}
