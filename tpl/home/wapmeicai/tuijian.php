<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php if(isset($DATA['name']))echo $DATA['name'],'-'; if( isset($PAGE) && $PAGE > '1' )echo $LANG['PAGE']['dqdi'].$PAGE.$LANG['PAGE']['ye'].'-';echo $CONN['title'];?></title>
    <meta name="description" content="<?php echo !isset($DATA['miaoshu']) || $DATA['miaoshu']==''?$CONN['miaoshu']:$DATA['miaoshu'];?>" /> 
    <meta name="keywords" content="<?php echo !isset($DATA['guanjian']) ||$DATA['guanjian']==''?$CONN['guanjian']:$DATA['guanjian'];?>" />
    <link href="<?php echo DQTPL;?>css/mui.css" rel="stylesheet"/>
    <script src="<?php echo DQTPL;?>js/mui.min.js"></script>
    </head>

    <body>

        <div class="headad">

            <img src="<?php echo pichttp( $DATA['tupian']);?>" style="width:100%;"/>

        </div>
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;">


        <?php 

            $DATAS =  neirlist(  array( 'cid'=> xjcid($LANG['cpid'] ,$D),'order'=>'id desc','limit'=>24) , 'center' , $D );

            if( $DATAS['date'] ){

            foreach( $DATAS['date'] as $ong ){

                if($ong['canshu'] !='') $ong['canshu'] = unserialize( $ong['canshu'] );
                else $ong['canshu'] =  array();

                $shuju = isset( $ong['canshu']['shuju'] ) ? reset( $ong['canshu']['shuju'] ) : array();
                $jiage = isset( $ong['canshu']['jiage'] ) ? (float)reset( $ong['canshu']['jiage'] ) : $ong['jiage'] ;
        ?>

            <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                        <a href="<?php echo $ong['link'];?>">
                            <img src="<?php echo pichttp($ong['tupian']);?>" style="width:100px;height:100px;" />
                            <div class="mui-media-body" style="margin:0px;font-size:12px;text-align:left;line-text-overflow:none;white-space:normal"><?php echo $ong['name'];?></div>
                                
                        </a>
            </li>

        <?php } } ?>


        </ul>


        <div class="mui-content">
			<div class="mui-content-padded" style="text-align:center;padding:30px;">

            <?php $danye = danye( $LANG['cpid'] );?>
				
				<p>
					<a class="js-to-list" href="<?php echo $danye['link'];?>" style="color:#ff711d;">去商场看看》</a>
				</p>
			</div>
		</div>




    </body>
</html>