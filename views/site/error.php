<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Url;

$this->title = $name;
?>
<div class="pageError bgShadow strong bg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="pageErroreTitle">
                    <div class="cell-view">
                        <h1 class="h1 as light">404</h1>
                        <p><?=Yii::t('app', 'not_found_error') ?></p>
                        <div class="emptySpace50 emptySpace-xs30"></div>
                        <a href="<?= Url::toRoute('site/index') ?>" class="button btnSize3"><?= Yii::t('app', 'menu_home')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>