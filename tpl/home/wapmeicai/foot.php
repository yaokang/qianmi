<?php if(!defined('ONGPHP'))exit('Error OngSoft');?>
<script type="text/javascript">
     var ANNIU = true;
       var UID = 0; /*默认用户uid*/
    var GOUCHE = [];  /* 购物 默认参数列表 */
     var TOKEN = ''; /* token */
      var HTTP = '<?php echo WZHOST;?>'; /*js 访问网址*/
    var USERUL = '<?php if(isset( $_SESSION['reback'])) echo $_SESSION['reback']; else echo mourl( $CONN['userword']);?>'; /*用户跳转网址*/
 var $HUOBIICO = <?php echo json_encode($HUOBIICO);?>; /*货币单位*/
     var HUOBI = <?php echo json_encode( $HUOBI );?>; /*货币*/
    var huobi0 = huobi1 = huobi2 = huobi3 = 0;
    var HUOZUI = '<?php echo $CONN['houzui']?>';


    function gouwuche(id ){


        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'gouwuche',d:'get'},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                setgwnum( data );

                if(id == 1)gengxinx();

          
           

            },error:function(xhr){

                
            }
        });

    
    
    }

    function dataerror( data , ming ){

        if( data.status == '401' ){

            mui.toast ( '需要登录用户' ,{ url:USERUL } );

        }else if( data.status == '304' ){

            mui.toast ('修改'+ming+'失败' );

        }else if( data.status == '410' ){
               
            mui.toast ('删除'+ming+'失败' );

        }else if( data.status == '404' ){

            mui.toast ('查询'+ming+'失败' );

        }else if( data.status == '406' ){

            mui.toast ('新增'+ming+'失败' );

        }else if( data.status == '415' ){

            if( !data.responseJSON &&  data.responseText ){

                data.responseJSON = eval("("+ data.responseText +")");

            }

            if( data.responseJSON ){

                DATA = data.responseJSON;

                if( DATA.code == 2 ){

                    if( $( ".imgsrc" ).length > 0 ) $( ".imgsrc" ).attr( { src : $(".imgsrc").attr('src')+'&1=' } );

                }

                if( DATA.token && DATA.token != '') TOKEN = DATA.token;

                mui.toast (DATA.msg );

            }else mui.toast ('非法数据' );

        }else mui.toast ('数据错误' );
    }

    function setgwnum( data ){

        DATA = data.data;

        if( DATA ){

             mui.each(DATA.data, function( index, item ){

                 mui.each(item , function( dage, vvv ){

                    GOUCHE[dage] = vvv['num'];
                 });
            });

            

            $(".mui-icon-mcgwc").find(".mui-badge").html(DATA.count);


            if( DATA.count > 0) $(".mui-icon-mcgwc").find(".mui-badge").show();
            else{
                
                $(".mui-icon-mcgwc").find(".mui-badge").hide();
                $(".mui-bar-nav").find(".mui-badge").hide();

                

            }

           

        }
    
    
    }

    function jiarugo( cpid, num ,cansu,jiahaoback,tdcaozuo){

        /* 加入购物车 */

        ANNIU = false;

        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'gouwuche',d:'post',cpid:cpid,num:num,cansu:cansu,qx:1},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                jiahaoback( tdcaozuo , num  ,data );
           

            },error:function(xhr){

                ANNIU = true;
                dataerror(xhr , '购物车' );
            }
        });
    }


    function shanchugo( cpid ,cansu,jiahaoback,tdcaozuo){ 


        ANNIU = false;

        /* 删除购物车 */
        mui.ajax( HTTP + 'json.php' ,{

            data:{y:'gouwuche',d:'delete',cpid:cpid,cansu:cansu},
            dataType:'json',
            type:'post',
            timeout:10000,
            success:function( data ){

                jiahaoback(tdcaozuo,'' ,data );
               

            },error:function(xhr){
                ANNIU = true;
                    dataerror(xhr , '购物车' );
            }
        });
    }

</script>