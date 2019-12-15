<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'menu_services');

?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow"
     style="background-image: url(<?= Yii::$app->params['siteUrl'] . '/img/service/header_img.png' ?>); background-size: 100%; background-repeat: no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <!--                        <h1 class="h1 light as">--><? //=$view['title']?><!--</h1>-->
                        <!--                        <div class="breadCrumbs small">-->
                        <!--                            <a href="--><? //=Url::toRoute('site/') ?><!--">-->
                        <? //=Yii::t('app', 'menu_home') ?><!--</a> <i class="fa fa-angle-right"></i>-->
                        <!--                            <a href="--><? //=Url::toRoute('service/') ?><!--">-->
                        <? //=Yii::t('app', 'menu_services')?><!--</a> <i class="fa fa-angle-right"></i>-->
                        <!--                            <span>--><? //=$view['title']?><!--</span>-->
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
            <div class="col-sm-12 col-md-4 col-md-push-8 col-lg-3 col-lg-push-9">
                <div class="mobileSearch large">
                    <?= Yii::t('app', 'search') ?>
                    <i class="fa fa-angle-down"></i>
                </div>
                <aside class="blogAside">
                    <ul class="categoryList normall">
                        <?php if (isset($services) && !empty($services)) { ?>
                            <li><a href="<?= Url::toRoute('service/') ?>"><?= Yii::t('app', 'menu_all_services') ?></a>
                            </li>
                            <?php
                            foreach ($services as $service) { ?>
                                <li class="<?= $service['id'] == $view['id'] ? 'activeCat' : '' ?>">
                                    <a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/service/view/<?= $service['id'] ?>"><?= $service['title'] ?></a>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                    <!--                    <div class="pdfBlock">-->
                    <!--                        <i class="fa fa-file-pdf-o"></i>-->
                    <!--                        <div class="pdfSize">-->
                    <!--                            <span>pdf file</span>-->
                    <!--                            <p>size : 47 kb</p>-->
                    <!--                        </div>-->
                    <!--                        <i class="fa fa-cloud-download"></i>-->
                    <!--                    </div>-->
                    <!--                    <div class="openingHours">-->
                    <!--                        <h6 class="h6 as">Opening Hours</h6>-->
                    <!--                        <ul class="normall">-->
                    <!--                            <li><span>Monday - Friday</span> <span>9.30- 19.00</span> <div class="clear"></div></li>-->
                    <!--                            <li><span>Saturday</span> <span>9.30- 16.00</span> <div class="clear"></div></li>-->
                    <!--                            <li><span>Sunday</span> <span>Closed</span> <div class="clear"></div></li>-->
                    <!--                        </ul>-->
                    <!--                    </div>-->
                </aside>
            </div>
            <div class="col-sm-12 col-md-8 col-md-pull-4 col-lg-9 col-lg-pull-3">
                <div class="mainServicesContent">
                    <!-- 	Blog1-START 	-->
                    <div class="blogWrapper">
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="float: right; width: 40%">
                                    <?php
                                    $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/services/" . $view['image'];
                                    ?>
                                    <img src="<?= $imagePath ?>" style="width: 100%; padding: 0 20px" alt="">
                                </div>
                                <div class="blogContent">
                                    <div class="simple-article normall">
                                        <h5><?= $view['title'] ?></h5>
                                        <?= $view['full'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="emptySpace50 emptySpace-xs30"></div>

                        <div class="contactsAdviceWrapper normall">
                            <!--                            <h4 class="h4 as">Get Free Appointment</h4>-->
                            <!--                            <p>We are more than happy to give advice on which counselling is most suitable for your needs, depending on your problems. Why not ask us to view your problems and discuss for solution. Our advice is free!</p>-->
                            <!--                            <div class="emptySpace70 emptySpace-xs30"></div>-->
                            <div class="contactsAdvice">
                                <h3 class="h5 as"><?= Yii::t('app', 'need_advice') ?>
                                    ... <?= Yii::t('app', 'pl_contact_us') ?></h3>
                                <a href="<?= Url::toRoute('site/contact') ?>"
                                   class="button"><?= Yii::t('app', 'get_appointment') ?></a>
                            </div>
                        </div>
                    </div>
                    <!-- 	Blog1-END 	-->

                </div>
            </div>
        </div>
    </div>
</div>