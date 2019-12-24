<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'menu_services');

?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url(<?=Yii::$app->params['siteUrl'] . '/img/service/header_img.png'?>); background-size: 100%;background-repeat: no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
<!--                        <h1 class="h1 light as">--><?//=Yii::t('app', 'menu_services') ?><!--</h1>-->
<!--                        <div class="breadCrumbs small">-->
<!--                            <a href="--><?//=Url::toRoute('site/') ?><!--">--><?//=Yii::t('app', 'menu_home') ?><!--</a> <i class="fa fa-angle-right"></i> <span>--><?//=Yii::t('app', 'menu_services') ?><!--</span>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	Top banner-END 	-->

<!-- 	Services-START 	-->
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h2 class="h2 as"><?=Yii::t('app', 'our_services') ?></h2>
<!--                    <p>Lorem Ipsum is simply text of the Lorem Ipsum is  simply my text of the printing and Ipsum is simply text of the Ipsum is simply text of thetypesetting Ipsum is simply text of the stry simply dummy text of the printing and typesetting industry.</p>-->
                </div>
                <div class="emptySpace50 emptySpace-xs30"></div>
            </div>
        </div>
        <div class="row clearFix big">
            <?php if (isset($services) && !empty($services)) {
                foreach ($services as $service) {
                    $imagePath = Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/services/".$service['image'];
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="tumbWrapper">
                            <a style="height: 286px" href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/service/<?= $service['id'] ?>" class="imgWrapper imgTumb bgShadow light">
                                <img src="<?=$imagePath?>" alt="">
                            </a>
                            <h6 class="h6 as"><a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/service/<?= $service['id'] ?>"><?=$service['title']?></a></h6>
                            <div class="tumbContent small">
                                <p><?=mb_substr($service['full'], 0, 150, 'UTF-8') . (strlen($service['full']) > 150 ? "..." : "")?></p>
                            </div>
                        </div>
                        <div class="emptySpace90 emptySpace-md30"></div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>
<!-- 	Services-END 	-->

<!-- 	Request-START 	-->
<div class="contentPadding grey colorBlack">
    <div class="contactBg bgShadow" style="background-image: url(<?=Yii::$app->params['siteUrl'] . '/img/service/bg1.jpg' ?>)"></div>
    <div class="container">
        <div class="row ">
            <div class="col-sm-6 col-sm-offset-6">
                <form class="requestForm contactForm" action="<?=Url::toRoute('service/contact')?>" method="post">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                    <div class="contentTitle">
                        <h3 class="h3 as"><span><?=Yii::t('app', 'consultation') ?></span></h3>
                    </div>
                    <div class="emptySpace15"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input <?=$errors['name'][0] ? 'invalid' : '' ?>" name="name" type="text" value=""  placeholder="<?=Yii::t('app', 'name') ?>" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input <?=$errors['email'][0] ? 'invalid' : '' ?>" name="email" type="email" value="" placeholder="<?=Yii::t('app', 'email') ?>" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input class="simple-input <?=$errors['phone'][0] ? 'invalid' : '' ?>" name="phone" type="tel" value="" placeholder="<?=Yii::t('app', 'phone') ?>" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input class="simple-input <?=$errors['subject'][0] ? 'invalid' : '' ?>" name="subject" type="text" value="" placeholder="<?=Yii::t('app', 'subject') ?>" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12">
                            <textarea class="simple-input <?=$errors['message'][0] ? 'invalid' : '' ?>" name="message" maxlength="3000" placeholder="<?=Yii::t('app', 'message') ?>"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <div class="g-recaptcha" id="rcaptcha" style="margin-top: 20px" data-sitekey="<?=Yii::$app->params['captcha_site_key']?>"></div>
                        </div>
                    </div>
                    <div class="emptySpace30"></div>
                    <div class="btnWrapper">
                        <button type="submit" class="button"><?=Yii::t('app', 'submit')?></button>
                    </div>
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>
                        <div id="success">
                            <p class="text-success" style="font-size: 16px"><?=Yii::t('app', 'contact_submit_success') ?></p>
                        </div>
                    <?php } else if (Yii::$app->session->hasFlash('contactFormNotSubmitted')) { ?>
                        <div id="error">
                            <p class="text-danger" style="font-size: 16px"><?=Yii::t('app', 'contact_submit_error') ?></p>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 	Request-END 	-->