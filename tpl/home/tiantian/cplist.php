<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');

include QTPL.'head.php';
?>
 <script type="text/javascript">
   function sousuo(){
    var url = document.getElementById("URLs");
	 if(url.value== "")
		 alert('请填写关键字');
	 else
	 window.location.href="<?php echo mourl($CONN['sosoword'],'',$CONN['fenge']);?>"+url.value+"<?php echo $CONN['houzui'];?>";
  return false;
    }
  </script>
    <nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
          <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
          <span class="pull-right navbar-func">
                          <a href="<?php echo mourl( $CONN['userword'] );?>" class="navbar-login"><span class="glyphicon fdayicon fdayicon-login"></span></a>
                          <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>" class="navbar-cart">
                <span class="glyphicon fdayicon fdayicon-cart"></span>
              </a>
          </span>
          <form  method="get" onsubmit="return sousuo();">
          <span class="navbar-search">
            <input type="text" placeholder="寻找鲜果" id="URLs" class="form-control" name="keyword"/>
          </span>
          </form>
        </div>
      </div>
    </nav>

    <section class="m-component-category clearfix" id="m-category" >
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-stacked" role="tablist">

            <?php $chanpin = menulist(1);

                if(!$chanpin) $chanpin = array();
                $z = 0;

                foreach( $chanpin as $ong ){
            ?>
             
            <li role="presentation" <?php echo $z=='0' ?'class="active"':'' ?> data="<?php echo $ong['id'];?>"><a href="javascript:void(0);" ><?php echo $ong['name'];?></a></li>

            <?php $z++; }?>
           

        </ul>


        <div class="tab-content">

            <?php $z = 0; foreach( $chanpin as $ong ){ ?>
            <div role="tabpanel" class="tab-pane fade in" <?php echo $z=='0'?' style="display:block;"':'';?> id="cate<?php echo $ong['id'];?>">
                <ul class="clearfix list-unstyled">

                    <?php $zchanpin = menulist($ong['id']);

                       if(!$zchanpin) $zchanpin = array();
                       foreach( $zchanpin as $zong){
                        ?>

                    <li>    <a href="<?php echo $zong['link']?>"> 
                                <?php if($zong['tupian'] != '' ){?>
                                    <img src="<?php echo $zong['tupian']?>"> 
                                <?php } ?>

                                <?php echo $zong['name']?>
                            </a>
                    </li>

                    <?php } ?>

                    <li> <a href="<?php echo mourl($ong['url']);?>"><img src="/images/gengd.png">全部</a> </li>

                 </ul>

            </div>

            <?php $z++;} ?>


            
        </div>

    </section>
<?php include QTPL.'foot.php'?>
<script type="text/javascript">

$(function(){

    $(".nav-stacked li").click( function(){

        idd = $(this).attr('data');

        $(".nav-stacked li").removeClass('active');

        $(this).addClass('active');
        $(".tab-pane").hide();

        $("#cate"+idd).show();



    
     
    
    });


});

</script>