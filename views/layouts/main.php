<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

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
    <?php $this->registerCsrfMetaTags() ?>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7COpen+Sans:300,400,600,700%7CRaleway:400,700,800"
          rel="stylesheet">
    <link rel="shortcut icon" href="../../web/favicon.ico"/>
    <link rel="stylesheet" href="../../web/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="../../web/css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="../../web/css/sumoselect.css">
    <link rel="stylesheet" href="../../web/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="../../web/css/flaticon.css">
    <link rel="stylesheet" href="../../web/css/style.css" type="text/css" />
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
                    <!-- 	Header more info-START 	-->
                    <div class="headerMoreInfo">
                        <!--  	Phone block-START 	-->
                        <div class="phoneBlock">
                            <i class="flatIcon Fphone2 flaticon-technology"></i>
                            <p>Call Us now</p>
                            <h5 class="h5 as"><a href="tel:">1800 456 7890</a></h5>
                        </div>
                        <!--  	Phone block-END 	-->
                        <a href="#" class="button btnSize1">Book Appointment</a>
                    </div>
                    <!-- 	Header more info-END 	-->

                    <div class="responsiveSrollWrapper">
                        <!-- 	Header top-START 	-->
                        <div class="headerTopInfo">
                            <div class="headerTopInfoContaner">
                                <!-- 	Logo-START 	-->
                                <a href="<?= Url::toRoute('site/index') ?>" class="logo">
                                    <img src="img/logo.png" alt="">
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
                        <!-- 	Header top-END 	-->

                        <!-- 	 Menu-START 	-->
                        <div class="responsiveWrapper">
                            <div class="navScroll">
                                <nav>
                                    <ul>
                                        <li class="active"><a href="index.html">home</a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li><a href="<?=Url::toRoute('site/index') ?>">Home Page 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="services.html">services</a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li><a href="services.html">All Service</a></li>
                                                <li><a href="stress-management.html">Stress Management </a></li>
                                                <li><a href="depression-treatment.html">Depression Therapy</a></li>
                                                <li><a href="couple-counselling.html">Couple Counselling</a></li>
                                                <li><a href="anxiety-treatment.html">Anxiety Treatment</a></li>
                                                <li><a href="elderly-issues.html">Elderly Couple Issues</a></li>
                                                <li><a href="therapy-for-children.html">Therapy for Children</a></li>
                                                <li><a href="family-psycology.html">Family Psycology</a></li>
                                                <li><a href="gruop-therapy.html">Group Therapy</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about-us.html">about us</a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li><a href="#">Our Introduction</a></li>
                                                <li><a href="counsellors.html">Counsellors</a></li>
                                                <li><a href="#">Doctor Profile</a></li>
                                                <li>
                                                    <a href="gallery.html">Gallery</a>
                                                    <i class="fa fa-angle-right"></i>
                                                    <ul>
                                                        <li><a href="gallery.html">Gallery Classic</a></li>
                                                        <li><a href="gallery-fluid.html">Gallery Full Screen</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="404.html">pages</a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li><a href="404.html">404 Page</a></li>
                                                <li><a href="faq.html">Faq</a></li>
                                                <li><a href="comming-soon.html">Comming Soon Page</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="testimonials.html">tesmonials</a></li>
                                        <li><a href="blog.html">blog</a>
                                            <i class="fa fa-angle-down"></i>
                                            <ul>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contacts.html">contact us</a></li>
                                    </ul>
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
                        <a href="<?= Url::toRoute('site/index') ?>>" class="logo">
                            <img src="img/footer-logo.png" alt="">
                        </a>
                        <!-- 	Logo-END 	-->
                        <div class="simple-article">
                            <p>Lorem ipsum dolor sit amet, consectet ur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et.</p>
                        </div>
                        <a class="readMore" href="#">Read More</a>
                        <!-- 	Social-START 	-->
                        <div class="socialWrapper light">
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin-square"></i></a>
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
                        <div class="footerTitle">
                            <p>Extra Links</p>
                        </div>
                        <div class="simple-article style2">
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq’s</a></li>
                                <li><a href="#">Price List</a></li>
                                <li><a href="#">Career</a></li>
                                <li><a href="#">Single counselor</a></li>
                                <li><a href="#">Book Appointment</a></li>
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
                            <p>Our Services</p>
                        </div>
                        <div class="simple-article style2">
                            <ul>
                                <li><a href="#">All Services</a></li>
                                <li><a href="#">Couple Counselling</a></li>
                                <li><a href="#">Depresson Treatment</a></li>
                                <li><a href="#">Relationship counselling</a></li>
                                <li><a href="#">Personal Problems</a></li>
                                <li><a href="#">Anxiety Counselling</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- 	Block3-END 	-->
                </div>
                <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0">
                    <!-- 	Block4-END 	-->
                    <div class="footerBlock normall">
                        <div class="footerTitle">
                            <p>Get in Touch</p>
                        </div>
                        <div class="locationBlock">
                            <img src="img/location-icon.png" alt="">
                            <div class="locationContent">
                                <p>The Psychlogy Clinic</p>
                                <span>54B, Tailstoi Town 5238 MT, lowa city, IA 522364</span>
                            </div>
                        </div>
                        <div class="footerContants">
                            <i class="fa fa-phone"></i>
                            <a href="tel:018655248503">+ 01865 524 8503</a>
                        </div>
                        <div class="footerContants">
                            <i class="fa fa-envelope-o"></i>
                            <a href="mailto:info@psychologyclinic.com">info@psychologyclinic.com</a>
                        </div>
                    </div>
                    <!-- 	Block4-END 	-->
                </div>
            </div>
            <!-- 	Footer top info-END 	-->

            <div class="emptySpace30"></div>

            <!-- 	Footer bottom info-START 	-->
            <div class="row">
                <div class="bottomInfo small">
                    <div class="col-xs-12 col-sm-8">
                        <div class="copy">
                            <p>Copyright © Psychologycare 2017. All rights reserved.</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="created">
                            <a href="#">Created by: <span>DesignArc</span></a>
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
