<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');


$PAGE= (int)isset($HTTP['2'])?$HTTP['2']:1;
$DATA['name'] = '搜索-'.$HTTP['1'];


include QTPL.'head.php';
?>

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
          <span class="navbar-title"><?php echo $DATA['name']?></span>
        </div>
      </div>
    </nav>

    <section class="m-component-prolist" id="m-prolist">
                <div id="container">      
            <ul class="list-unstyled">
                <?php  $DATAS = neirlist(array('where'=> array(  'off' => 2,'cid IN' => xjcid(1),
                                                 '(' => 'and',
                                         'name LIKE' => '%'.$HTTP['1'].'%',
                                      'guanjian OLK' => '%'.$HTTP['1'].'%',
                                       'miaoshu OLK' => '%'.$HTTP['1'].'%',
                                                 ')' => ''
                                                ),'page'=>$PAGE,'http'=>$HTTP['0'].$CONN['fenge'].$HTTP['1'],'pagenum' => ($SHOUJI?-1:5),'num'=>100 ),'center', $D );
                
                
                if( $DATAS['date'] ){

                    foreach( $DATAS['date'] as $ong ){

                        if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                        else $ong['canshu'] =  array();

                        $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                        $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;

                ?>
                 
                <li>
                    <a href="<?php echo $ong['link'];?>" title="<?php echo $ong['name'];?>">
                        <img class="lazy pull-left" data-original="<?php echo pichttp($ong['tupian']);?>"  src="/images/DefaultImg@2x.png">
                        <div class="m-prolist-info" >
                            <h3><?php echo $ong['name'];?></h3>
                            <?php if($ong['canshu'] ){ ?><h4><?php echo $shuju['name'].'：'.$shuju['0']['canshu'];?></h4><?php } ?>
                            <h5><?php echo $HUOBIICO[$ong['huobi']] ;?><?php echo $jiage <=0? $ong['jiage']: $jiage;?></h5>
                            <span class="m-prolist-car" onclick="lijigo( <?php echo $ong['id'];?>);return false;"><i class="glyphicon fdayicon fdayicon-procart"></i></span>
                        </div>
                    </a>
                </li>

                <?php } } ?>
                 
               
                            </ul>
        </div>  
              
        <div class="text-center m-component-more ajax_loading">     
            <span class="glyphicon  fdayicon fdayicon-loading"></span>加载更多...       
            <!-- <button type="button" class="btn btn-success">加载更多...</button> -->
        </div>
<?php include QTPL.'foot.php'?>