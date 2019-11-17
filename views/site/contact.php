<?php

$this->title = Yii::t('app', 'menu_contact_me');

use yii\helpers\Url; ?>
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h2 class="h2 as"><?=Yii::t('app', 'menu_contact_me') ?></h2>
                    <p><?=Yii::t('app', 'contact_head_text') ?></p>
                </div>
                <div class="emptySpace50 emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6 col-md-8">
                <form action="<?=Yii::$app->request->url?>" method="POST" id=""  enctype="multipart/form-data" name="contactForm">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                    <input class="simple-input" id="name" name="name" type="text" value="" placeholder="<?=Yii::t('app', 'name') ?>">
                    <div class="emptySpace20"></div>
                    <input class="simple-input" id="email" name="email" type="email" value="" placeholder="<?=Yii::t('app', 'email') ?>" />
                    <div class="emptySpace20"></div>
                    <input class="simple-input" id="phone" name="phone" type="tel" value="" placeholder="<?=Yii::t('app', 'phone') ?>" />
                    <div class="emptySpace20"></div>
                    <input class="simple-input" id="subject" name="subject" type="text" value="" placeholder="<?=Yii::t('app', 'subject') ?>" />
                    <div class="emptySpace20"></div>
                    <textarea class="simple-input" id="message" name="message" placeholder="<?=Yii::t('app', 'message') ?>"></textarea>
                    <div class="emptySpace50 emptySpace-xs30"></div>
                    <button type="submit" class="button"><?=Yii::t('app', 'submit') ?></button>
                </form>
                <div class="emptySpace-xs30"></div>
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>
                    <div id="success">
                        <p>Your text message sent successfully!</p>
                    </div>
                <?php } else if (Yii::$app->session->hasFlash('contactFormNotSubmitted')) { ?>
                    <div id="error">
                        <p>Sorry! Message not sent. Something went wrong!!</p>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="contactDetails normall">
                    <!-- 	Contacts1-START 	-->
<!--                    <div class="contactAddres">-->
<!--                        <div class="imgWrapper">-->
<!--                            <img src="img/location-icon-white.png" alt="">-->
<!--                        </div>-->
<!--                        <div class="simple-article light">-->
<!--                            <p>Phychology, 562, Mallin StreetNew Youk,</p>-->
<!--                            <p> NY 100 254</p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- 	Contacts1-END 	-->

                    <!-- 	Contacts2-START 	-->
                    <div class="contactAddres">
                        <div class="imgWrapper">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <a href="mailto:info@myholex.az">info@myholex.az</a>
                    </div>
                    <!-- 	Contacts2-END 	-->

                    <!-- 	Contacts3-START 	-->
                    <div class="contactAddres large">
                        <div class="imgWrapper">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="tel:994123456789">+ 994 12 345 67 89</a>
                    </div>
                    <!-- 	Contacts3-END 	-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="emptySpace20"></div>
<!-- 	Map-START 	-->
<!--<div id="map-canvas" data-lat="34.0151244" data-lng="-118.4729871" data-zoom="15"></div>-->
<!--<div class="addresses-block">-->
<!--    <a class="marker" data-lat="34.0151244" data-lng="-118.4729871" data-string="1. Here is some address or email or phone or something else..."></a>-->
<!--</div>-->
<!-- 	Map-END 	-->