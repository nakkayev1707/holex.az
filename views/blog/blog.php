<?php

use yii\helpers\Url;
$this->title = Yii::t('app', 'menu_blog');

?>
<!-- 	Top banner-START 	-->
<div class="contentPadding bg bgShadow" style="background-image: url(<?=Yii::$app->params['siteUrl'] . '/img/publication_header.jpeg'?>)">
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
                    <?php if (isset($blogList) && !empty($blogList)) {
                        foreach ($blogList as $blog) {
                            $imagePath = Yii::$app->params['siteUrl'] . Yii::$app->params['uploadsUrl'] . "/publications/" . $blog['image']; ?>
                            <div class="blogWrapper">
                                <a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog/<?= $blog['id'] ?>"
                                   class="imgWrapper blogThumbnail">
                                    <img src="<?= $imagePath ?>" alt="">
                                    <span class="timeBlock"><?= date('d-m-Y', strtotime($blog['created_at'])) ?></span>
                                </a>
                                <div class="blogContent">
                                    <h5 class="h5 as"><a href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog/<?= $blog['id'] ?>"><?=$blog['title']?></a></h5>
                                    <div class="simple-article normall">
                                        <p><?=substr($blog['full'], 0, 300) . (strlen($blog['full']) > 300 ? "..." : "")?></p>
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
                            <?php
                                $first_page = $currentPage <= 1 ? 'not-active' : '';
                                $last_page = $currentPage >= $pagesAmount ? 'not-active' : '';
                            ?>
                            <a  class="pagiPrev <?=$first_page?>" href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog?page=<?= ($currentPage - 1) ?>"><i class="fa fa-angle-left"></i></a>
                            <div class="nubmerPagination">
                                <?php for ($i = 1; $i <= $pagesAmount; $i++) { ?>
                                    <a class="numberPagi <?= $currentPage == $i ? 'activePagi': ''?>" href="<?=Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog?page=<?=$i?>"><?=$i?></a>
                                <?php } ?>
                            </div>
                            <a class="pagiNext <?=$last_page?>" href="<?= Yii::$app->params['siteUrl'] . "/" . Yii::$app->language ?>/blog?page=<?= ($currentPage + 1) ?>"><i class="fa fa-angle-right"></i></a>
                        </div>
                        <!-- 	Page pagination-END 	-->
                    <?php } else { ?>
                        <div class="blogContent">
                            <h5 class="h5 as"><?=Yii::t('app', 'publication_not_found') ?></h5>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .not-active {
        pointer-events: none;
        cursor: default;
        text-decoration: none;
    }
</style>