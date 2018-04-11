<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'head.php';

?>
<style type="text/css">
    .ke-upload-file{height:76px;width:76px;margin-left: -90px;margin-top: -27px;}
</style>
 
    <section class="p-component-usercenter clearfix">
        <div class="sidebar s_ani" >
            <span class="arrow"  id="arr"></span>
            <ul class="list-unstyled">
	            <li><a href="<?php echo mourl($CONN['userword'])?>">我的账户</a></li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'myding')?>"  >我的订单</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jifen');?>" >我的积分</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'jine')?>" >账户余额</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'hongbao')?>" >我的优惠券</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'pay')?>"  >在线充值</a>
                </li>
                <li>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'setting')?>" class="cur">基本资料</a>
                    <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'shouhuo')?>" >收货地址</a>
                </li>
            </ul>
        </div>
        <div class="main">
            <h6 class="basic">基本资料</h6>
            <form action="">
                <div class="content">
                    <ul>
                        <li class="pic" id="pic" >
                          <span class="pull-left">当前头像：</span>
                          <div class="pull-left">
                            <img src="<?php echo $USER['touxiang']?>" alt="" class="touxiang" id="">
                          </div>
                          <a class="pull-left " style="display:block; height:50px; width:100px" id="uploadButton">修改</a>
                        </li>
                        <li class="name" id="name">
                          <span class="pull-left">昵称：</span>
                          <input type="text" value="<?php echo $USER['name']?>" class="pull-left nickname">
                          <span class="prompt pull-left">昵称必须小于25个字符</span>
                        </li>
                        <li class="sex" id="sex">
                          <span class="pull-left">性别:</span>
                          <div class="pull-left csex">
                            <i class="<?php echo $USER['xingbie']== 1?'cur':'' ?>"  sid="1"></i><label>男</label>
                            <i class="<?php echo $USER['xingbie']== 0?'cur':'' ?>"  sid="0"></i><label>女</label>
                            <i class="<?php echo $USER['xingbie']==-1?'cur':'' ?>"  sid="-1"></i><label>保密</label>
                          </div>
                        </li>
                        
                        <li class="tel" id="tel">
                            <span class="pull-left">手机：</span>
                            <input type="text" class="pull-left" disabled="disabled" value="15961150981">
                            <a href="/user/changeTel" class="pull-left">更换手机</a>
                        </li>
                        <li class="tel mail" id="mail">
                            <span class="pull-left">邮箱：</span>
                            <input type="text" class="pull-left" value="" id="email">
                            <span class="pull-left"></span>
                        </li>
                    </ul>
                    <p class="test">邮件已发送，请在邮箱中完成验证</p>
                    <p class="test-ok">已验证</p>
    		        <p class="ftest">邮件发送失败，请检查邮箱</p>
                    <p class="test-fail">不能验证</p>
                    <a href="javascript:;" class="submit-box btn btn-success">确认提交</a>
                </div>
            </form>
        </div>
    </section>
<!--底部 -->
<?php
include QTPL.'foot.php';
?>
<script type="text/javascript" src="<?php echo TPL?>js/kindeditor/kindeditor-all-min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        TOKEN = '<?php echo wenyiyz( 'userid/'.$USERID ,'' , $Mem );?>';

        var UPURL = '<?php echo WZHOST;?>json.php?y=user&lx=2&uplx=image&dir=image&d=post&ttoken='+TOKEN;

        KindEditor.ready(function(K) {

            var uploadbutton = K.uploadbutton({
                button : K('#uploadButton'),
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





        $('.csex i').click(function(){
            $('.csex i').removeClass('cur');
            $(this).addClass('cur');
            var sex = $(".csex").find(".cur").attr('sid');
            mui.ajax(HTTP+'json.php',{
                data:{y:'user',d:'post',lx:3,sex:sex,ttoken:TOKEN},
                datatype:'json',
                type:'post',
                timeout:10000,
                success:function(data){
                    TOKEN = data.token;
                    console.log(data);
                },error:function(xhr){
                    console.log(xhr);
                }
            });
        });
        $('.btn-success').click(function(){
            var name= $(".nickname").val();
            mui.ajax(HTTP+'json.php',{
                data:{y:'user',d:'post',lx:1,nicheng:name,ttoken:TOKEN},
                datatype:'json',
                type:'post',
                timeout:10000,
                success:function(data){
                    console.log(data);
                },error:function(xhr){
                    console.log(xhr);
                }
            });
            
        });    
    });
</script>
