<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');

$_SESSION['reback'] = mourl($URI);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    <link rel="stylesheet" href="<?php echo TPL?>js/kindeditor/themes/default/default.css" />
    <style>
    body{background: #f5f5f5;padding-bottom:100px;}
    .title {
                margin: 20px 15px 10px;
                color: #6d6d72;
                font-size: 15px;
            }
    .mui-table-view-cell:after{left:0px;}

    .mui-table-view-cell .mui-icon{font-size:18px;}
    
    .ke-form{width:40px;height:40px;opacity: '0';}
    .mmynca{position:relative;}
    .mmsubmit{position:absolute;top:0px;right:0px;z-index:0px;}
    #uploadButton{display:none;opacity: '0';}
    .mui-input-row{background:#fff;}
    .mui-input-group .mui-input-row:after{left:0px;}
    .mui-card-link{font-size:14px;color:#0BBE06;}
    .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:33px;width:25px;height:33px;}

    </style>


</head>
<body style="padding-bottom:66px;">

       

    <header id="header" class="mui-bar mui-bar-nav">

        <a class="mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo mourl( $CONN['userword']);?>"></a>
        <h1 class="mui-title">帐号信息</h1>
       
    </header>

    <div class="mui-content" style="background:transparent;">

            
            <ul class="mui-table-view">

                <li class="mui-table-view-cell mui-media">

                    <a href="javascript:;">
                        <span class="mui-pull-right"> <?php echo $USER['uid'];?> </span>
                        <p class='mui-ellipsis'> UID </p>
                    </a>

                </li>

                <li class="mui-table-view-cell mui-media">

                    <a href="javascript:void(0);">

                        <span class="mui-pull-right mmynca">
                            <img class="mui-media-object mui-pull-right touxiang" style="height:40px;width:40px;border-radius: 50%;" src="<?php echo touxiang( $USER['touxiang']);?>">
                            <input  id="uploadButton" class="mui-pull-right mmsubmit" type="submit" value="" >
                        </span>
                        <p class='mui-ellipsis'>头像</p>
                    </a>
                </li>


                <li class="mui-table-view-cell mui-media">

                    <a href="javascript:nicheng();">
                        <span class="mui-pull-right nicheng"> <?php echo $USER['name'];?> </span>
                        <p class='mui-ellipsis'>昵称</p>
                    </a>

                </li>

                <li class="mui-table-view-cell mui-media">
                    <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'jine');?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo $USER['jine'];?></span>
                        <p class='mui-ellipsis'> <b class="mui-icon mui-icon-mccyue" style="color:red;"></b>
                        
                        <?php echo $HUOBI['0'];?></p>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'jifen');?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo $USER['jifen'];?></span>
                        <p class='mui-ellipsis'> <b class="mui-icon mui-icon-star" style="color:green;" ></b> <?php echo $HUOBI['1'];?></p>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'huobi');?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo $USER['huobi'];?></span>
                        <p class='mui-ellipsis'> <b class="mui-icon mui-icon-star-filled" style="color:#0024B7;" ></b> <?php echo $HUOBI['2'];?></p>
                    </a>
                </li>



            </ul>

            <div class="title"> 快捷登录 </div>
            <ul class="mui-table-view">

                
                <?php 


               
                
                if($LANG['duanxinid'] != ''){ ?>
                <li class="mui-table-view-cell mui-media">
                    <a href="javascript:<?php if( (int)$USER['shouji'] == '0'){ ?>openbang(1,'bangding')<?php }else{ ?>void(0)<?php }?>;" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo ( (int)$USER['shouji'] == '0' ) ? '<b style="color:red;">未绑定</b>':'<b style="color:green;">'.xinghao($USER['shouji']).'</b>';?></span>
                        <p class='mui-ellipsis'> <b class="mui-icon mui-icon-phone-filled" style="color:#0024B7;" ></b> 手机号码</p>
                    </a>
                </li>
                <?php } ?>


                <?php if($LANG['mailfa'] != ''){ ?>
                <li class="mui-table-view-cell mui-media">
                    <a href="javascript:<?php if( $USER['email'] == ''){ ?>openbang(2,'bangding')<?php }else{ ?>void(0)<?php }?>;" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo ( $USER['email'] == '' ) ? '<b style="color:red;">未绑定</b>':'<b style="color:green;">'.xinghao($USER['email']).'</b>';?></span>
                        <p class='mui-ellipsis'> <b class="mui-icon mui-icon-email-filled" style="color:#000;" ></b> 邮箱帐号</p>
                    </a>
                </li>
                <?php } ?>


                <?php if($LANG['kjwxid'] != ''){ ?>
                <li class="mui-table-view-cell mui-media">
                    <a href="<?php if( $USER['zhifubaoopen'] == '') echo WZHOST.'login/login.php?y=2'; else echo 'javascript:void(0);';?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo ( $USER['weixin'] == '' ) ? '<b style="color:red;">未绑定</b>':'已绑定';?></span>
                        <p class='mui-ellipsis'> <b class="mui-icon mui-icon-weixin" style="color:#0ECB19;" ></b> 微信登录</p>
                    </a>
                </li>
                <?php } ?>

                <?php if($LANG['kjqqid'] != ''){ ?>
                <li class="mui-table-view-cell mui-media">
                    <a href="<?php if( $USER['zhifubaoopen'] == '') echo WZHOST.'login/login.php?y=1'; else echo 'javascript:void(0);';?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo ($USER['qqopen'] == '' ) ? '<b style="color:red;">未绑定</b>':'已绑定';?></span>

                    <p class='mui-ellipsis'> <b class="mui-icon mui-icon-qq" style="color:#E44A34;" ></b> QQ登录 </p>
                    </a>
                </li>
                <?php } ?>

                <?php if($LANG['kjzfbid'] != ''){ ?>
                <li class="mui-table-view-cell mui-media">

                    <a href="<?php if( $USER['zhifubaoopen'] == '') echo WZHOST.'login/login.php?y=4'; else echo 'javascript:void(0);';?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo ( $USER['zhifubaoopen'] == '' ) ? '<b style="color:red;">未绑定</b>':'<b style="color:green;">已绑定</b>';?></span>

                    <p class='mui-ellipsis'> <b class="mui-icon mui-icon-zhifubao" style="color:#00AAEE;" ></b> 支付宝登录 </p>
                    </a>
                </li>
                <?php } ?>

             

                <?php  if($LANG['kjweiboid'] != ''){ ?>
                <li class="mui-table-view-cell mui-media">

                    <a href="<?php if( $USER['weibo'] == '') echo WZHOST.'login/login.php?y=3'; else echo 'javascript:void(0);';?>" class="fdayicon-client" >
                        <span class="mui-pull-right"><?php echo ($USER['weibo'] == '' ) ? '<b style="color:red;">未绑定</b>':'已绑定';?></span>

                    <p class='mui-ellipsis'> <b class="mui-icon mui-icon-weibo" style="color:#FF3407;" ></b> 微博登录 </p>
                    </a>
                </li>
                <?php } ?>



            

            </ul>

    </div>
   
