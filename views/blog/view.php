<?php

use yii\helpers\Url;
$this->title = Yii::t('app', 'menu_blog');
?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url(<?=Yii::$app->params['siteUrl'] . '/img/service/header_img.jpg'?>)">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="servicesTitle">
                    <div class="cell-view">
                        <h1 class="h1 light as"><?=substr($view['title'], 0, 200) ?></h1>
                        <div class="breadCrumbs small">
                            <a href="<?=Url::toRoute('site/') ?>"><?=Yii::t('app', 'menu_home') ?></a> <i class="fa fa-angle-right"></i>
                            <a href="<?=Url::toRoute('blog/') ?>"><?=Yii::t('app', 'menu_blog') ?></a> <i class="fa fa-angle-right"></i>
                            <span><?=Yii::t('app', 'blog_details') ?></span>
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
                    <!-- 	Blog details-START 	-->
                    <div class="blogWrapper">
                        <div class="imgWrapper">
                            <img src="<?=Yii::$app->params['siteUrl'].Yii::$app->params['uploadsUrl']."/publications/".$view['image']; ?>" alt="">
                            <span class="timeBlock"><?=date('d-m-Y', strtotime($view['created_at']))?></span>
                        </div>
                        <div class="blogContent normall">
                            <h5 class="h5 as"><?=$view['title']?></h5>
                            <div class="simple-article">
                                <?= $view['full']?>
                            </div>
<!--                            <blockquote>-->
<!--                                <i class="fa fa-quote-left"></i>-->
<!--                                <p>Ut enim ad minima veniam, quis nostrum exercitatio nem ullam corporis suscipit labori osam, nisi ut aliqu id ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</p>-->
<!--                                <a href="#">- Michale John</a>-->
<!--                            </blockquote>-->
                        </div>
                    </div>
                    <!-- 	Blog details-END 	-->
                </div>
            </div>
        </div>
    </div>
</div>