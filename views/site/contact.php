<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>
<div class="contentPadding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="contentTitle normall">
                    <h2 class="h2 as">Get in touch</h2>
                    <p>Lorem Ipsum is simply text of the Lorem Ipsum is  simply my text of the printing and Ipsum is simply text of the Ipsum is simply text of thetypesetting Ipsum is simply text of the stry simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="emptySpace50 emptySpace-xs30"></div>
            </div>
            <div class="col-sm-6 col-md-8">

                <form action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                    <input class="simple-input" id="name" name="name" type="text" value="" placeholder="Name" />
                    <div class="emptySpace20"></div>
                    <input class="simple-input" id="email" name="email" type="email" value="" placeholder="Email" />
                    <div class="emptySpace20"></div>
                    <input class="simple-input" id="subject" name="subject" type="text" value="" placeholder="Subject" />
                    <div class="emptySpace20"></div>
                    <textarea class="simple-input" id="message" name="message" placeholder="Message"></textarea>
                    <div class="emptySpace50 emptySpace-xs30"></div>
                    <button type="submit" class="button">Submit Now</button>
                </form>
                <div class="emptySpace-xs30"></div>
                <div id="success">
                    <p>Your text message sent successfully!</p>
                </div>
                <div id="error">
                    <p>Sorry! Message not sent. Something went wrong!!</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="contactDetails normall">
                    <!-- 	Contacts1-START 	-->
                    <div class="contactAddres">
                        <div class="imgWrapper">
                            <img src="img/location-icon-white.png" alt="">
                        </div>
                        <div class="simple-article light">
                            <p>Phychology, 562, Mallin StreetNew Youk,</p>
                            <p> NY 100 254</p>
                        </div>
                    </div>
                    <!-- 	Contacts1-END 	-->

                    <!-- 	Contacts2-START 	-->
                    <div class="contactAddres">
                        <div class="imgWrapper">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <a href="mailto:info@phycologycare.com">info@phycologycare.com</a>
                        <a href="mailto:support@phycology.com">support@phycology.com</a>
                    </div>
                    <!-- 	Contacts2-END 	-->

                    <!-- 	Contacts3-START 	-->
                    <div class="contactAddres large">
                        <div class="imgWrapper">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="tel:18005622487">+ 1800 562 2487</a>
                    </div>
                    <!-- 	Contacts3-END 	-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="emptySpace20"></div>
<!-- 	Map-START 	-->
<div id="map-canvas" data-lat="34.0151244" data-lng="-118.4729871" data-zoom="15"></div>
<div class="addresses-block">
    <a class="marker" data-lat="34.0151244" data-lng="-118.4729871" data-string="1. Here is some address or email or phone or something else..."></a>
    <a class="marker" data-lat="34.0051244" data-lng="-118.4729871" data-string="1. Here is some address or email or phone or something else..."></a>
</div>
<!-- 	Map-END 	-->

