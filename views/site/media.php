<?php

use yii\helpers\Url;
$this->title = Yii::t('app', 'menu_media')
?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url()">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <h1 class="h1 light as"><?=Yii::t('app', 'menu_media')?></h1>
                        <div class="breadCrumbs small">
                            <a href="<?=Url::to('site/')?>"><?=Yii::t('app', 'menu_home')?></a> <i class="fa fa-angle-right"></i> <span><?=Yii::t('app', 'menu_media') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	Top banner-END 	-->

<div class="contentPadding">
    <div class="container">
        <div class="galleryContainer clearFixGalley normall">
            <?php if (isset($media) && !empty($media)) {
                foreach ($media as $m) {
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $m['image'];
                    ?>
                    <div class="my-col-33">
                        <a href="<?=$imagePath?>" class="imgWrapper imgTumb lightbox">
                            <p class="simple-article light large"><?=substr($m['title'], 0, 100)?></p>
                            <img src="<?=$imagePath?>" alt="">
                        </a>
                        <div class="emptySpace10"></div>
                    </div>
                <?php }
            } else { ?>
                <div class="blogContent">
                    <h5 class="h5 as"><?=Yii::t('app', 'publication_not_found') ?></h5>
                </div>
            <?php } ?>
        </div>
    </div>
</div>