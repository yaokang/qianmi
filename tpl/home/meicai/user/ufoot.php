<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');?>
<script type="text/javascript">
var DAOJI = 120;  /*短信倒计时*/
var LOFROM = <?php echo json_encode( array( 'zhanghao' => '手机号/邮箱', 'pass' => '登录密码', 'epass' => '重复密码', 'code' => '信息验证码','vcode' => '图形验证码' ) );?>;  /*用户登录信息提示*/
function yzpost( canshu ,$_POST){

        if( canshu ){

            for(var i in canshu){

                da    = canshu[ i ] . split( '#' );

                $name = da[0];
                $type = da[1];
                $zhi  = da[2];

                if( ! $_POST[$name] ) return  { "code":"0","biao": $name  ,"msg":"" };

                if( $type == 'len' ){

                    if( $_POST[$name] == '' ) return  { "code":"0","biao": $name  ,"msg":"" };

                    $zlen = $_POST[$name].length;
                    $zifu = $zhi. split( '-' );

                    if ( $zifu[1] && $zifu[1] != '' ){

                        if( $zlen < $zifu[0] || $zlen > $zifu[1]  ) return  { "code":"0","biao": $name  ,"msg":$zhi };

                    }else if( $zifu[0] !=  $zlen ){

                        return  { "code":"0","biao": $name  ,"msg":$zifu[0] };
                    }

                }else if( $type == '=' ){

                    

                    if( $_POST[$name] != $zhi ) return  { "code":"0","biao": $name  ,"msg": $zhi };
                }

            }
        }

        return  { "code":"1","biao":"all","msg":"" };
}


function login(){

        zhanghao = $("[name=zhanghao]").val();
        epass    = pass = $("[name=pass]")    .val();
      
        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        if( $("[name=vcode]").is(':visible') )
            canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4' ];
        else
            canshu = [ "zhanghao#len#2-30" , "pass#len#6-32" ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode } );

        if( fanhui.code != 1){

            layer.msg(LOFROM[fanhui.biao] + '错误'  );

            //mui.toast (LOFROM[fanhui.biao] + '错误'  );

    
            return false;
        }


        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'login',d:'get',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken:TOKEN},
            dataType:'json',
            type:'post',
            timeout:1000,
            success:function( data ){

                layer.msg( '登录成功'  ,{url:USERUL });
           
            },error:function(xhr){

                dataerror(xhr , '登录' );

            }
        });

}

function reg(){

    zhanghao = $("[name=zhanghao]").val();
    epass    =  pass  = $("[name=pass]")    .val();
    vcode    = $("[name=vcode]")   .val();
    code     = $("[name=code]")    .val();

    
    canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4','code#len#6','epass#=#'+pass ];

    fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode ,'code':code,'epass':epass } );

    if( fanhui.code != 1){

        layer.msg(LOFROM[fanhui.biao] + '错误'  );

        //mui.toast (LOFROM[fanhui.biao] + '错误'  );


        return false;
    }

    mui.ajax( HTTP + 'json.php' ,{

        data:{y:'login',d:'post',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken:TOKEN},
        dataType:'json',
        type:'post',
        timeout:10000,
        success:function( data ){

                 mui.toast ( '注册成功'  ,{url:USERUL });
       

        },error:function(xhr){

        
            dataerror(xhr , '注册' );
        }
    });

}


function zpass(){

        zhanghao = $("[name=zhanghao]").val();
        epass    = pass = $("[name=pass]") .val();

        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        
        canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4','code#len#6','epass#=#'+pass ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode ,'code':code,'epass':epass } );

        if( fanhui.code != 1){

            mui.toast (LOFROM[fanhui.biao] + '错误'  );
            return false;
        }

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'login',d:'put',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken:TOKEN},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                     mui.toast ( '找回成功'  ,{url:USERUL });
           

            },error:function(xhr){

            
                dataerror(xhr , '找回' );
            }
        });

       
}


function daojishi(){

        DAOJI--;

        if(DAOJI < 1){

            $("#TestGetCode").attr("disabled",false);
            clearInterval( setdao );
            DAOJI = 120;
            $("#TestGetCode").find("span").html('点击获取');

        }else  $("#TestGetCode").find("span").html('还剩<b id="timeout">'+DAOJI+'</b>秒');
}


function facode( lx ){

        zhanghao = $("[name=zhanghao]").val();
        epass   = pass = $("[name=pass]") .val();

        vcode    = $("[name=vcode]")   .val();
        code     = $("[name=code]")    .val();

        canshu = [ "zhanghao#len#2-30" , "pass#len#6-32",'vcode#len#4','epass#=#'+pass ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "vcode" : vcode ,'code':code,'epass':epass } );

        if( fanhui.code != 1){

            layer.msg(LOFROM[fanhui.biao] + '错误'  );

            //mui.toast (LOFROM[fanhui.biao] + '错误'  );
            return false;
        }



        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'login',d:'delete',zhanghao:zhanghao,pass:pass,epass:epass,vcode:vcode,code:code,ttoken: lx },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                    
            if( data.token && data.token != '') TOKEN = data.token;

            if(data.code == 3){

                $("[name=code]").val(data.msg);
            
            
            }

            layer.msg ('发送成功');

            $("#TestGetCode").attr("disabled","true");

            setdao = setInterval("daojishi()",1000);
           

            },error:function(xhr){

            
                dataerror(xhr , '找回' );
            }
        });


     

}


function kjlogin(){

       zhanghao = $("[name=zhanghao]").val();
       vcode    = $("[name=vcode]")   .val();
       code     = $("[name=code]")    .val();
       pass     = $("[name=pass]")    .val();
         canshu = [ "zhanghao#len#2-30" ,'vcode#len#4','code#len#6' ];

        fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "vcode" : vcode ,"code":code} );

        if( fanhui.code != 1){

            mui.toast (LOFROM[fanhui.biao] + '错误'  );
            return false;
        }

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'login',d:'get',zhanghao:zhanghao,pass:pass,vcode:vcode,code:code,kjlogin:2,ttoken:TOKEN},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                    
            if( data.token && data.token != '') TOKEN = data.token;

           
                  mui.toast ( '登录成功'  ,{url:USERUL }); 
            },error:function(xhr){

            
                dataerror(xhr , '快捷登录' );
            }
        });

        


}


</script>