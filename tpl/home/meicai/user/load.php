<?php 
$ID = $_GET['id'];
$D -> setbiao ( 'shouhuo' );
$DATA = $D ->where( array( 'id' => $ID ))->find();
$D->setbiao('chengshi');
$xian = $D->where(array('diqu'=> $DATA['diqu']))->find();
$shi = $D->where(array('diqu'=> $xian['shangji']))->find();
$sheng = $D->where(array('diqu'=> $shi['shangji']))->find();
$shuju = chengshiid( $DATA['diqu']);

$html ='';

for($i = 0;$i< count($shuju) ; $i++){
    $shujus = chengshi($shuju[$i]);
    if($shuju[$i] > 0 )unset($shujus['0']); 

    $html.=' <select id="shisso'.$i.'" onchange="shiji'.$i.'(this.value)" class="mui-btn mui-btn-block">';
           
      foreach($shujus as $k =>$v){

          $xb = $i+1;

          if( (isset($shuju[$xb]) && $k == $shuju[$xb] ) || $k ==  $DATA['diqu'])
               $html.='<option value="'.$k.'" selected="selected">'.$v.' </option>';
          else
               $html.='<option value="'.$k.'">'.$v.' </option>';
      }

    $html.='</select>';
}

?>

<form>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>收货人</label>
        <input type="text" class="inpText" maxlength="15" value="<?php echo $DATA['xingming']?>" id="name1">
    </div>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>选择地区</label>
        <?php
            for($i = 0;$i< count($shuju) ; $i++){ 
                $shujus = chengshi($shuju[$i]);
                if($shuju[$i]>0)unset($shujus['0']);
        ?>
        <div class="inpSel">
            <?php if($i == 0){?>
            <input type="hidden" value="<?php echo $sheng['diqu']?>" id="provice1">
            <?php }else if($i == 1){?>
            <input type="hidden" value="<?php echo $shi['diqu']?>" id="city1">
            <?php }else{?>
            <input type="hidden" value="<?php echo $xian['diqu']?>" id="area1">
            <?php }?>
            <?php if($i == 0){?>
            <span id="spsheng1"><?php echo $sheng['name']?></span>
            <?php }else if($i == 1){?>
            <span id="spcity1"><?php echo $shi['name']?></span>
            <?php }else{?>
            <span id="sparea1"><?php echo $xian['name']?></span>
            <?php }?>
            <?php if($i == 0){?>
            <ul id="issheng1" class="list-unstyled">
            <?php }else if($i == 1){?>
            <ul id="lscity1" class="list-unstyled">
            <?php }else{?>
            <ul id="lsarea1" class="list-unstyled">
            <?php }?>
                <?php foreach($shujus as $k => $v){?>
                <li data-id="<?php echo $k?>"><?php echo $v?></li>
                <?php }?>
            </ul>
        </div>
        <?php }?>

    </div>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>详细地址</label>
        <input type="text" class="inpText" value="<?php echo $DATA['dizhi']?>" style="width:540px; *width:520px;" id="detailAddr1">
    </div>
    <div class="formitem clearfix">
        <label><span class="VI-color1">*</span>手机号码</label>
        <input type="tel" class="inpText" value="<?php echo $DATA['shouji']?>" id="tel1">
    </div>
    <div class="formitem clearfix">
        <input type="checkbox" id="def" class="inpCheck1" onclick="" value="1" <?php if($DATA['off'] == 1)echo 'checked'?>><label for="def" style="width:auto;">设为为默认收货地址</label>
    </div>
    <div class="formitem clearfix">
        <button type="button" class="btn btn-success" id="submit" onclick="shedit( 'put',<?php echo $ID?> );">保存收货人信息</button>
    </div>
</form>
