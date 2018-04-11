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
    $huandeng = $LANG['huandeng'];
    $caidan = $LANG['caidan'];
    $guanggao = $LANG['appguanggao'];
    $tuisongtupian = $LANG['tuisongtupian'];
    $tuisongxinxi = $LANG['tuisongxinxi'];
    $SHUJU = array();
    $SHUJU['huandeng'] = array();
	$SHUJU['caidan'] = array();
	$SHUJU['guanggao'] = array();
	if($huandeng){	
	    foreach($huandeng as $key){
	    	$SHUJU['huandeng'][] = array(
	    		'tupian'=>pichttp($key['update-图片']),
	    		'name'=>$key['描述'],
	    		'lianjie'=>$key['连接'],
	    		);
	    }
	}
	if($caidan){
		foreach($caidan as $key){
			$SHUJU['caidan'][] = array(
	    		'tupian'=>pichttp($key['update-图片']),
	    		'name'=>$key['名字'],
	    		'lianjie'=>$key['连接'],
	    		);
		}
	}
	if($guanggao){
		foreach($guanggao as $key){
			$SHUJU['guanggao'][] = array(
	    		'tupian'=>pichttp($key['update-图片']),
	    		'name'=>$key['名字'],
	    		'lianjie'=>$key['连接'],
	    		);
		}
	}

	if($tuisongtupian){
		$SHUJU['tuisongtupian'] = $tuisongtupian;
	}

	if($tuisongxinxi){
		foreach($tuisongxinxi as $key){
			$SHUJU['tuisongxinxi'][] = array(
				'lianjie' => $key['链接'],
				'xinxi' => $key['内容'],
				);
		}
	}

    $STAT = 200;
    $CODE = 1;



}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/


}else if( $MOD == 'delete' ){
    /*删除数据*/


}

$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG );