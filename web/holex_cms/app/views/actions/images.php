<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {
    die('Direct access to this location is not allowed.');
}

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" type="text/css"
      rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<?php
view::appendCss(SITE . CMS_DIR . JS_DIR . 'jquery-ui-1.12.1/jquery-ui.css');
?>

<style>
    td {
        vertical-align: middle !important;
    }

    .ui-sortable-helper {
        box-shadow: 0 3px 8px;
        opacity: 0.8;
    }

    a.page-drop-hover {
        background: rgba(255, 126, 0, 0) linear-gradient(to bottom, #ffc600, #ff7e00) repeat scroll 0 0 !important;
    }
</style>
<?php
view::appendJs(SITE . CMS_DIR . JS_DIR . 'jquery-ui-1.12.1/jquery-ui.min.js');
?>


<!-- Deleting hidden form -->
<form action="?controller=publications&amp;action=delete_image" method="post"
      id="formDeleteItem">
    <input type="hidden" name="CSRF_token" value="<?= $CSRF_token; ?>"/>
    <input type="hidden" name="delete" value="0"/>
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= CMS::t('menu_item_publications_images'); ?>
    </h1>
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
    <nav>
        <a href="<?= utils::safeEcho($link_back, 1); ?>" class="btn btn-default"><i class="fa fa-arrow-left"
                                                                                    aria-hidden="true"></i> <?= CMS::t('back'); ?>
        </a>
    </nav>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel owl-theme">
                            <?php
                            if (!empty($images)) {
                            foreach ($images as $image) {
                                $uploadUrl = SITE . utils::dirCanonicalPath(CMS_DIR . UPLOADS_DIR);
                                $previewUrl = $uploadUrl . 'publications/' . $image['image']; ?>
                                <div class="item">
                                    <div class="mod_buttons">
                                        <?php if (CMS::hasAccessTo('publications/edit', 'write')) { ?>
                                            <a href="?controller=publications&amp;action=edit&amp;id=<?= $image['publication_id']; ?>&amp;return=<?= $link_back; ?>&amp;<?= time(); ?>"
                                               title="<?= CMS::t('edit'); ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        <?php } else if (CMS::hasAccessTo('publications/edit', 'read')) { ?>
                                            <a href="?controller=publications&amp;action=edit&amp;id=<?= $image['publication_id']; ?>&amp;return=<?= $link_back; ?>&amp;<?= time(); ?>"
                                               title="<?= CMS::t('view'); ?>">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if (CMS::hasAccessTo('publications/delete', 'write')) { ?>
                                            <a href="#" title="<?= CMS::t('delete'); ?>" class="text-red"
                                               style="margin-left: 84%;" id="publicationImageDeleteItem_<?= $image['id']; ?>"
                                               data-item-id="<?= $image['id']; ?>">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                            <script type="text/javascript">
                                                $('#publicationImageDeleteItem_<?=$image['id'];?>').on('click', function () {
                                                    bootbox.confirm({
                                                        message: '<?=CMS::t('delete_confirmation');?>',
                                                        callback: function (ok) {
                                                            if (ok) {
                                                                var $form = $('#formDeleteItem');
                                                                $('[name="delete"]', $form).val('<?=$image['id'];?>');
                                                                $form.submit();
                                                            }
                                                        }
                                                    });
                                                    return false;
                                                });
                                            </script>
                                        <?php } ?>
                                    </div>
                                    <a target="_blank" class="fancybox" rel="group" data-target="fancy-box"
                                       href="<?= $previewUrl; ?>">
                                        <img src="<?= $previewUrl ?>" alt="image">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div>
                            <p style="color: #ff7904; font-size: 18px;"><?=CMS::t('publications_images_not_found')?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- /.info boxes -->
</section>
<!-- /.content -->

<script>
    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }

    });
</script>