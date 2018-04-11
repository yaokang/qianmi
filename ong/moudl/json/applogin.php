<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');

$token = '';
if(  !isset( $_POST['apptoken'] ) ||  strlen( trim( $_POST['apptoken']) ) != 128 ){

    $token = session_id();
}

$CODE = 0;
$SHUJU = array();
$MSG = '';


/*登录帐号
 99  登录成功返回用户信息
 1   修改成功
 -1  帐号错误
 -2  密码错误
 -3  图形验证码错误
 -4  token令牌错误
 -5  其他错误
 -6  已经登录不能执行操作
 -7  短信验证码错误
 -8  发送失败联系管理
  2  发送成功
 -99 被注销重新登录
*/

$ZHAO   = isset( $_POST['z'] ) ? $_POST['z'] : '';// 登录帐号
$MIMA   = isset( $_POST['m'] ) ? $_POST['m'] : ''; // 登录密码
$TUC    = isset( $_POST['c'] ) ? $_POST['c'] : ''; // 图形验证码
$DUC    = isset( $_POST['x'] ) ? $_POST['x'] : ''; // 短信验证码
$TOKEN  = isset( $_POST['r'] ) ? $_POST['r'] : ''; // token令牌
$TUID  = isset( $_POST['tuid'] ) ? $_POST['tuid'] : '0'; // tuid
$LX     = isset( $_POST['L'] ) ? $_POST['L'] : 0 ; // 发送验证码类型  0 注册 1找回密码


if( $USERID > 0 ) {

    $USER = uid( $USERID);

    if($USER['off'] == '0'){
       
        session_destroy();
        exit( json_encode( apptongxin( array() , 1 , -99 , '被封重新登录'  ,$token) ) );
    } 

    $SHUJU = array( 'name' => $USER['name'],
                    'uid'  => $USERID,
                    'jine' => $USER['jine'],
                   'jifen' => $USER['jifen'],
                'kuohuobi' => $USER['huobi'],
                'touxiang' => pichttp( $USER['touxiang'] ),
                  'shouji' => xinghao( $USER['shouji'] ),
            );

    
    exit( json_encode( apptongxin( $SHUJU , 1 , -6 , '已经登录跳转' , $token ) ) );
}

if( strlen ( $ZHAO ) < 4 || strlen ( $ZHAO ) > 30 ) exit( json_encode( apptongxin( array() , 1 , -1 , '帐号格式错误 [ 4-30 ] 位'  ,$token) ) );
if( strlen ( $MIMA ) < 6 || strlen ( $MIMA ) > 32 ) exit( json_encode( apptongxin( array() , 1 , -2 , '密码格式错误 [ 6-32 ] 位'  ,$token) ) );

$where = array();

$D = db('user');

