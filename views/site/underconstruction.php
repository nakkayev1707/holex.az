<?php

use yii\helpers\Url;

?>
<div id="content-block">
    <div class="contentPadding bg bgShadow strong commingWrapper"
         style="background-image: url(img/comming-soon-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="cell-view">
                        <div class="commingTitle">
                            <h1 class="h1 as light"><?=Yii::t('app', 'coming_soon') ?></h1>
                        </div>
                        <div class="timerWrapper">
                            <div class="timerBlock">
                                <div class="timer days"></div>
                                <span><?=Yii::t('app', 'days') ?></span>
                            </div>
                            <div class="timerBlock">
                                <div class="timer hours"></div>
                                <span><?=Yii::t('app', 'hours') ?></span>
                            </div>
                            <div class="timerBlock">
                                <div class="timer minutes"></div>
                                <span><?=Yii::t('app', 'minutes') ?></span>
                            </div>
                            <div class="timerBlock">
                                <div class="timer seconds"></div>
                                <span><?=Yii::t('app', 'seconds') ?></span>
                            </div>
                        </div>
                        <div class="commingDescription">
<!--                            <div class="simple-article light">-->
<!--                                <p>--><?//=Yii::t('app', 'coming_soon_text') ?><!--</p>-->
<!--                            </div>-->
                            <div class="emptySpace30"></div>
                            <a type="button" href="<?=Url::toRoute('site/index')?>" class="button"><?=Yii::t('app', 'go_home') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
