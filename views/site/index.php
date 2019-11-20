<?php

/* @var $this yii\web\View */

$this->title = 'myholex.az';

use yii\helpers\Url; ?>
<!-- 	Main banner swiper-START 	-->
<div class="swiperMainWrapper mainSwiperbanner">
    <!-- 	Swiper slider buttons-START 	-->
    <div class="swipert-black-button swiper-button-prev"></div>
    <div class="swipert-black-button swiper-button-next"></div>
    <!-- 	Swiper slider buttons-END 	-->
    <div class="swiper-container" data-auto-height="1" data-effect="fadde" data-speed="600" data-autoplay="5000" data-loop="1">
        <div class="swiper-wrapper">
            <?php if (isset($aphorisms)) {
                foreach ($aphorisms as $aphorism) {
                    $imagePath = Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/publications/".$aphorism['image'];
                    ?>
                    <div class="swiper-slide mainBanner bgShadow">
                        <div class="sliderBg" style="background-image: url('<?=$imagePath ?>')"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <div class="cell-view">
                                        <div class="bannerTitle">
                                            <h3 class="h1 light as">
                                                <?= $aphorism['title'] ?>
                                            </h3>
                                            <p><?= $aphorism['full']?></p>
                                        </div>
                                        <div class="bannerBtnWrapper">
                                            <a href="<?= Url::toRoute('service/') ?>" class="button btnSize1"><?= Yii::t('app', 'view_all_services')?></a>
                                            <a href="<?= Url::toRoute('site/contact') ?>"
                                               class="button btnStyle3 btnSize1"><?=Yii::t('app', 'get_appointment') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>
<!-- 	Main banner swiper-END 	-->

<!--  	Offer Servicres-START 	-->
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h2 class="h2 as">We Offer Services In <span>Our Clinic</span></h2>
                    <p>Lorem Ipsum is simply text of the Lorem Ipsum is  simply my text of the printing and Ipsum is simply text of the Ipsum is simply text of thetypesetting Ipsum is simply text of the stry simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="emptySpace50 emptySpace-xs30"></div>
            </div>
        </div>
        <div class="row clearFix">
            <?php if (isset($services)) {
                foreach ($services as $service) {
                    $imagePath = Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/services/".$service['image'];
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="tumbWrapper">
                            <a href="<?=Yii::$app->params['siteUrl'] ?>/service/<?=$service['id']?>" class="imgWrapper imgTumb bgShadow light">
                                <img src="<?=$imagePath?>" alt="">
                            </a>
                            <h6 class="h6 as"><a href="<?= Yii::$app->params['siteUrl'] ?>/service/<?=$service['id']?>"><?=$service['title'] ?></a></h6>
                            <div class="tumbContent small">
                                <p><?=$service['full']?></p>
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
                    <a href="<?=Url::toRoute('service/') ?>" class="button"><?=Yii::t('app', 'view_all_services') ?></a>
                </div>
            </div>
            <!-- 	Button-END 	-->
        </div>
    </div>
</div>
<!--  	Offer Servicres-END 	-->

<!-- 	Persone banner-START 	-->
<div class="personeBg" style="background: rgba(95, 91, 92, 0.8)!important;">
    <div class="bg" style="background-image: url()">
        <div class="container">
            <div class="row verAlignResponsive">
                <div class="imgWrapper personeImg">
                    <img src="<?=Yii::$app->params['siteUrl']. '/img/about/about_photo.jpg' ?>" alt="" style="width: 67.2%">
                </div>
                <div class="col-sm-6 col-sm-offset-6">
                    <div class="personeWrapper large">
                        <h2 class="h2 light as">Hello, I’m Doctor Roberts</h2>
                        <p>Expert Clinical Psychologist in Manhattan</p>
                        <div class="simple-article normall extraLight">
                            <p>Lorem Ipsum is simply text of the Lorem Ipsum is  simply my text of the printing and Ipsum is simply text of the Ipsum is simply text of thetypesetting Ipsum is simply text of the stry simply dummy text of the printing and typesetting industry.  Lorem Ipsum is simply text of the Lorem Ipsum is  simply my text of </p>
                        </div>
                        <div class="emptySpace25"></div>
                        <div class="personePhone">
                            <div class="imgWrapper">
                                <i class="flaticon3-telephone-auricular-with-cable"></i>
                            </div>
                            <div class="personePhoneContent">
                                <a href="tel:994507979600">+994 50 797 96 00</a>
                                <span><?=Yii::t('app', 'call_us')?></span>
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
            <div class="col-sm-6">
                <div class="aboutUs">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="titleShortocode">
                                <h3 class="h3 as"><?=Yii::t('app', 'menu_about') ?></h3>
                            </div>
                            <div class="emptySpace40 emptySpace-xs30"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="imgWrapper">
                                <img src="img/about-us-img.jpg" alt="">
                            </div>
                            <div class="emptySpace35"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="imgWrapper">
                                <img src="img/about-us-img2.jpg" alt="">
                            </div>
                            <div class="emptySpace35"></div>
                        </div>
                    </div>
                    <p>In Addition to our commitment towards advantages are :</p>
                    <div class="simple-article normall">
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis et perspiciatis unde omnis iste natus error sit voluptatem</p>
                    </div>
                    <div class="emptySpace30"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="simple-article normall">
                                <ul>
                                    <li>Stress Disorders</li>
                                    <li>Amotivation Disorders</li>
                                    <li>Sexual Disorders</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="simple-article normall">
                                <ul>
                                    <li>Impulsivity Disorders</li>
                                    <li>Smoking Disorders</li>
                                    <li>Suicidal Disorders</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6">
                <div class="titleShortocode">
                    <h3 class="h3 as"><?=Yii::t('app', 'general_questions') ?></h3>
                </div>
                <div class="emptySpace40 emptySpace-xs30"></div>
                <!-- 	Accordeon-START 	-->
                <div class="accordeon normall">
                    <div class="accordeon-title active">
                        <div class="accrodeonButton"><span></span><span></span></div>
                        How do I sign up for counseling?
                    </div>
                    <div class="accordeon-toggle" style="display: block;">
                        <div class="simple-article">
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis et perspiciatis unde omnis iste natus error sit voluptatem</p>
                        </div>
                    </div>
                    <div class="emptySpace20"></div>
                    <div class="accordeon-title">
                        <div class="accrodeonButton"><span></span><span></span></div>
                        How can therapy help?
                    </div>
                    <div class="accordeon-toggle">
                        <div class="simple-article">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit placerat id. Nulla ultricies augue at felis elementum, sodales rhoncus metus sagittis.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit</p>
                        </div>
                    </div>
                    <div class="emptySpace20"></div>
                    <div class="accordeon-title">
                        <div class="accrodeonButton"><span></span><span></span></div>
                        How much do the counseling sessions cost?
                    </div>
                    <div class="accordeon-toggle">
                        <div class="simple-article">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit placerat id. Nulla ultricies augue at felis elementum, sodales rhoncus metus sagittis.</p>
                        </div>
                    </div>
                    <div class="emptySpace20"></div>
                    <div class="accordeon-title">
                        <div class="accrodeonButton"><span></span><span></span></div>
                        Does the Counseling Center offer counseling?
                    </div>
                    <div class="accordeon-toggle">
                        <div class="simple-article">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit augue lacus, id auctor elit placerat id. Nulla ultricies augue at felis elementum, sodales rhoncus metus sagittis.</p>
                        </div>
                    </div>
                </div>
                <!-- 	Accordeon-END 	-->
            </div>
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

<!-- 	Last news-START 	-->
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h3 class="h3 as"><?= Yii::t('app', 'latest_news') ?></h3>
                </div>
            </div>
            <?php if (isset($news) && !empty($news)) {
                foreach ($news as $n) {
                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $n['image'];
                    ?>
                    <div class="col-xs-12 col-sm-4">
                        <div class="tumbWrapper style2">
                            <div class="imgWrapper">
                                <img src="<?=$imagePath?>" alt="">
                                <div class="timeBlock"><?=date('Y-m-d', strtotime($n['created_at'])) ?></div>
                            </div>
                            <h6 class="h6 as"><a href="<?= Yii::$app->params['siteUrl'] ?>/news/<?=$n['id']?>"><?= $n['title']?></a></h6>
                            <div class="tumbContent small">
                                <p><?= substr($n['full'], 0, 150) . "..."?></p>
                            </div>
                            <a class="readMore" href="<?= Yii::$app->params['siteUrl'] ?>/news/<?=$n['id']?>"><?=Yii::t('app', 'read_more')?></a>
                        </div>
                        <div class="emptySpace-xs30"></div>
                    </div>
                <?php }
            } else  ?>
        </div>
    </div>
</div>
<!-- 	Last news-END 	-->

<!-- 	Request-START 	-->
<div class="contentPadding grey colorBlack">
    <div class="contactBg bgShadow style2" style="background-image: url(img/bg-layer.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="contactContent">
                    <div class="simple-article light large">
                        <p>The Counseling Clinic gives proficient directing and psychotherapy administrations for people and families in Ny City.</p>
                    </div>
                </div>
                <div class="emptySpace30"></div>
                <div class="contactContent normall">
                    <span>The Counseling Clinic</span>
                    <p>2416 Towncrest Drive, Iowa City, IA 52245</p>
                    <a href="tel:3193546238">Phone: 319-354-6238</a>
                </div>
                <div class="emptySpace30"></div>
                <div class="contactContent normall">
                    <span>Monday to Friday :</span> <p>8:00 AM – 9:00 PM</p>
                    <div class="emptySpace5"></div>
                    <span>Saturday :</span> <p>10:00 AM – 6:00 PM</p>
                    <div class="emptySpace5"></div>
                    <span>Sunday :</span> <p>Closed</p>
                </div>
                <div class="emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6 col-sm-offset-2">
                <form class="requestForm" action="<?=Url::toRoute('site/')?>" method="post">
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
                            <input class="simple-input <?=$errors['subject'][0] ? 'invalid' : '' ?>" name="subject" type="text" value="" placeholder="<?=Yii::t('app', 'subject') ?>" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12">
                            <textarea class="simple-input <?=$errors['message'][0] ? 'invalid' : '' ?>" name="message" maxlength="3000" placeholder="<?=Yii::t('app', 'message') ?>"></textarea>
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