if( $MOD == 'soso'){
    $where = array();

    if( isshouji($ZHAO  ) ){

        $where['shouji'] =  $ZHAO;
        $where['zhanghao OR'] =  anquanqu($ZHAO);

    }else if( isemail( $ZHAO ) ){

          $where['email'] =  $ZHAO;
          $where['zhanghao OR'] =  anquanqu($ZHAO);
      
    }else $where['zhanghao'] =  anquanqu($ZHAO);

    $USER =  $D  ->where( $where )-> find();


    if( !$USER ) exit( json_encode( apptongxin( array() , 1 , -1 , '帐号或密码错误'  ,$token) ) );
    if( $USER['off'] == '0') exit( json_encode( apptongxin( array() , 1 , -2 , '帐号或密码错误!'  ,$token) ) );
    if( $USER['mima'] != mima( $MIMA )) exit( json_encode( apptongxin( array() , 1 , -2 , '帐号或密码错误!!' ,$token) ) );

    $_SESSION['uid']  =  $USERID = $USER['uid'];
    $_SESSION['ip']   =  ip();

    $CODE = 99;

    $SHUJU = array( 'name' => $USER['name'],
                    'uid'  => $USERID,
                    'jine' => $USER['jine'],
                   'jifen' => $USER['jifen'],
                'touxiang' => pichttp( $USER['touxiang'] ),
                  'shouji' => xinghao( $USER['shouji'] ),
            );
    return(json_encode(apptongxin( $SHUJU , 1 , $CODE , $MSG ,$token)));

}else if( $MOD == 'add'){

    /*注册帐号*/

    if( $TOKEN == '' || $TOKEN != $_SESSION['mtoken'] ) 
    exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) , 1 , -4 , 'token更新',$token)));

    if( ! isset( $_SESSION['code'] ) || $_SESSION['code'] != strtoupper ( $TUC )  || $_SESSION['code'] == '')
    exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) , 1 , -3 , '验证码错误',$token)));

    if( $USER ) 
    exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) , 1 , -1 , '已被注册',$token)));

    if( $DUC == '' || strlen( $DUC ) != 6 ) 
    exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) , 1 , -7 , '短信验证失败',$token)));

    if( $CONN['regtype'] > 0 ) {

        $HASH = 'sms/'.mima( $ZHAO);

        $hash = $Mem ->g( $HASH );

        if(!$hash )        
        exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) ,1,-7,'请重新发送验证码',$token) ) );

        if( $hash != $DUC ) 
        exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) ,1,-7,'短信验证码错误'  ,$token) ) );
        $Mem ->d( $HASH );

    }

    $REG =  array(    'name'  =>  xinghao(anquanqu( $ZHAO )),
                       'mima' =>  mima( $MIMA ),
                        'off' =>  1,
                         'ip' =>  $IP,
                      'level' =>  1,
                 'yanzhengip' =>  $CONN['ipoff'],
                      'atime' =>  time(),
                   'touxiang' => touxiang(),
    );
                
    if( $CONN['regtype'] == 0 ){ 
                    
        $REG['zhanghao'] =  $ZHAO;
        $WHERE = array( 'zhanghao' => $ZHAO );

    }else if($CONN['regtype'] == 1 ){

        if( !isshouji( $ZHAO ) ) 
        exit( json_encode( apptongxin( array() , 1 , -1 , '手机号码错误'  ,$token) ) );

        $WHERE = array( 'shouji' => $ZHAO );
        $REG['shouji'] =  $ZHAO;

    }else if($CONN['regtype'] == 2 ){ 

        $REG['email'] =  $ZHAO;
        $WHERE = array( 'email' => $ZHAO );

    }


    if($TUID  > 0 ) $_SESSION['tuid'] = $TUID;

    if( isset( $_SESSION['tuid'] ) ){
        
        if( $_SESSION['tuid']  > 0){

            $tuid =  uid( $_SESSION['tuid'] );

            if( $tuid ){

                    $REG['tuid'] = $_SESSION['tuid'];

                    for( $i = 1 ; $i < $CONN['tujishu'] ; $i++ ){

                         $wds = $i-1;
                         if($wds < 1) $wds= '' ;
                         $REG['tuid'.$i] = $tuid['tuid'.$wds];

                    }
            }
        }

    }

    $data = $D -> setshiwu( 1 ) -> insert( $REG );

    $fanhui = $D -> qurey( $data , 'shiwu');

    if( $fanhui ){

        $USER = $D  ->where(  $WHERE  )-> find();

        if( $USER ){

             $USERID = $USER['uid'];
            

            regsong( $USER );

            $CODE = 99;
            $SHUJU = array(  'name' => $USER['name'],
                             'uid'  => $USERID,
                             'jine' => $USER['jine'],
                            'jifen' => $USER['jifen'],
                         'kuohuobi' => $USER['kuohuobi'],
                         'touxiang' => pichttp( $USER['touxiang'] ),
                           'shouji' => xinghao( $USER['shouji'] ),
            );

            //dengtuilog( $USERID );
            //rgouwuche( $Mem , $USERID );

        }else exit( json_encode( apptongxin( array( ) , 1 , -5 , '注册失败' ,$token ) ) );

    }else     exit( json_encode( apptongxin( array( ) , 1 , -5 , '注册失败'  ,$token) ) );

    $DATA = apptongxin( $SHUJU , 1 , $CODE , $MSG ,$token,$token);

}else if( $MOD == 'edit'){

    /*修改密码*/
    if(     $CONN['regtype'] == 0 )   $where['zhanghao'] =  $ZHAO;
else if($CONN['regtype'] == 1 ){ 

     if( !isshouji( $ZHAO ) ) exit( json_encode( apptongxin( array() , 1 , -1 , '手机号码错误'  ,$token) ) );
     $where['shouji'] = $ZHAO;

}else if($CONN['regtype'] == 2 ){

     if( !isemail( $ZHAO ) ) exit( json_encode( apptongxin( array() , 1 , -1 , '邮箱格式错误'  ,$token) ) );
     $where['email'] = $ZHAO;

}else $where['zhanghao'] = $ZHAO;


$USER =  $D  ->where( $where )-> find();

    if( !$USER ) 
    exit( json_encode( apptongxin( array() , 1 , -1 , '帐号错误' )));

    if( ! isset( $_SESSION['code']) || $_SESSION['code'] != strtoupper ( $TUC )  || $_SESSION['code'] == '') 
    exit( json_encode( apptongxin( array( 'mtoken'=> $_SESSION['mtoken'] = token() ) , 1 , -3 , '验证码错误',$token)));
    
    
    $HASH = 'sms/'.$USER['uid'];

    $hash = $Mem ->g( $HASH );

    if(!$hash )
    exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) ,1,-7,'请重新发送验证码',$token) ) );

    if( $hash != $DUC ) 
    exit( json_encode( apptongxin( array( 'mtoken' => $_SESSION['mtoken'] = token() ) ,1,-7,'短信验证码错误' ,$token ) ) );
    $Mem ->d( $HASH );

    $USERID = $USER['uid'];

    $newmima =  mima( $MIMA );

    if( $USER['mima'] == $newmima  )exit( json_encode( apptongxin( array() ,'1','-5','和原来密码一样',$token) ) );

    $sql = $D -> setshiwu('1') ->where( array( 'uid' => $USERID )  )-> update( array( 'mima' => $newmima ));

    $fa = $D -> qurey($sql ,'shiwu');

    if(! $fa )exit( json_encode( apptongxin( array() ,'1','-5','修改失败',$token) ) );
    else{ 

        $CODE  = 1;
        uid( $USERID,1);
    }

    $DATA = apptongxin( $SHUJU , 1 , $CODE , $MSG );

}else if( $MOD == 'del'){

    if(     $CONN['regtype'] == 0 )   $where['zhanghao'] =  $ZHAO;
else if($CONN['regtype'] == 1 ){ 

     if( !isshouji( $ZHAO ) ) exit( json_encode( apptongxin( array() , 1 , -1 , '手机号码错误'  ,$token) ) );
     $where['shouji'] = $ZHAO;

}else if($CONN['regtype'] == 2 ){

     if( !isemail( $ZHAO ) ) exit( json_encode( apptongxin( array() , 1 , -1 , '邮箱格式错误'  ,$token) ) );
     $where['email'] = $ZHAO;

}else $where['zhanghao'] = $ZHAO;


$USER =  $D  ->where( $where )-> find();



    /*获得验证码*/
    if($LX == "0"){

       if( $USER ) 
       exit( json_encode( apptongxin( array() , 1 , -1 , '已被注册' ,$token)));
       $USER = array('uid' => 0);

    }else{

       if( !$USER ) 
       exit( json_encode( apptongxin( array() , 1 , -1 , '帐号错误' ,$token)));
    
    
    }

    if( ! isset( $_SESSION['code']) || $_SESSION['code'] != strtoupper ( $TUC )  || $_SESSION['code'] == '') 
    exit( json_encode( apptongxin( array( 'mtoken'=> $_SESSION['mtoken'] = token() ) , 1 , -3 , '验证码错误',$token)));

    if($LX == 0){

      if( $CONN['regtype'] == 0 ) 
      exit( json_encode( apptongxin( array() , 1 , -1 , '不需要短信接口',$token)));

    }

    if($LX == 0) $HASH = 'sms/'.mima( $ZHAO );
    else         $HASH = 'sms/'.$USER['uid'];

    $hash = $Mem ->g( $HASH );

    if( $hash )  
    exit( json_encode( apptongxin( array( )   , 1 , -5 , '已经发送,请注意查收' ,$token) ) );

    $JISHU = $Mem -> g ($HASH.'tj');

    if( $JISHU && $JISHU  > (int) $LANG['faxianzhi'] ) 
    exit( json_encode( apptongxin( $fanhui , '1' , -1 , '今日的发送量达到上线.',$token) ) );

    $faongxym = rand(100000,999999);
    $neirong  = str_replace(array( 'UNMAE', 'UID' ,'YZM'), array( $ZHAO , $USER['uid'] , $faongxym ), $LANG['yzmtongzhi'] );

    if($CONN['regtype'] == 1 ){

       $fanc = duanxin( $ZHAO , $neirong );
       $w = 0;

    }else if($CONN['regtype'] == 2 ){

       $fanc = youxiang( $ZHAO , $neirong , $LANG['zjmailti'], $LANG['fmaile'] );
       $w = 1;

    }else exit( json_encode( apptongxin( array() , 1 , -1 , '不需要短信接口',$token)));

    if( strstr( $fanc, 'success')  ){

        $fanc = str_replace('success:','',$fanc);
        $shijia =  mktime(0,0,0,date('m'),date('d')+1,date('y'))-time();
        $off = 1;
        $Mem ->s( $HASH , $faongxym , 121);
        if( !$JISHU ) $Mem ->s(  $HASH.'tj' , 1 , $shijia );
        else          $Mem ->ja( $HASH.'tj' , 1 , $shijia );

    }else{

        $off = 0 ;
        $fanc = str_replace('error:','',$fanc);

    }

    tongzhiruku( $D , $ZHAO , $neirong , $USER['uid'] ,$w ,$off,$fanc);

    if( $off == 1 ){

        $CODE = 2 ;
        $MSG  = '验证码发送成功';

    } else {

        $CODE =  -8 ;
        $MSG  = '验证码发送失败,联系客服';
    }

    $DATA = apptongxin( $SHUJU , 1 , $CODE , $MSG ,$token);

}