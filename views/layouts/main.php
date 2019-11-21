<?php

/* @var $this View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
$params = Yii::$app->params;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <?= Html::csrfMetaTags() ?>
    <?php
    $this->registerMetaTag($params['og_title'], 'og_title');
    $this->registerMetaTag($params['og_description'], 'og_description');
    $this->registerMetaTag($params['og_url'], 'og_url');
    $this->registerMetaTag($params['og_image'], 'og_image');
    $this->registerMetaTag($params['og_type'], 'og_type');
    $this->registerMetaTag($params['og_sitename'], 'og_sitename');
    $this->registerMetaTag($params['og_video'], 'og_video');
    ?>
    <meta property="og:image:width" content="1200px"/>
    <meta property="og:image:height" content="650px"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7COpen+Sans:300,400,600,700%7CRaleway:400,700,800"
          rel="stylesheet">
    <link rel="shortcut icon" href="../../web/favicon.ico"/>
    <link rel="stylesheet" href="../../web/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="../../web/css/swiper.css" type="text/css"/>
    <link rel="stylesheet" href="../../web/css/sumoselect.css">
    <link rel="stylesheet" href="../../web/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="../../web/css/flaticon.css">
    <link rel="stylesheet" href="../../web/css/style.css" type="text/css"/>
    <title><?= Html::encode($this->title) ?></title>
    <style>
        #loader-wrapper {
            position: fixed;
            left: 0;
            top: -100px;
            right: 0;
            bottom: -100px;
            background: #fff;
            z-index: 100;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<!-- 	Loader-START 	-->
<div id="loader-wrapper"></div>
<!-- 	Loader-END 	-->

<div id="content-block">
    <!-- Header-START -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="headerMoreInfo">
                        <div class="phoneBlock">
                            <i class="flatIcon Fphone2 flaticon-technology"></i>
                            <p><?=Yii::t('app', 'call_us') ?></p>
                            <h5 class="h5 as"><a href="tel:994507979600"><?=Yii::$app->params['companyPhone']?></a></h5>
                        </div>
                        <a href="<?= Url::toRoute('site/contact') ?>"
                           class="button btnSize1"><?= Yii::t('app', 'get_appointment') ?></a>
                    </div>

                    <div class="responsiveSrollWrapper">
                        <!-- 	Header top-START 	-->
                        <div class="headerTopInfo">
                            <div class="headerTopInfoContaner">
                                <!-- 	Logo-START 	-->
                                <a href="<?= Url::toRoute('site/') ?>" class="logo">
                                    <img src="<?=$params['siteUrl']?>/img/logo.png" alt="">
                                </a>
                                <!-- 	Logo-END 	-->

                                <!-- 	Responsive menu-START 	-->
                                <div class="menuIcon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <!-- 	Responsive menu-END 	-->
                            </div>
                        </div>
                        <div class="responsiveWrapper">
                            <div class="navScroll">
                                <nav>
                                    <ul>
                                        <?php $route = Yii::$app->controller->route;?>
                                        <li class="<?=$route == 'site/index' ? 'active': '' ?>"><a href="<?= Url::toRoute('/') ?>"><?= Yii::t('app', 'menu_home') ?></a></li>
                                        <li class="<?=$route == 'site/about' ? 'active': '' ?>"><a href="<?= Url::toRoute('/about') ?>"><?= Yii::t('app', 'menu_about') ?></a></li>
                                        <li class="<?=$route == 'service/index' || $route == 'service/view' ? 'active': '' ?>"><a href="<?=Url::toRoute('service/') ?>"><?= Yii::t('app', 'menu_services') ?></a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li><a href="<?= Url::toRoute('service/') ?>"><?= Yii::t('app', 'menu_all_services') ?></a></li>
                                                <?php
                                                $services = $this->params['services'];
                                                if (isset($services) && !empty($services)) {
                                                    foreach ($services as $service) {
                                                        ?>
                                                        <li><a href="<?=Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/service/<?= $service['id']?>"><?=$service['title']?></a></li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </li>
                                        <li class="<?=$route == 'news/index' || $route == 'news/view' ? 'active': '' ?>"><a href="<?= Url::toRoute('/news') ?>"><?= Yii::t('app', 'menu_news') ?></a></li>
                                        <li class="<?=$route == 'site/media' ? 'active': '' ?>"><a href="<?= Url::toRoute('/media') ?>"><?= Yii::t('app', 'menu_media') ?></a></li>
                                        <li class="<?=$route == 'blog/index' || $route == 'blog/view' ? 'active': '' ?>"><a href="<?= Url::toRoute('/blog') ?>"><?= Yii::t('app', 'menu_blog') ?></a></li>
                                        <li class="<?=$route == 'site/contact' ? 'active': '' ?>"><a href="<?= Url::toRoute('/contact') ?>"><?= Yii::t('app', 'menu_contact_me') ?></a></li>
                                        <li><a href="#"><?= Yii::$app->language ?></a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li>
                                                    <?= Html::a('<span class="lt">AZ</span>', array_merge(
                                                        Yii::$app->request->get(),
                                                        [Yii::$app->controller->route, 'language' => 'az']
                                                    ));
                                                    ?>
                                                </li>
                                                <li>
                                                    <?= Html::a('<span class="lt">EN</span>', array_merge(
                                                        Yii::$app->request->get(),
                                                        [Yii::$app->controller->route, 'language' => 'en']
                                                    ));
                                                    ?>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
<!--                                    <div class="nav-search pull-right text-right" style="right: -4%;">-->
<!--                                        <div class="widget-t widget-t-search">-->
<!--                                            <div class="widget-t-inner">-->
<!--                                                <form action="--><?//=Url::toRoute('site/index') ?><!--" method="get" class="search-form">-->
<!--                                                    <div class="input-group">-->
<!--                                                        <input type="search" name="q" placeholder="--><?//=Yii::t('app', 'search') ?><!--"-->
<!--                                                               class="form-control"><span class="input-group-addon">-->
<!--                                                            <button type="submit"><i-->
<!--                                                                        class="icon icon-Search"></i></button></span>-->
<!--                                                    </div>-->
<!--                                                </form>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                </nav>
                            </div>
                        </div>
                        <!-- 	 Menu-END 	-->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-END -->
    <div class="headerClearFix"></div>

    <div class="content-block">
        <?= $content ?>
    </div>

    <!-- Footer-START -->
    <footer>
        <div class="container">
            <!-- 	Footer top info-START 	-->
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-3">
                    <!-- 	Block1-START 	-->
                    <div class="footerBlock small">
                        <!-- 	Logo-START 	-->
                        <a href="<?= Url::toRoute('site/index') ?>" class="logo">
                            <img src="img/footer-logo.png" alt="">
                        </a>
                        <!-- 	Logo-END 	-->
                        <div class="simple-article">
                            <p><?=Yii::t('app', 'footer_text') ?></p>
                        </div>
                        <!-- 	Social-START 	-->
                        <div class="socialWrapper light">
                            <a href="https://www.instagram.com/myholex/?igshid=1871ml9ixf4dp" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-skype"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-pinterest-square"></i></a>
                        </div>
                        <!-- 	Social-END 	-->
                        <div class="emptySpace-md30"></div>
                    </div>
                    <!-- 	Block1-END 	-->
                </div>
                <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0">
                    <!-- 	Block2-END 	-->
                    <div class="footerBlock normall">
                        <div class="simple-article style2">
                            <ul>
                                <li><a href="<?=Url::toRoute('site/about') ?>"><?=Yii::t('app', 'menu_about') ?></a></li>
                                <li><a href="<?=Url::toRoute('site/contact') ?>"><?=Yii::t('app', 'get_appointment') ?></a></li>
                            </ul>
                        </div>
                        <div class="emptySpace-md30"></div>
                    </div>
                    <!-- 	Block2-END 	-->
                </div>
                <div class="col-xs-12 col-sm-5 col-md-3">
                    <!-- 	Block3-END 	-->
                    <div class="footerBlock normall">
                        <div class="footerTitle">
                            <p><?=Yii::t('app', 'menu_services') ?></p>
                        </div>
                        <div class="simple-article style2">
                            <ul>
                                <li><a href="<?=Url::toRoute('service/index') ?>"><?=Yii::t('app', 'menu_all_services') ?></a></li>
                                <?php if (!empty($lastFourServiceType)) {
                                    foreach ($lastFourServiceType as $serviceType) { ?>
                                        <li><a href="<?= Url::toRoute('service/?id=').$serviceType['id']?>"><?= $serviceType['title']?></a></li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- 	Block3-END 	-->
                </div>
                <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0">
                    <!-- 	Block4-END 	-->
                    <div class="footerBlock normall">
<!--                        <div class="locationBlock">-->
<!--                            <img src="img/location-icon.png" alt="">-->
<!--                            <div class="locationContent">-->
<!--                                <span>54B, Tailstoi Town 5238 MT, lowa city, IA 522364</span>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="footerContants">
                            <i class="fa fa-phone"></i>
                            <a href="tel:994507979600"><?=Yii::$app->params['companyPhone']?></a>
                        </div>
                        <div class="footerContants">
                            <i class="fa fa-envelope-o"></i>
                            <a href="mailto:<?=Yii::$app->params['companyEmail']?>"><?=Yii::$app->params['companyEmail']?></a>
                        </div>
                    </div>
                    <!-- 	Block4-END 	-->
                </div>
            </div>
            <!-- 	Footer top info-END 	-->

            <div class="emptySpace10"></div>

            <!-- 	Footer bottom info-START 	-->
            <div class="row">
                <div class="bottomInfo small">
                    <div class="col-xs-12 col-sm-8">
                        <div class="copy">
                            <p><?=Yii::t('app', 'copyright') ?> <?= date('Y')?>. <?=Yii::t('app', 'all_rights_reserved') ?>.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- 	Footer bottom info-END 	-->
        </div>
    </footer>
    <!-- Footer-END -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
