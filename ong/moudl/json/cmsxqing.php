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

    $ID = (int)( isset( $_POST['id'] ) ? $_POST['id'] : 0 );

    if( $ID  > 0 ){

        $D = db('center');

        $SHUJU = $D -> where ( array( 'id' => $ID ) )-> find ();

        if( $SHUJU ){

            if( $SHUJU['off'] == 2 ){

                $SHUJU['link'] = mourl( $SHUJU['url'] , $SHUJU['http'] );

                if( $SHUJU['tupian'] != '' ) $SHUJU['tupian'] = pichttp( $SHUJU['tupian'] );

                if( $SHUJU['tupianji'] != '' ){

                    $PICT = unserialize( $SHUJU['tupianji'] );
                    $SHUJU['tupianji'] = array();

                    foreach( $PICT as $ONG ){
                        $SHUJU['tupianji'][] = pichttp( $ONG );
                    }
                }

                $SHUJU['neirongpic'] = array();

              

                $SHUJU['kuozanform'] = '';

                if( $SHUJU['cid'] > 0){ 

                    $SH = $D -> setbiao('type') ->where( array('id' => $SHUJU['cid']) ) -> find();

                    if( $SH ){

                        $SHUJU['kuozanform'] = $SH['kuozanform'];
                    }
                }


                if( $SHUJU['kuozanform'] != '' ){
                
                    $KUOZAN = unserialize( $SHUJU['kuozanform'] );
                    $KUOZHI = unserialize( $SHUJU['kuozan'] );

                    if( !$KUOZHI ) $KUOZHI = array();

                    $SHUJU['kuozan'] = array();

                    if( $KUOZAN ){

                        $ii = 0;

                        foreach($KUOZAN as   $ONGG){

                            if( $ONGG['扩展标题'] == '' ){

                                $ii++;
                                continue;
                            }
                            
                            $SHUJU['kuozan'][] = array( 
                                                   'name' => $ONGG['扩展标题'],
                                                  'value' => isset($KUOZHI[$ii]) ? $KUOZHI[$ii] : ''
                                                );
                            $ii++;
                        }
                    }

                }

                unset( $SHUJU['kuozanform'] );

                if( $SHUJU['neirong'] != '' ){

                    if( $fan = strpos( $SHUJU['neirong'] , 'img') || strpos( $SHUJU['neirong'] , 'IMG')   ){

                        $neirongimg = fenjieimg( $SHUJU['neirong'] );

                        if( $neirongimg && $neirongimg['bbao'] ){

                            $tihuan = array();

                            foreach( $neirongimg['bbao'] as $img ){

                                $img = trim( $img  ,'"');

                                if( $img == '' ) continue;

                                $tuhahs = 'a'. md5($img);

                                if( !isset( $tihuan[$tuhahs] ) )
                                    $SHUJU['neirong'] = str_replace( $img ,  pichttp( $img ) , $SHUJU['neirong'] );

                                $tihuan[$tuhahs]  = 1;
                                $SHUJU['neirongpic'][] =  pichttp( $img ) ;
                            }
                        }
                    }
                }


                unset($SHUJU['kahao']);
                unset($SHUJU['kamima']);

                if($SHUJU['canshu'] !='') $SHUJU['canshu'] = unserialize( $SHUJU['canshu'] );
                else $SHUJU['canshu'] =  array();

                $shuju = isset( $SHUJU['canshu']['shuju'] ) ? reset( $SHUJU['canshu']['shuju'] ) : array();
                $jiage = isset( $SHUJU['canshu']['jiage'] ) ? (float)reset( $SHUJU['canshu']['jiage'] ) : $SHUJU['jiage'] ;

               

                $ZICAN = array( array( 'name'=> $shuju ? $shuju : '' , 'jiage' => $SHUJU['jiage'],'chash' => md5( $SHUJU['id'].'_' )  ));
                
                if( isset( $SHUJU['canshu']['jiage'] ) ){

                    $ZICAN = array();

                    foreach( $SHUJU['canshu']['jiage'] as $kk => $vv){

                        $zjiage = $vv =='' ? $SHUJU['jiage']: $vv;
                        if($zjiage <  0)  continue;
                        $ZICAN[] = array( 'name'=>  $kk , 'jiage' =>  $zjiage ,'chash' => md5( $SHUJU['id'].'_'.$kk ) );
                    }
                }

                if( isset( $SHUJU['canshu']['jiage'] ) )
                $SHUJU['buyjiage'] = $SHUJU['canshu']['jiage'];
                else $SHUJU['buyjiage'] = array( '0' => $SHUJU['jiage'] );

                unset( $SHUJU['canshu'] );
                $SHUJU['buygegui'] = $ZICAN;

            }else{

                $SHUJU = array();
                $STAT = 404;
                $CODE = -1;
            }

        }else{ 

            $STAT = 415;
            $CODE = -1;
        }

    }else{ 

        $STAT = 415;
        $CODE = -1;
    }

}else if( $MOD == 'post' ){
    /*新增数据*/


}else if( $MOD == 'put' ){
    /*修改数据*/

}else if( $MOD == 'delete' ){
    /*删除数据*/

}


$DATA = apptongxin( $SHUJU  , $STAT , $CODE , $MSG );