<div id="bangding" style="display:none;background:#fff;" class="mui-popover mui-popover-action mui-popover-bottom"><form class="mui-input-group" style="background:0 0;margin-top:2px" action="post"><div class="mui-input-row"><span class="mui-icon mui-icon-contact inputfdongico"></span> <input style="width:100%;text-indent:18px" type="text" name="zhanghao" class="mui-input-clear mtts" placeholder="您的手机/邮箱"></div><div class="mui-input-row mui-password"><span class="mui-icon mui-icon-locked inputfdongico"></span><input  style="width:100%;text-indent:18px;" type="password" name="pass" class="mui-input-password" placeholder="设置登录密码"></div> <div class="mui-input-row"><span class="mui-icon mui-icon-image inputfdongico"></span> <input style="width:100%;text-indent:18px" type="text" name="vcode" class="" placeholder="图形验证码"> <img src="<?php echo WZHOST.'api.php?action=vocde'?>" style="width:100px" class="inputfdong imgsrc"></div><div class="mui-input-row"><span class="mui-icon mui-icon-email inputfdongico"></span> <input style="width:100%;text-indent:18px;height:40px;" type="number" name="code" class="" placeholder="收到的验证码"><div class="inputfdong"><button type="button" class="mui-btn mui-btn-danger" style="width:100px" id="TestGetCode" onclick="return facode2();"><span class="mui-badge mui-badge-primary">点击获取</span></button></div></div><button type="button" class="mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px auto 10px auto" onclick="return bangding()">绑定</button></form></div>

</body>
</html>

