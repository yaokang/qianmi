<?php 
p($_GET);

?>
<form>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>收货人</label>
        <input type="text" class="inpText" maxlength="15" value="" id="name">
    </div>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>选择地区</label>
        <div class="inpSel">
            <input type="hidden" value="" id="provice">
            <span id="spsheng">省/直辖市</span>
            <ul id="issheng" class="list-unstyled">
                <?php foreach($shujus as $key => $val){?>
                <li data-id="<?php echo $key?>"><?php echo $val?></li>
                <?php }?>
            </ul>
        </div>

        <div class="inpSel">
            <input type="hidden" value="" id="city">
            <span id="spcity">市</span>
            <ul id="lscity" class="list-unstyled">
            </ul>
        </div>

        <div class="inpSel sel1 disabl">
            <input type="hidden" value="" id="area">
            <span id="sparea">区／县</span>
            <ul id="lsarea" class="list-unstyled">
            </ul>
        </div>
    </div>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>详细地址</label>
        <input type="text" class="inpText" value="" style="width:540px; *width:520px;" id="detailAddr">
    </div>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>手机号码</label>
        <input type="tel" class="inpText" value="" id="tel">
    </div>
    <div class="formitem clearfix">
        <input type="checkbox" id="def" class="inpCheck" onclick="" value="1"><label for="def" style="width:auto;">设为为默认收货地址</label>
    </div>
    <div class="formitem clearfix">
        <button type="button" class="btn btn-success" id="submit" onclick="shedit( 'post' );">保存收货人信息</button>
    </div>
</form>