<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Url;

$this->title = $name;
?>
<div class="pageError bgShadow strong bg" style="background-image: url(img/404-bg.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="pageErroreTitle">
                    <div class="cell-view">
                        <h1 class="h1 as light">404</h1>
                        <p>Oops! That page can’t be found</p>
                        <span>Sorry, but the page you are looking for does not existing</span>
                        <div class="emptySpace50 emptySpace-xs30"></div>
                        <a href="<?= Url::toRoute('site/index') ?>" class="button btnSize2">Go to Home Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>