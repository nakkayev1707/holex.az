<?php

$this->title = Yii::t('app', 'menu_contact_me');

use yii\helpers\Url; ?>
<!-- 	Top banner-START 	-->
<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="contentPadding bg bgShadow"
     style="background-image: url(<?= Yii::$app->params['siteUrl'] . '/img/service/header_img.png' ?>); background-size: 100%; background-repeat: no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <!--                        <h1 class="h1 light as">-->
                        <? //=Yii::t('app', 'menu_contact_me')?><!--</h1>-->
                        <!--                        <div class="breadCrumbs small">-->
                        <!--                            <a  href="--><? //=Url::to('site/')?><!--">-->
                        <? //=Yii::t('app', 'menu_home')?><!--</a> <i class="fa fa-angle-right"></i> <span>-->
                        <? //=Yii::t('app', 'menu_contact_me') ?><!--</span>-->
                        <!--                        </div>-->
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
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h2 class="h2 as"><?= Yii::t('app', 'menu_contact_me') ?></h2>
                    <!--                    <p>--><? //=Yii::t('app', 'contact_head_text') ?><!--</p>-->
                </div>
                <div class="emptySpace50 emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6 col-md-8">
                <form action="<?= Yii::$app->request->url ?>" method="POST" class="contactForm"
                      enctype="multipart/form-data" name="contactForm">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                           value="<?= Yii::$app->request->csrfToken; ?>"/>
                    <label class="<?= $errors['name'][0] ? 'label-danger' : '' ?>"
                           style="color: white"><?= $errors['name'][0] ?></label>
                    <input class="simple-input <?= $errors['name'][0] ? 'invalid' : '' ?>" id="name" name="name"
                           type="text" value="" placeholder="<?= Yii::t('app', 'name') ?>">
                    <div class="emptySpace20"></div>
                    <label class="<?= $errors['email'][0] ? 'label-danger' : '' ?>"
                           style="color: white"><?= $errors['email'][0] ?></label>
                    <input class="simple-input <?= $errors['email'][0] ? 'invalid' : '' ?>" id="email" name="email"
                           type="email" value="" placeholder="<?= Yii::t('app', 'email') ?>"/>
                    <div class="emptySpace20"></div>
                    <label class="<?= $errors['whereHear'][0] ? 'label-danger' : '' ?>"
                           style="color: white"><?= $errors['whereHear'][0] ?></label>
                    <select name="whereHear" class="simple-input <?= $errors['whereHear'][0] ? 'label-danger' : '' ?>">
                        <option disabled selected="selected"><?= Yii::t('app', 'where_hear') ?></option>
                        <option value="<?= Yii::t('app', 'hear_from_soc_media') ?>"><?= Yii::t('app', 'hear_from_soc_media') ?></option>
                        <option value="<?= Yii::t('app', 'hear_from_search') ?>"><?= Yii::t('app', 'hear_from_search') ?></option>
                        <option value="<?= Yii::t('app', 'hear_from_friends') ?>"><?= Yii::t('app', 'hear_from_friends') ?></option>
                        <option value="<?= Yii::t('app', 'hear_from_others') ?>"><?= Yii::t('app', 'hear_from_others') ?></option>
                    </select>
                    <div class="emptySpace20"></div>
                    <input class="simple-input" id="phone" name="phone" type="tel" value=""
                           placeholder="<?= Yii::t('app', 'phone') ?>"/>
                    <div class="emptySpace20"></div>
                    <!--                    <label class="-->
                    <? //=$errors['subject'][0] ? 'label-danger' : '' ?><!--" style="color: white">-->
                    <? //=$errors['subject'][0]?><!--</label>-->
                    <!--                    <input class="simple-input -->
                    <? //=$errors['subject'][0] ? 'invalid' : '' ?><!--" id="subject" name="subject" type="text" value="" placeholder="-->
                    <? //=Yii::t('app', 'subject') ?><!--" />-->
                    <label class="<?= $errors['subject'][0] ? 'label-danger' : '' ?>"
                           style="color: white"><?= $errors['subject'][0] ?></label>
                    <select name="subject" class="simple-input <?= $errors['subject'][0] ? 'label-danger' : '' ?>">
                        <option disabled selected="selected"><?= Yii::t('app', 'subject') ?></option>
                        <option value="<?= Yii::t('app', 'subj_gestalt_therapy') ?>"><?= Yii::t('app', 'subj_gestalt_therapy') ?></option>
                        <option value="<?= Yii::t('app', 'subj_rpt') ?>"><?= Yii::t('app', 'subj_rpt') ?></option>
                        <option value="<?= Yii::t('app', 'subj_life_cleaning') ?>"><?= Yii::t('app', 'subj_life_cleaning') ?></option>
                        <option value="<?= Yii::t('app', 'subj_for_company') ?>"><?= Yii::t('app', 'subj_for_company') ?></option>
                        <option value="<?= Yii::t('app', 'subj_gift_card') ?>"><?= Yii::t('app', 'subj_gift_card') ?></option>
                        <option value="<?= Yii::t('app', 'subj_eco_bag') ?>"><?= Yii::t('app', 'subj_eco_bag') ?></option>
                    </select>

                    <div class="emptySpace20"></div>
                    <label class="<?= $errors['message'][0] ? 'label-danger' : '' ?>"
                           style="color: white"><?= $errors['message'][0] ?></label>
                    <textarea class="simple-input <?= $errors['message'][0] ? 'invalid' : '' ?>" maxlength="4000"
                              id="message" name="message" placeholder="<?= Yii::t('app', 'message') ?>"></textarea>
                    <div class="g-recaptcha" id="rcaptcha" style="margin-top: 20px" data-sitekey="<?=Yii::$app->params['captcha_site_key']?>"></div>
                    <div class="emptySpace50 emptySpace-xs30"></div>

                    <button type="submit" class="button"><?= Yii::t('app', 'submit') ?></button>
                </form>
                <div class="emptySpace-xs30"></div>
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>
                    <div id="success">
                        <p class="text-success"
                           style="font-size: 16px"><?= Yii::t('app', 'contact_submit_success') ?></p>
                    </div>
                <?php } else if (Yii::$app->session->hasFlash('contactFormNotSubmitted')) { ?>
                    <div id="error">
                        <p class="text-danger" style="font-size: 16px"><?= Yii::t('app', 'contact_submit_error') ?></p>
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
                        <a href="mailto:<?= Yii::$app->params['companyEmail'] ?>"><?= Yii::$app->params['companyEmail'] ?></a>
                    </div>
                    <!-- 	Contacts2-END 	-->

                    <!-- 	Contacts3-START 	-->
                    <div class="contactAddres large">
                        <div class="imgWrapper">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="tel:994507979600"><?= Yii::$app->params['companyPhone'] ?></a>
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