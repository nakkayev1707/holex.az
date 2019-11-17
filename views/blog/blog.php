<?php

use yii\helpers\Url;

?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url(img/banner-img2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <h1 class="h1 light as"><?=Yii::t('app', 'menu_blog') ?></h1>
                        <div class="breadCrumbs small">
                            <a href="<?=Url::toRoute('site/') ?>"><?=Yii::t('app', 'menu_home') ?></a> <i class="fa fa-angle-right"></i> <span><?=Yii::t('app', 'menu_blog') ?></span>
                        </div>
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
            <div class="col-sm-12 col-md-3">
                <div class="mobileSearch large">
                    <?=Yii::t('app', 'search') ?>
                    <i class="fa fa-angle-down"></i>
                </div>
                <aside class="blogAside">
                    <div class="searchWrapper">
                        <form action="<?=Url::toRoute('blog/')?>" method="get">
                            <input class="simple-input" type="text" name="q" placeholder="<?=Yii::t('app', 'search') ?>">
                            <button class="searchBtn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>

                    <!-- 	Recent news-START-->
                    <div class="recentTitle">
                        <h5 class="h5 as"><?=Yii::t('app', 'latest_publications') ?></h5>
                    </div>

                    <?php if (isset($lastFiveBlog)) {
                        foreach ($lastFiveBlog as $blog) {
                            ?>
                            <div class="recentNewsBlock normall">
                                <div class="recentNews">
                                    <a href="<?= Yii::$app->params['siteUrl'] ?>/blog/<?=$blog['id']?>"><?=$blog['title']?></a>
                                    <span><?=date('d-m-Y', strtotime($blog['created_at']))?></span>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </aside>
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="mainBlogContent">
                    <!-- 	Blog1-START 	-->
                    <?php if (isset($blogList)) {
                        foreach ($blogList as $blog) {
                            $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $blog['image']; ?>
                            <div class="blogWrapper">
                                <a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog/<?= $blog['id'] ?>"
                                   class="imgWrapper blogThumbnail">
                                    <img src="<?= $imagePath ?>" alt="">
                                    <span class="timeBlock"><?= date('d-m-Y', strtotime($blog['created_at'])) ?></span>
                                </a>
                                <div class="blogInfo">
                                    <p><i class="fa fa-user"></i> by : michale John</p>
                                    <p><i class="fa fa-tag"></i> depression / couple counselling / treatment</p>
                                    <p><i class="fa fa-comments-o"></i> comments: <span>5</span></p>
                                </div>
                                <div class="blogContent">
                                    <h5 class="h5 as"><a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog/<?= $blog['id'] ?>"><?=$blog['title']?></a></h5>
                                    <div class="simple-article normall">
                                        <p><?=substr($blog['full'], 0, 300) . "..." ?></p>
                                    </div>
                                </div>
                                <a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog/<?= $blog['id'] ?>"
                                   class="button"><?= Yii::t('app', 'read_more') ?></a>
                            </div>
                            <div class="emptySpace80 emptySpace-xs30"></div>
                        <?php } ?>
                        <!-- 	Blog1-END 	-->
                        <div class="emptySpace90 emptySpace-xs30"></div>
                        <!-- 	Page pagination-START 	-->
                        <div class="paginationWrapper large">
                            <a class="pagiPrev" href="#"><i class="fa fa-angle-left"></i></a>
                            <div class="nubmerPagination">
                                <a class="numberPagi activePagi" href="#">1</a>
                                <a class="numberPagi" href="#">2</a>
                            </div>
                            <a class="pagiNext" href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                        <!-- 	Page pagination-END 	-->
                    <?php } else { ?>


                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>