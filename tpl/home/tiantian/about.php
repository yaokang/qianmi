<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');

include QTPL.'head.php';
?>




<nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
            <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-home"></span></a>
            <a class="navbar-func pull-right" href="<?php echo $LANG['lianxigz'];?>"><span class="glyphicon fdayicon fdayicon-contact"></span></a>
            <span class="navbar-title"><?php echo $DATA['name']?></span>
        </div>
      </div>
    </nav>

  <section class="m-component-order" id="m-order">
        <div class="container m-aboutus">
            <div class="m-aboutus">

                <?php echo $DATA['neirong'];?>


            </div>

        </div>    
    </section>

<?php include QTPL.'foot.php'?>