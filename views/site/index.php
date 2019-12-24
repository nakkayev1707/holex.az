<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::t('app', 'menu_home');

?>
<!-- 	Main banner swiper-START 	-->
<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="swiperMainWrapper mainSwiperbanner">
    <?php if (isset($aphorisms) && !empty($aphorisms)) { ?>
        <!-- 	Swiper slider buttons-START 	-->
        <div class="swipert-black-button swiper-button-prev"></div>
        <div class="swipert-black-button swiper-button-next"></div>
        <!-- 	Swiper slider buttons-END 	-->
        <div class="swiper-container" data-auto-height="1" data-effect="fadde" data-speed="600" data-autoplay="5000"
             data-loop="1">
            <div class="swiper-wrapper">
                <?php foreach ($aphorisms as $aphorism) {
                    $langPrefix = Yii::$app->language == 'en' ? "en/" : "";
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $langPrefix . $aphorism['image'];
                    ?>
                    <div class="swiper-slide mainBanner">
                        <div class="sliderBg" style="background-image: url('<?= $imagePath ?>')"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <div class="cell-view">
                                        <div class="bannerTitle">
                                            <h3 class="h1 light as">
                                                <!--                                                --><? //= $aphorism['title'] ?>
                                            </h3>
                                            <!--                                            <p>-->
                                            <? //= $aphorism['full'] ?><!--</p>-->
                                        </div>
                                        <div class="bannerBtnWrapper">
                                            <a style="visibility: hidden" href="<?= Url::toRoute('service/') ?>"
                                               class="button btnSize1"><?= Yii::t('app', 'view_all_services') ?></a>
                                            <a style="visibility: hidden" href="<?= Url::toRoute('site/contact') ?>"
                                               class="button btnStyle3 btnSize1"><?= Yii::t('app', 'get_appointment') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<!-- 	Main banner swiper-END 	-->

<!--  	Offer Servicres-START 	-->
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h2 class="h2 as"><span><?= Yii::t('app', 'our_services') ?></span></h2>
                    <p></p>
                </div>
                <div class="emptySpace50 emptySpace-xs30"></div>
            </div>
        </div>
        <div class="row clearFix">
            <?php if (isset($sixService)) {
                foreach ($sixService as $service) {
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/services/" . $service['image'];
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="tumbWrapper">
                            <a href="<?= Yii::$app->params['siteUrl'] ?>/service/<?= $service['id'] ?>"
                               class="imgWrapper imgTumb bgShadow light" style="height: 286px">
                                <img src="<?= $imagePath ?>" alt="">
                            </a>
                            <h6 class="h6 as"><a
                                        href="<?= Yii::$app->params['siteUrl'] ?>/service/<?= $service['id'] ?>"><?= $service['title'] ?></a>
                            </h6>
                            <div class="tumbContent small">
                                <p><?= mb_substr($service['full'], 0, 200, 'UTF-8') . (strlen($service['full']) > 200 ? "..." : "") ?></p>
                            </div>
                        </div>
                        <div class="emptySpace-sm30"></div>
                    </div>
                <?php }
            } ?>

            <!-- 	Button-START 	-->
            <div class="col-xs-12">
                <div class="btnWrapper">
                    <div class="emptySpace50 emptySpace-xs20"></div>
                    <a href="<?= Url::toRoute('service/') ?>"
                       class="button"><?= Yii::t('app', 'view_all_services') ?></a>
                </div>
            </div>
            <!-- 	Button-END 	-->
        </div>
    </div>
</div>
<!--  	Offer Services-END 	-->

<!-- 	Corporate-Offers-START 	-->
<div class="contentPadding" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h3 class="h3 as"><?= Yii::t('app', 'business_offers') ?></h3>
                </div>
            </div>
            <?php if (isset($offers) && !empty($offers)) {
                foreach ($offers as $offer) {
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $offer['image'];
                    ?>
                    <div class="col-xs-12 col-sm-4">
                        <div class="tumbWrapper style2">
                            <div class="imgWrapper">
                                <img src="<?= $imagePath ?>" alt="">
                                <div class="timeBlock"><?= date('Y-m-d', strtotime($offer['created_at'])) ?></div>
                            </div>
                            <h6 class="h6 as"><a
                                        href="<?= Yii::$app->params['siteUrl'] ?>/offer/<?= $offer['id'] ?>"><?= $offer['title'] ?></a>
                            </h6>
                            <div class="tumbContent small">
                                <p><?= substr($offer['full'], 0, 150) . (strlen($offer['full']) > 150 ? "..." : "") ?></p>
                            </div>
                            <a class="readMore"
                               href="<?= Yii::$app->params['siteUrl'] ?>/offer/<?= $offer['id'] ?>"><?= Yii::t('app', 'read_more') ?></a>
                        </div>
                        <div class="emptySpace-xs30"></div>
                    </div>
                <?php }
            } else ?>
        </div>
    </div>
</div>
<!-- Corporate offers-END 	-->

<!-- 	Persone banner-START 	-->
<div class="personeBg" style="background: rgba(95, 91, 92, 0.8)!important;">
    <div class="bg" style="background-image: url()">
        <div class="container">
            <div class="row verAlignResponsive">
                <div class="imgWrapper personeImg">
                    <img src="<?= Yii::$app->params['siteUrl'] . '/img/about/about_photo.jpg' ?>" alt=""
                         style="width: 74.3%">
                </div>
                <div class="col-sm-6 col-sm-offset-6">
                    <div class="personeWrapper large">
                        <h2 class="h2 light as"><?= Yii::t('app', 'about_info_title') ?></h2>
                        <p><?= Yii::t('app', 'about_info_subtitle') ?></p>
                        <div class="simple-article normall extraLight">
                            <p><?= Yii::t('app', 'about_info_paragraph1') ?></p>
                        </div>
                        <div class="emptySpace25"></div>
                        <div class="personePhone">
                            <div class="imgWrapper">
                                <i class="flaticon3-telephone-auricular-with-cable"></i>
                            </div>
                            <div class="personePhoneContent">
                                <a href="tel:994507979600"><?= Yii::$app->params['companyPhone'] ?></a>
                                <span><?= Yii::t('app', 'call_us') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 	Persone banner-END 	-->

<!-- 	About us-START 	-->
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="aboutUs">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="titleShortocode">
                                <h3 class="h3 as"><?= Yii::t('app', 'menu_about') ?></h3>
                            </div>
                            <div class="emptySpace40 emptySpace-xs30"></div>
                        </div>
                    </div>
                    <!--                    <div class="row">-->
                    <!--                        <div class="col-xs-12 col-sm-6">-->
                    <!--                            <div class="imgWrapper">-->
                    <!--                                <img src="-->
                    <? //=Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/publications/". $aboutInfo[0]['image']; ?><!--" alt="">-->
                    <!--                            </div>-->
                    <!--                            <div class="emptySpace35"></div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <p style="font-style: normal">--><? //=$aboutInfo[0]['title']?><!--</p>-->
                    <div class="simple-article normall">
                        <span><?= substr($aboutInfo[0]['full'], 0, 962) ?></span>
                        <a class="readMore"
                           href="<?= Url::toRoute('site/about') ?>"><?= Yii::t('app', 'read_more') ?></a>
                    </div>
                    <div class="emptySpace30"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="simple-article normall">
                                <ul>
                                    <?php if (isset($sixService) && !empty($sixService)) {
                                        $firstThreeService = array_chunk($sixService, 3, false)[0];
                                        if (!empty($firstThreeService)) {
                                            foreach ($firstThreeService as $service) {
                                                ?>
                                                <li><?= $service['title'] ?></li>
                                            <?php }
                                        }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="simple-article normall">
                                <ul>
                                    <?php if (isset($sixService) && !empty($sixService)) {
                                        $secondThreeService = array_chunk($sixService, 3, false)[1];
                                        if (!empty($secondThreeService)) {
                                            foreach ($secondThreeService as $service) {
                                                ?>
                                                <li><?= $service['title'] ?></li>
                                            <?php }
                                        }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="emptySpace-xs30"></div>
            </div>
            <!--            <div class="col-sm-6">-->
            <!--                <div class="titleShortocode">-->
            <!--                    <h3 class="h3 as">--><? //=Yii::t('app', 'general_questions') ?><!--</h3>-->
            <!--                </div>-->
            <!--                <div class="emptySpace40 emptySpace-xs30"></div>-->
            <!-- 	Accordeon-START 	-->
            <!--                <div class="accordeon normall">-->
            <!--                    <div class="accordeon-title active">-->
            <!--                        <div class="accrodeonButton"><span></span><span></span></div>-->
            <!--                        How do I sign up for counseling?-->
            <!--                    </div>-->
            <!--                    <div class="accordeon-toggle" style="display: block;">-->
            <!--                        <div class="simple-article">-->
            <!--                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis et perspiciatis unde omnis iste natus error sit voluptatem</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="emptySpace20"></div>-->
            <!--                    <div class="accordeon-title">-->
            <!--                        <div class="accrodeonButton"><span></span><span></span></div>-->
            <!--                        How can therapy help?-->
            <!--                    </div>-->
            <!--                    <div class="accordeon-toggle">-->
            <!--                        <div class="simple-article">-->
            <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit placerat id. Nulla ultricies augue at felis elementum, sodales rhoncus metus sagittis.</p>-->
            <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="emptySpace20"></div>-->
            <!--                    <div class="accordeon-title">-->
            <!--                        <div class="accrodeonButton"><span></span><span></span></div>-->
            <!--                        How much do the counseling sessions cost?-->
            <!--                    </div>-->
            <!--                    <div class="accordeon-toggle">-->
            <!--                        <div class="simple-article">-->
            <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit placerat id. Nulla ultricies augue at felis elementum, sodales rhoncus metus sagittis.</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="emptySpace20"></div>-->
            <!--                    <div class="accordeon-title">-->
            <!--                        <div class="accrodeonButton"><span></span><span></span></div>-->
            <!--                        Does the Counseling Center offer counseling?-->
            <!--                    </div>-->
            <!--                    <div class="accordeon-toggle">-->
            <!--                        <div class="simple-article">-->
            <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit placerat id. Nulla ultricies augue at felis elementum, sodales rhoncus metus sagittis.</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!-- 	Accordeon-END 	-->
            <!--            </div>-->
        </div>
    </div>
</div>
<!-- 	About us-END 	-->

<!-- 	Banner-START STATIC INFORMATION -->
<!--<div class="contentPadding bg simpleBanner bgShadow strong" style="background-image: url(img/banner-img.jpg)">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-xs-12 col-md-10 col-lg-9">-->
<!--                <div class="cell-view">-->
<!--                    <div class="titleShortocode big">-->
<!--                        <h2 class="h2 as light">The Best thing In Pshylogloy Treatment</h2>-->
<!--                        <div class="simple-article light">-->
<!--                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusanti um dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis et perspiciatis unde omnis iste natus.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- 	Banner-END-->
<?php if (isset($ecoBags) && !empty($ecoBags)) { ?>
    <div class="contentPadding grey">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="titleShortocode">
                        <h3 class="h3 as"><?= Yii::t('app', 'eco_bags') ?></h3>
                        <div class="emptySpace30"></div>
                        <div class="simple-article normall">
                            <p><?= Yii::t('app', 'eco_bags_title') ?></p>
                        </div>
                    </div>
                    <div class="emptySpace-lg30"></div>
                </div>
                <div class="swiperMainWrapper ourTeamSlider">
                    <div class="swipert-black-button swiper-button-prev"></div>
                    <div class="swipert-black-button swiper-button-next"></div>
                    <div class="swiper-container" data-breakpoints="1" data-xs-slides="1" data-sm-slides="2"
                         data-md-slides="4" data-slides-per-view="4" data-space="30">
                        <div class="swiper-wrapper">
                            <?php if (isset($ecoBags) && !empty($ecoBags)) {
                                foreach ($ecoBags as $bag) {
                                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $bag['image'];
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="tumbWrapper persone">
                                            <a href="<?= Url::toRoute('site/contact') ?>" class="imgWrapper imgTumb ">
                                                <img src="<?= $imagePath ?>" alt="">
                                            </a>
                                            <div class="blockContent normall">
                                                <a href="<?= Url::toRoute('site/contact') ?>"><?= $bag['title'] ?></a>
                                            </div>
                                            <div class="simple-article normall">
                                                <p><?= substr($bag['full'], 0, 200) . (strlen($bag['full']) > 150 ? "..." : "") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Gift card start -->
<div class="contentPadding" style="padding-top: 20px; padding-bottom: 20px">
    <div class="container">
        <div class="row">
            <?php if (isset($giftCards) && !empty($giftCards)) { ?>
                <div class="col-xs-12">
                    <div class="contentTitle normall">
                        <h3 class="h3 as"><?= Yii::t('app', 'gift_card') ?></h3>
                    </div>
                </div>
                <?php foreach ($giftCards as $card) {
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $card['image'];
                    ?>
                    <div class="col-xs-12 col-sm-4">
                        <div class="tumbWrapper style2">
                            <div class="imgWrapper">
                                <img src="<?= $imagePath ?>" alt="">
                            </div>
                            <h6 class="h6 as"><a
                                        href="<?= Url::toRoute('site/contact') ?>"><?= $card['title'] ?></a>
                            </h6>
                            <div class="tumbContent small">
                                <p><?= substr($card['full'], 0, 1000) . (strlen($card['full']) > 1000 ? "..." : "") ?></p>
                            </div>
                        </div>
                        <div class="emptySpace-xs30"></div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>
<!-- Gift card end -->


<!-- 	Last news-START 	-->
<?php if (isset($news) && !empty($news)) { ?>
    <div class="contentPadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="contentTitle normall">
                        <h3 class="h3 as"><?= Yii::t('app', 'latest_news') ?></h3>
                    </div>
                </div>
                <?php foreach ($news as $n) {
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $n['image'];
                    ?>
                    <div class="col-xs-12 col-sm-4">
                        <div class="tumbWrapper style2">
                            <div class="imgWrapper">
                                <img src="<?= $imagePath ?>" alt="">
                                <div class="timeBlock"><?= date('Y-m-d', strtotime($n['created_at'])) ?></div>
                            </div>
                            <h6 class="h6 as"><a
                                        href="<?= Yii::$app->params['siteUrl'] ?>/news/<?= $n['id'] ?>"><?= $n['title'] ?></a>
                            </h6>
                            <div class="tumbContent small">
                                <p><?= substr($n['full'], 0, 150) . (strlen($n['full']) > 150 ? "..." : "") ?></p>
                            </div>
                            <a class="readMore"
                               href="<?= Yii::$app->params['siteUrl'] ?>/news/<?= $n['id'] ?>"><?= Yii::t('app', 'read_more') ?></a>
                        </div>
                        <div class="emptySpace-xs30"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- 	Last news-END 	-->

<!-- 	Request-START 	-->
<div class="contentPadding grey colorBlack">
    <div class="contactBg bgShadow style2"
         style="background-image: url(<?= Yii::$app->params['siteUrl'] . '/img/bg.jpg' ?>)"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6 col-sm-offset-2">
                <form class="requestForm contactForm" action="<?= Url::toRoute('site/') ?>" method="post">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                           value="<?= Yii::$app->request->csrfToken; ?>"/>
                    <div class="contentTitle">
                        <h3 class="h3 as"><span><?= Yii::t('app', 'consultation') ?></span></h3>
                    </div>
                    <div class="emptySpace15"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input <?= $errors['name'][0] ? 'invalid' : '' ?>" name="name"
                                   type="text" value="" placeholder="<?= Yii::t('app', 'name') ?>"/>
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input <?= $errors['email'][0] ? 'invalid' : '' ?>" name="email"
                                   type="email" value="" placeholder="<?= Yii::t('app', 'email') ?>"/>
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input class="simple-input <?= $errors['phone'][0] ? 'invalid' : '' ?>" name="phone"
                                   type="tel" value="" placeholder="<?= Yii::t('app', 'phone') ?>"/>
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input class="simple-input <?= $errors['subject'][0] ? 'invalid' : '' ?>" name="subject"
                                   type="text" value="" placeholder="<?= Yii::t('app', 'subject') ?>"/>
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12">
                            <textarea class="simple-input <?= $errors['message'][0] ? 'invalid' : '' ?>" name="message"
                                      maxlength="3000" placeholder="<?= Yii::t('app', 'message') ?>"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <div class="g-recaptcha" id="rcaptcha" style="margin-top: 20px" data-sitekey="<?=Yii::$app->params['captcha_site_key']?>"></div>
                        </div>
                    </div>
                    <div class="emptySpace30"></div>
                    <div class="btnWrapper">
                        <button type="submit" class="button"><?= Yii::t('app', 'submit') ?></button>
                    </div>
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>
                        <div id="success">
                            <p class="text-success"
                               style="font-size: 16px"><?= Yii::t('app', 'contact_submit_success') ?></p>
                        </div>
                    <?php } else if (Yii::$app->session->hasFlash('contactFormNotSubmitted')) { ?>
                        <div id="error">
                            <p class="text-danger"
                               style="font-size: 16px"><?= Yii::t('app', 'contact_submit_error') ?></p>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 	Request-END 	-->







