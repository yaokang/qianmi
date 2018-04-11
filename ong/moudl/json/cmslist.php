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

    $PAGE = (int)( isset( $_POST['page'] ) ? $_POST['page'] : 1 );
    $NUM  = (int)( isset( $_POST['num']  ) ? $_POST['num']  : 10 );
    $CPID = (int)( isset( $_POST['cpid'] ) ? $_POST['cpid'] : $LANG['cpid'] );

    if( $PAGE < 1) $PAGE = 1;

    if( $NUM < 10 ) $NUM = 10;
    if( $NUM > 88)  $NUM = 88;

    if( ! isset( $_POST['cpid'])) $_POST['cpid'] = $LANG['cpid'];


    if( strpos( $_POST['cpid'] , 'SOSO_') !== false ){

        $ID = str_replace('SOSO_','',$_POST['cpid']);

        if( ! isutf8( $ID )  ) $ID = iconv( "gb2312" , "UTF-8//IGNORE" ,$ID);

        $DATAS = neirlist(array('where'=> array(  'off' => 2,'cid IN' => xjcid($LANG['cpid']),
                                                 '(' => 'and',
                                         'name LIKE' => '%'.$ID.'%',
                                      'guanjian OLK' => '%'.$ID.'%',
                                       'miaoshu OLK' => '%'.$ID.'%',
                                                 ')' => ''
                                                ),'page'=>$PAGE,'http'=>$CONN['sosoword'].$CONN['fenge'].$ID,'pagenum' => ($SHOUJI?-1:5),'num'=>$NUM ),'center' );


    }else $DATAS = neirlist( $TJ = array( 'cid'=> xjcid($CPID)  ,'page' => $PAGE,'num'=> $NUM,'total'=>1) , 'center' , '' ); 


    
    
    
    
    

    


                
    if( $DATAS['date'] ){

        foreach( $DATAS['date'] as $ong ){

                if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                else $ong['canshu'] =  array();


                $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;

               

                $ZICAN = array( array( 'name'=> $shuju ? $shuju: '' , 'jiage' => $ong['jiage'],'chash' => md5( $ong['id'].'_' )  ));

                if( isset( $ong['canshu']['jiage'] ) ){

                    $ZICAN = array();

                    foreach( $ong['canshu']['jiage'] as $kk => $vv){

                        $zjiage = $vv =='' ? $ong['jiage']: $vv;
                        if($zjiage <  0)  continue;
                        $ZICAN[] = array( 'name'=>  $kk , 'jiage' =>  $zjiage ,'chash' => md5( $ong['id'].'_'.$kk ) );
                    }
                }

                $zjiage = $jiage == ''? $ong['jiage']: $jiage;
                if($zjiage <  0)  continue;

                $SHUJU[] = array(

                            'link' => $ong['link'] ,
                            'name' => $ong['name'] ,
                          'tupian' => pichttp($ong['tupian']) ,
                              'id' => $ong['id'],
                          'huobi'  => $HUOBIICO[$ong['huobi']],
                          'canshu' => $ong['canshu']  ? $shuju['name'].'：'.$shuju['0']['canshu']:'',
                           'guige' => $ZICAN ,
                           'jiage' => $jiage == ''? $ong['jiage']:  $zjiage,
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