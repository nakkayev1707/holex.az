<?php

use yii\helpers\Url;
$this->title = Yii::t('app', 'menu_offer');

?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url(<?=Yii::$app->params['siteUrl'] . '/img/publication_header.jpeg'?>)">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <h1 class="h1 light as"><?=substr($view['title'], 0, 200) ?></h1>
                        <div class="breadCrumbs small">
                            <a href="<?=Url::toRoute('site/') ?>"><?=Yii::t('app', 'menu_home') ?></a> <i class="fa fa-angle-right"></i>
                            <span><?=Yii::t('app', 'menu_offer') ?></span>
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
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="mainBlogContent">
                    <!-- 	Blog details-START 	-->
                    <div class="blogWrapper">
                        <div class="imgWrapper">
                            <img src="<?=Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/publications/".$view['image']; ?>" alt="" style="width: 70%">
                            <span class="timeBlock"><?=$view['image'] ? date('d-m-Y', strtotime($view['created_at'])) : ""?></span>
                        </div>
                        <div class="blogContent normall">
                            <h5 class="h5 as"><?=$view['title']?></h5>
                            <div class="simple-article">
                                <?= $view['full']?>
                            </div>
                        </div>
                    </div>
                    <!-- 	Blog details-END 	-->
                </div>
            </div>
        </div>
    </div>
</div>