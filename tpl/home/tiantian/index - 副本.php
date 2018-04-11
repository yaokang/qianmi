<?php if(!defined('ONGPHP'))exit('ErrorONGSOFT');

include QTPL.'head.php';
?><nav class="navbar navbar-default navbar-fixed-top m-component-nav" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header text-center clearfix">
           <a class="navbar-func pull-left" href="<?php echo WZHOST;?>"><span class="glyphicon fdayicon fdayicon-local"></span></a>
          <span class="pull-right navbar-func">
                        <a href="<?php $ong = danye(2); echo $ong['link'];?>" class="navbar-aboutus"><span class="glyphicon glyphicon-info-sign"></span></a>
              
              <a class="navbar-login" href="<?php echo $LANG['lianxigz'];?>"><span class="glyphicon fdayicon fdayicon-contact"></span></a>
                            <a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'cart' );?>" class="navbar-cart"><span class="glyphicon fdayicon fdayicon-cart"></span></a>
          </span>
                    <span class="navbar-title"><img src="/images/logo.svg"></span>
                  </div>
      </div>
    </nav>
            
    <section class="m-component-func" id="m-banner">
        <ul class="list-unstyled clearfix" id="categoryMenu">

            <li class="route1"><a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'shandian' );?>"><span class="glyphicon fdayicon fdayicon-day"></span>闪电送</a></li>

	        <li class="route2"><a href="<?php $ong = danye(1); echo $ong['link'];?>"><span class="glyphicon fdayicon fdayicon-all"></span>全部商品</a></li>

            <li class="route3"><a href="<?php echo mourl( $CONN['userword'].$CONN['fenge'].'myding' );?>"><span class="glyphicon fdayicon fdayicon-order"></span>查询订单</a></li>

            <li class="route4"><a href="<?php echo mourl( $CONN['userword'] );?>"><span class="glyphicon fdayicon fdayicon-login"></span>我的果园</a></li>
           
            
                    </ul>
    </section>


    

        <section class="m-component-bestsell">

            <ul class="list-unstyled">

                <li><a href="#" title="新客专享礼"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-01/303b5d068e8ee44adf04c190a3266365.jpg" alt src="/images/EmptyList@2x.png"></a></li>




            </ul>
        </section>

    
        <section class="m-component-promotion">

            <ul class="list-unstyled">

                <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>

                <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>

                <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>
                 <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>
                  <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>
                   <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>
                    <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>
                     <li><a href="#" title="单品广告位-佳沛新西兰绿果-上海康花北京广州"><img class="lazy" data-original="http://imgqn8.fruitday.com/images/2016-09-08/c4d9de3f6ba299b3fab18c6b05561f8b.jpg" alt src="/images/EmptyList@2x.png"></a></li>


            </ul>

        </section>
    
<?php include QTPL.'foot.php'?>