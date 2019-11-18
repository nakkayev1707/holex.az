<?php

use yii\helpers\Url;

?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <h1 class="h1 light as"><?=Yii::t('app', 'menu_services') ?></h1>
                        <div class="breadCrumbs small">
                            <a href="<?=Url::toRoute('site/') ?>"><?=Yii::t('app', 'menu_home') ?></a> <i class="fa fa-angle-right"></i> <span><?=Yii::t('app', 'menu_services') ?></span>
                        </div>
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
                    <h2 class="h2 as">We Services</h2>
                    <p>Lorem Ipsum is simply text of the Lorem Ipsum is  simply my text of the printing and Ipsum is simply text of the Ipsum is simply text of thetypesetting Ipsum is simply text of the stry simply dummy text of the printing and typesetting industry.</p>
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
                            <a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/service/view/<?= $service['id'] ?>" class="imgWrapper imgTumb bgShadow light">
                                <img src="<?=$imagePath?>" alt="">
                            </a>
                            <h6 class="h6 as"><a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/service/<?= $service['id'] ?>"><?=$service['title']?></a></h6>
                            <div class="tumbContent small">
                                <p><?=$service['full']?></p>
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
    <div class="contactBg bgShadow" style="background-image: url(img/bg-layer2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
                <form class="requestForm">
                    <div class="contentTitle">
                        <h3 class="h3 as">Request a Free <span>Consultation</span></h3>
                    </div>
                    <div class="emptySpace15"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input" type="text" value="" placeholder="Full Name" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input" type="email" value="" placeholder="Email" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input class="simple-input" type="text" value="" placeholder="Phone" />
                            <div class="emptySpace15"></div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <!-- 	SumoSelect-START 	-->
                            <div class="sumoWrapper">
                                <select name="form" class="SelectBox">
                                    <option selected disabled>I want to discuss</option>
                                    <option>discuss1</option>
                                    <option>discuss2</option>
                                    <option>discuss3</option>
                                    <option>discuss4</option>
                                </select>
                            </div>
                            <!-- 	SumoSelect-END 	-->
                            <div class="emptySpace-sm15"></div>
                        </div>
                        <div class="col-xs-12">
                            <textarea class="simple-input" placeholder="Special Request"></textarea>
                        </div>
                    </div>
                    <div class="emptySpace30"></div>
                    <div class="btnWrapper">
                        <button type="submit" class="button">Submit Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 	Request-END 	-->