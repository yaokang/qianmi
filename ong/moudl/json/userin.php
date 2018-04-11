<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');

$CODE = 0;
$MSG = '用户登录信息读取';
                
if( $MOD == 'soso'){

    $PG  = (float)( isset( $_POST['pg']) ? $_POST['pg']: 0 );
    $NUM = (float)( isset($_POST['num'] ) ? $_POST['num'] : 0);
    $LX  = (float)( isset($_POST['lx'] ) ? $_POST['lx'] : 0);

    if( $USERID < 1 ) exit( json_encode( apptongxin( array() , 1 , -99 , '重新登录' ) ) );

    $where = array( 'uid' =>  $USERID );
    $SHUJU = array();

    if($NUM > 50)$NUM = 50;
    else if($NUM < 4)$NUM = 4;

    $limit = listmit( $NUM , $PG );

    if( $LX == 1 ){

            /*系统红包*/
          

            $D =  db('xitonghongbao');
         
            $HONGBAO = $D  -> where( $where) ->order('off asc,id desc')->limit( $limit )-> select();
            
            if( $HONGBAO  ){

                $CODE = 1;

                foreach( $HONGBAO as $ong ){ 

                    $SHUJU[] = array(  'haobaojine' => (int)$ong['haobaojine'],
                                      'shengyujine' => $ong['shengyujine'],
                                     'atime' => date( 'Y-m-d H:i:s' , $ong['atime']),
                                     'gtime' =>  date( 'Y-m-d H:i:s' , $ong['gtime']),
                                     'dayukeyong' => $ong['dayukeyong'],
                                     'off' => $ong['off'],
                                    'stime' => $ong['stime'] > 0 ? date( 'Y-m-d H:i:s' , $ong['stime']): 0
                    );
                }
            }

    }else if( $LX == 2 ){

        /*砖石记录*/
        $D =  db('huobilog');
        $datas = $D  -> where($where) ->order('id desc') -> limit( $limit ) -> select();

        $JINELOG = logac('huobilog');

        
        if( $datas ){

            $CODE = 1;
            foreach($datas as $ong){

                $SHUJU[]= array( 
                     'type' => $JINELOG[$ong['type']].' '.$ong['data'],
                    'ztype' => $JINELOG[$ong['type']],
                     'data' => $ong['data'],
                       'ip' => $ong['ip'],
                    'atime' => date('Y-m-d H:i:s',$ong['atime']),
                    'huobi' => $ong['huobi'],
                    
                
                );
            }
            
        }
    
    
    }else if( $LX == 3 ){

        /*积分记录*/
        $D =  db('jifenlog');
        $datas = $D  -> where($where) ->order('id desc') -> limit( $limit ) -> select();

        $JINELOG = logac('jifenlog');

        
        if( $datas ){

            $CODE = 1;
            foreach($datas as $ong){
                $SHUJU[]= array( 
                    'type' =>$JINELOG[$ong['type']].' '.$ong['data'],
                    'ztype'=>$JINELOG[$ong['type']],
                    'data' => $ong['data'],
                    'ip' => $ong['ip'],

                    'atime' => date('Y-m-d H:i:s',$ong['atime']),
                    'jifen' => $ong['jifen'],
                    
                
                );
            }
            
        }
    
    
    }else if( $LX == 4 ){

        /*金额记录*/
        $D =  db('jinelog');
        $datas = $D  -> where($where) ->order('id desc') -> limit( $limit ) -> select();

        $JINELOG = logac('jinelog');

        
        if( $datas ){

            $CODE = 1;
            foreach($datas as $ong){
                $SHUJU[]= array( 
                    'type' =>$JINELOG[$ong['type']].' '.$ong['data'],
                    'ztype'=>$JINELOG[$ong['type']],
                    'data' => $ong['data'],
                    'ip' => $ong['ip'],
                    'atime' => date('Y-m-d H:i:s',$ong['atime']),
                    'jine' => $ong['jine'],
                    
                
                );
            }
            
        }
    
    
    }else if( $LX == 5 ){

        /*充值记录*/

        $D =  db('dingdan');

        $where['cpid']= 0;


        $datas = $D  -> where($where) ->order('did desc') -> limit( $limit ) -> select();

        $JINELOG =   $paytype = xitongpay('-1');

        
        if( $datas ){

            $CODE = 1;
            foreach($datas as $ong){

                $SHUJU[]= array( 'type' => $ong['orderid'].' '.$JINELOG[$ong['paytype']],
                              'orderid' => $ong['orderid'],
                                'ztype' => $JINELOG[$ong['paytype']],
                                   'ip' => $ong['ip'],
                                'atime' => date('Y-m-d H:i:s',$ong['atime']),
                                 'jine' => $ong['zongjia'],
                                  'off' => $ong['off'],
                    
                
                );
            }
            
        }
    
    
    }else if( $LX == 6 ){

        /*订单记录*/

         $D =  db('dingdan');
         $where['cpid >']= 0 ;

      

        $datas = $D  -> where($where) ->order('off asc,did desc') -> limit( $limit ) -> select();


         $paytype = xitongpay('-1');

         $paytype['0'] = '站内支付';

        
        if( $datas ){

            $CODE = 1;
            foreach($datas as $ong){

                $SHUJU[]= array(  'type' => $paytype[$ong['paytype']],
                               'orderid' => $ong['orderid'],
                                 'atime' => date('Y-m-d H:i:s',$ong['atime']),
                                    'ip' => $ong['ip'],
                                  'jine' => $ong['zongjia'],
                                   'off' => $ong['off'],
                              'chulioff' => $ong['chulioff'],
                    
                
                );
            }
            
        }
        
    
    
    }else if( $LX == 7 ){

        /*直购记录*/

        $D =  db('dingdan');


        
        
        $where = array( 'uid' => $USERID,'kefahuo' => 1,'chutype IN'=> '1,8,9');

        $datas = $D  -> where($where) ->order('did desc') -> limit( $limit ) -> select();

        $FAHUOOFF = logac('fahuooff');

        $PAYOFF = logac('payoff');

        chufazhigou( $D , $USERID );

        if( $datas ){

            $CODE = 1;
            $CPID = array();
            foreach($datas as $ong){

                if( !isset( $CPID[ $ong['cpid']] ))  $CPID[ $ong['cpid']] = chanpinid( $ong['cpid'] );
                $url = url('cc',$ong['cpid']); 
                $SHUJU[]= array( 'url' => $url,
                                'cpid' => $ong['cpid'],
                               'atime' => date('Y-m-d H:i:s',$ong['atime']),
                                  'ip' => $ong['ip'],
                             'orderid' => $ong['orderid'],
                               'huobi' => $ong['huobi'],
                              'hbname' => $HUOBI[$ong['huobi']],
                             'zongjia' => $ong['zongjia'],
                          'hongbaojine'=> $ong['hongbaojine'],
                            'shuliang' => $ong['shuliang'],
                       'chanpincanshu' => $ong['chanpincanshu'],
                                 'off' =>  $ong['off'],
                             'offname' =>  $PAYOFF[$ong['off']],
                            'fahuooff' => $ong['fahuooff'],
                        'fahuooffname' => $FAHUOOFF[$ong['fahuooff']],
                                 'did' => $ong['did'],
                               'cname' => $CPID[ $ong['cpid']]['name'],
                            'suoluetu' => pichttp($CPID[ $ong['cpid']]['suoluetu'])

                    
                
                );
            }
        }

    }else if( $LX == 8 ){

        /*我的晒单记录*/

        $D =  db('xitongneirong');
        
        $CENID = (xitongtype2($LANG['shaidanid']));
        $CENID[$LANG['shaidanid']] = $LANG['shaidanid'];

        $where = array( 'type IN' => $CENID , 'uid' => $USERID );

        $datas = $D  -> where($where) ->order('atime desc') -> limit( $limit ) -> select();

        $OFF = logac('off');

        if( $datas ){

            $CODE = 1;
            $CPID = array();
            foreach($datas as $ong){
                $url = url('c',$ong['id']); 
                $tupian = unserialize($ong['tupianji']);
                if($tupian['0'] == '')$tupian['0'] = $ong['suoluetu'];

                $SHUJU[]= array( 'id' => $ong['id'],
                               'name' => $ong['name'],
                                'off' => $ong['off'],
                           'suoluetu' => pichttp($tupian['0']),
                            'offname' => $OFF[$ong['off']],
                              'atime' => date('Y-m-d H:i:s',$ong['atime']),
                                'url' => $url,
                            'miaoshu' => $ong['miaoshu'],
                    
                
                );


            }

        }


    }else if( $LX == 9 ){

        /*我的中奖记录*/
        $FAHUOOFF = logac('fahuooff');

        $D =  db('yungoujiebiao');
        


        $datas = $D  -> where($where) ->order('id desc') -> limit( $limit ) -> select();

        $FAHUOOFF = logac('fahuooff');

        if( $datas ){

            $CODE = 1;
            $CPID = array();
            foreach($datas as $ong){
                if( !isset( $CPID[ $ong['cpid']] ))  $CPID[ $ong['cpid']] = chanpinid( $ong['cpid'] );

                $url = url('cc',$ong['cpid'],'',$CONN['fenge'].$ong['cpqs'].$CONN['houzui']); 
                $DING = dingdandid($ong['did'] , $D );

                 $SHUJU[]= array('url' => $url,
                                'cpid' => $ong['cpid'],
                                'cpqs' => $ong['cpqs'],
                               'ktime' => date('Y-m-d H:i:s',$ong['ktime']),
                              'zongxu' => $CPID[ $ong['cpid']]['qianggou'],
                            'zhonghao' => $ong['zhonghao'],
                               'canyu' => canyurenci( $D ,$ong['uid'] ,$ong['cpid'] , $ong['cpqs'],1),
                            'fahuooff' => $DING['fahuooff'],
                        'fahuooffname' => $FAHUOOFF[$DING['fahuooff']],
                           'shaidanid' => $DING['shaidanid'],
                             'shaiurl' => url('c',$DING['shaidanid']),
                                 'did' => $ong['did'],
                               'cname' => $CPID[ $ong['cpid']]['name'],
                            'suoluetu' => pichttp($CPID[ $ong['cpid']]['suoluetu']),

                );


            }

        }
        
        
    }else if( $LX == 10 ){

          /*重新读取用户信息*/

          $USER = uid( $USERID );

          if($USER){
              $CODE = 1;

            $SHUJU = array( 
                    'name' => $USER['name'],
                    'uid'  => $USERID,
                    'jine' => $USER['jine'],
                   'jifen' => $USER['jifen'],
                'kuohuobi' => $USER['kuohuobi'],
                'touxiang' => pichttp( $USER['touxiang'] ),
                  'shouji' => $USER['shouji'] > 0 ?xinghao( $USER['shouji'] ): 0,
                  'weixin' => $USER['weixin'] != '' ? xinghao( $USER['weixin'] ) :'',
                  'openid' => $USER['openid'] != '' ? xinghao( $USER['openid'] ) :'',
                  'qqopen' => $USER['qqopen'] != '' ? xinghao( $USER['qqopen'] ) :'',
                   'token' => $_SESSION['myuser'] = token(),
                   'huobi' => $HUOBI
            );
          
          
          
          }


    
    
    
    }else if( $LX == 11 ){


        /*短信读取信息*/
    
        $typeoff = logac( 'typeoff' );
 
        $D =  db('msgbox');

        $datas = $D  -> where($where) ->order('off asc,id desc') -> limit( $limit ) -> select();

        if( $datas ){

            $CODE = 1;
            $CPID = array();

            foreach($datas as $ong){


                $SHUJU[] = array( 'id' => $ong['id'],
                              'biaoti' => $ong['biaoti'],
                               'atime' => date('Y-m-d H:i:s',$ong['ftime']),
                                 'off' => $ong['off'],
                             'offname' => $typeoff[$ong['type']],
                );
            }

        }

    }else if( $LX == 12 ){

        /*信息描述*/
        if(  $LANG['appxiset'] ){

             $CODE = 1;

            foreach( $LANG['appxiset'] as $ong ){ 

                $SHUJU[] = array( 'name' => $ong['系统名字'] ,
                                  'leixing' =>  $ong['APP连接类型'] ,
                                  'id' =>  $ong['系统连接'] ,
                 
             
                );

            }

       
        }



    }



    $DATA = apptongxin( $SHUJU , 1 , $CODE , $MSG );

}else if( $MOD == 'add'){








    $DATA = apptongxin(array('mode'=> 'add','test' => '这是默认mode add'));

}else if( $MOD == 'edit'){






    $DATA = apptongxin(array('mode'=> 'edit','test' => '这是默认mode edit'));

}else if( $MOD == 'del'){

    $SHUJU  = array();

    if( $USERID < 1 ) exit( json_encode( apptongxin( array() , 1 , -99 , '重新登录' ) ) );

        session_destroy();

        $CODE = 1;

     $DATA = apptongxin( $SHUJU , 1 , $CODE , $MSG );
}