<?php include QTPL.'foot.php';
include QTPL.'user/ufoot.php';
?>
<script type="text/javascript" src="<?php echo TPL?>js/kindeditor/kindeditor-all-min.js"></script>
<script>
TOKEN = '<?php echo wenyiyz( 'userid/'.$USERID ,'' , $Mem );?>';
var UPURL = '<?php echo WZHOST;?>json.php?y=user&lx=2&uplx=image&dir=image&d=post&ttoken='+TOKEN;


KindEditor.ready(function(K) {

				var uploadbutton = K.uploadbutton({
					button : K('#uploadButton')[0],
					fieldName : 'image',
					url : UPURL,
					afterUpload : function(data) {

                        if( data.token && data.token != '') {

                            TOKEN = data.token;

                            UPURL = '<?php echo WZHOST;?>json.php?y=user&lx=2&uplx=image&dir=image&d=post&ttoken='+TOKEN;

                            $(".ke-form").attr({action:UPURL });

                            uploadbutton.options.url = UPURL;

                        }

                        if (data.code == -2){

                            mui.toast (  data.msg  );

                        }else if(data.code == 1){

                            $(".touxiang").attr({ src : data.msg } );

                        }else{

                            mui.toast (  data.msg  );

                        }


					},
					afterError : function(str) {

                        mui.toast ( str );
					
					}

				});

				uploadbutton.fileBox.change(function(e) {

					uploadbutton.submit();

				});

            

                $(".ke-form").css({opacity: '0',background:'red',width:'40px',height:'40px',top:'0px',left:'0px'});

                

});


function facode2(){

    zhanghao = $("[name=zhanghao]").val();
     pass    = $("[name=pass]")    .val();
    code     = $("[name=code]")    .val();
    canshu   = ["zhanghao#len#2-30" , "pass#len#6-32" ];

    fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass } );
   
    if( fanhui.code != 1){

        mui.toast (LOFROM[fanhui.biao] + '错误'  );

        return false;
    }

    mui.ajax( HTTP + 'json.php' ,{

            data:{y:'user',d:'delete',zhanghao:zhanghao,pass:pass,ttoken: TOKEN },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                    
            if( data.token && data.token != '') TOKEN = data.token;

            if(data.code == 3){

                $("[name=code]").val(data.msg);
            
            
            }

            mui.toast ('发送成功');

            $("#TestGetCode").attr("disabled","true");

            setdao = setInterval("daojishi()",1000);
           

            },error:function(xhr){

            
                dataerror(xhr , '发送' );
            }
        });


   


}


function nicheng(){

    mui.prompt('','请输入新的昵称','修改昵称',['取消','确认'],function(e){

        if(e.index == 1){

            val = e.value;

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'user',d:'post',nicheng:val,lx:1,ttoken: TOKEN },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                    
            if( data.token && data.token != '') TOKEN = data.token;

                $(".nicheng").html( val );

                mui.toast ('修改成功');

            },error:function(xhr){

                dataerror(xhr , '修改' );
            }
        });

        }

	    

    
    });

}

function bangding(){

    /* 发送绑定信息*/

    zhanghao = $("[name=zhanghao]").val();
     pass    = $("[name=pass]")    .val();
    code     = $("[name=code]")    .val();
    canshu   = ["zhanghao#len#2-30" , "pass#len#6-32",'code#len#6' ];

    fanhui = yzpost( canshu , { "zhanghao" : zhanghao , "pass" : pass , "code" : code } );
   
    if( fanhui.code != 1){

        mui.toast (LOFROM[fanhui.biao] + '错误'  );
        return false;
    }


    mui.ajax( HTTP + 'json.php' ,{

            data:{y:'user',d:'put',zhanghao:zhanghao,pass:pass,code:code,ttoken: TOKEN },
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                    
            if( data.token && data.token != '') TOKEN = data.token;

        

            mui.toast ('绑定成功',{ url: USERUL });

            },error:function(xhr){

            
                dataerror(xhr , '绑定' );
            }
        });

    

   


}



function openbang(title,ID){

    if(title == 1){

        titles = '绑定手机';
        $("[name=zhanghao]").attr({"placeholder":'绑定手机'});

    }else{

        titles = '绑定邮箱';

        $("[name=zhanghao]").attr({"placeholder":'绑定邮箱'});

    }

    mui("#"+ID).popover('toggle');

    $(".imgsrc").click(function(){

        $( this ).attr( { src : $(this).attr('src')+'&1=' } );

    });
    
   
}

</script>