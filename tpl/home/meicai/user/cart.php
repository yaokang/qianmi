<?php if(!defined('ONGPHP'))exit('Error ONGSOFT');
include QTPL.'user/uheader.php';
?>

<!--中部开始-->
<div class="cart w-750">
    <div class="cart-filter-bar pt-50">
        <div class="mycart">
            <p class="pull-left">我的购物车</p>
            <a href="/" class="pull-right">继续逛逛&gt;</a>
        </div>
    </div>
    <div class="cartmain cartspage">
        <div class="cart-head clearfix">
            <div class="cart-select pull-left">
               <!--  <p class="select selected"></p><input type="hidden" value="" />
                <span>全选</span> -->
            </div>
            <input type="hidden">
            <div class="cart-good pull-left">
                <span>商品</span>
            </div>
            <div class="cart-spec pull-left">
                <span>规格</span>
            </div>
            <div class="cart-price pull-left">
                <span>单价(元)</span>
            </div>
            <div class="cart-number pull-left">
                <span>数量</span>
            </div>
            <div class="cart-sum pull-left">
                <span>原价(元)</span>
            </div>
            <div class="cart-action pull-left">
                <span>操作</span>
            </div>
        </div>
        <div class="cart-order clearfix ">
            <ul class="list-unstyled html2">
				<li id="c_normal_19979" type="normal" pid="16729" ppid="19979">
				    <div class="cartbox clearfix">
				        <div class="cartorder-select pull-left clearfix">
                        <!--<p class="select selected"></p><input type="hidden" value="" />-->
					    </div>
				        <div class="cart-imgs pull-left">
						    <a href="/prodetail/index/16729" target="_blank">
                                <img src="https://imgqn8.fruitday.com/images/product_pic/16729/1/1-270x270-16729-1PAHHYKA.jpg" alt="">
						    </a>
    					</div>
					    <div class="cart-name pull-left">
						    <p><a href="/prodetail/index/16729" target="_blank">优选佳沛意大利金奇异果</a></p>
						</div>
					    <div class="spec-num pull-left">
					        <p>6个</p>					
                        </div>
    					<div class="price-singular pull-left">
    						<p>￥59.00</p>
    					</div>
						<div class="num_sel_lage cart-goods pull-left clearfix">
					        <span class="inC num pull-left btn-minus">-</span>
						    <input class="pull-left" type="tel" disabled="" name="qty" autocomplete="on" value="2">
						    <span class="deC num pull-left btn-plus">+</span>
					    </div>
						<div class="sum pull-left">
					        <p>￥118</p>
					   </div>
    					<div class="delete pull-left">
						    <p class="m-cartlist-delete deleteCartpro">删除</p>
					    </div>
    				</div>
				    <div class="cl"></div>
				</li>
			</ul>
			
            <div class="cl"></div>


            <input id="cart_page" type="hidden" value="2">
        </div>
        <!-- 尾部 -->
        <div class="cartfooter clearfix html3">
            <div class="cart-pay pull-right">
                <span>
                    已选择
                    <em>2件</em>
                    商品  |  订单金额
                </span>
                <span class="all-order">￥88.50</span>
                <a href="<?php echo mourl($CONN['userword'].$CONN['fenge'].'ding')?>" id="btngopay" class="go-pay">去结算</a>
            </div>
            <div class="cl"></div>
        </div>
    </div>

    <!-- 轮播开始-->
    <div class="cl"></div>
    <div class="look-history">
        <div class="scrollbar clearfix">
            <ul class="clearfix look-history-menu">
                <li class="looked pull-left"><p>你最近浏览过的商品</p></li>
                <li class="pull-left"><p class="p-noborder">你可能感兴趣的商品</p></li>
            </ul>
        </div>
        <div class="look-history-con">
            <div class="wrap">
                <div class="frame cartSlidee_0" style="overflow: hidden;">
                    <ul class="slidee clearfix ul1" style="transform: translateZ(0px); width: 184px;">
				        <li class="active">
    						<a href="/prodetail/index/16729" target="_blank">
                                <img src="https://imgws2.fruitday.com/images/product_pic/16729/1/1-270x270-16729-1PAHHYKA.jpg">
                                <p class="history-name">优选佳沛意大利金奇异果</p>
    							<p class="history-price">￥59.00 / 6个</p>
    						</a>
					    </li>
                    </ul>
                 </div>
                <div class="prev disabled"><div></div></div>
                <div class="next disabled"><div></div></div>
            </div>
            <div class="wrap" style="display:none;">
                <div class="frame cartSlidee_1">
                    <ul class="slidee clearfix ul1">
    					<li>
    						<a href="/prodetail/index/9443" target="_blank">
                                <img src="https://imgjd3.fruitday.com/images/product_pic/9443/1/1-270x270-9443-192ADKCK.jpg">
    							<p class="history-name">樱桃小番茄</p>
    							<p class="history-price">￥39.00 / 2+1斤</p>
    						</a>
					    </li>
                    </ul>
                </div>
                <div class="prev"><div></div></div>
                <div class="next"><div></div></div>
            </div>
        </div>
        <div class="cl"></div>
    </div>
</div>

<?php include QTPL.'foot.php';?>
