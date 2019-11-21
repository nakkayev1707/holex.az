<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::t('app', 'menu_about');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url()">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <h1 class="h1 light as"><?=Yii::t('app', 'menu_about') ?></h1>
                        <div class="breadCrumbs small">
                            <a href="<?=Url::toRoute('site/')?>"><?=Yii::t('app', 'menu_home') ?></a> <i class="fa fa-angle-right"></i> <span><?=Yii::t('app', 'menu_about') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	Top banner-END 	-->

<!-- 	About our-START 	-->
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="aboutOur">
                    <h2 class="h2 as"><?=$aboutInfo[0]['title']?></h2>
                    <?= $aboutInfo[0]['full']?>
                </div>
                <div class="emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="imgWrapper">
                            <img src="<?=Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/publications/". $aboutInfo[0]['image']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	About our-END 	-->

<!-- 	Persone banner-START 	-->
<div class="personeBg style2" style="background: rgba(95, 91, 92, 0.8)!important;">
    <div class="bg" style="background-image: url()">
        <div class="container">
            <div class="row">
                <div class="emptySpace-lg50"></div>
                <div class="imgWrapper personeImg">
                    <img src="<?=Yii::$app->params['siteUrl']. '/img/about/about_photo.jpg' ?>" alt="" style="width: 76.5%">
                </div>
                <div class="col-sm-6 col-sm-offset-6">
                    <div class="personeWrapper large">
                        <h2 class="h2 light as"><?=Yii::t('app', 'about_info_title')?></h2>
                        <p><?=Yii::t('app', 'about_info_subtitle') ?></p>
                        <div class="simple-article normall extraLight">
                            <p><?=Yii::t('app', 'about_info_paragraph1')?></p>
                            <p><?=Yii::t('app', 'about_info_paragraph2')?></p>
                        </div>
                        <div class="emptySpace30"></div>
                        <div class="imgWrapper">
<!--                            <img src="--><?//=Yii::$app->params['siteUrl']. '/img/autograph.png'?><!--" alt="">-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	Persone banner-END 	-->

<!-- 	Get appointment-START 	-->
<div class="appointWrapper" style="background: rgba(95, 91, 92, 0.8)!important;">
    <div class="container">
        <div class="row verAlign" >
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="btnAlign">
                    <a href="<?=Url::toRoute('site/contact') ?>" class="button btnStyle3"><?=Yii::t('app', 'get_appointment')?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	Get appointment-END 	-->