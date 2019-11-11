<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

$only_lang = (count($langs)==1);

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" type="text/css"
      rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<?php
view::appendCss(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/css/bootstrap-datepicker3.css');
view::appendCss(SITE . CMS_DIR . JS_DIR . 'jquery-ui-1.12.1/jquery-ui.css');
view::appendJs(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/js/bootstrap-datepicker.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/locales/bootstrap-datepicker.'.$_SESSION[CMS::$sess_hash]['ses_adm_lang'].'.min.js');
// load CK Editor
view::appendJs(SITE.CMS_DIR.JS_DIR.'ckeditor-4.6.2/ckeditor.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'ckfinder/ckfinder.js');
// load Select2 plugin
view::appendJs(SITE.CMS_DIR.JS_DIR.'select2/js/select2.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'select2/js/i18n/'.$_SESSION[CMS::$sess_hash]['ses_adm_lang'].'.js');

?>

<script type="text/javascript">
    // <![CDATA[
    CKFinder.setupCKEditor(null);

    $(document).ready(function() {
        $('.image-preview').append('<div class="image-preview-overlay"></div>');
        $('.image-preview').hover(function() {
            var $overlay = $('.image-preview-overlay', this);
            var $info = $('.image-preview-info', this);
            var $img = $('img', this);
            $overlay.show();
            $info.show();
            $overlay.height($img.outerHeight());
            $overlay.width($img.outerWidth());
        }, function() {
            var $overlay = $('.image-preview-overlay', this);
            var $info = $('.image-preview-info', this);
            $overlay.hide();
            $info.hide();
        });

        utils.setConfirmation('click', '#aDelImg', '<?=CMS::t('delete_confirmation');?>', function($el) {
            $.ajax({
                url: $el.attr('href'),
                async: true,
                cache: false,
                dataType: 'json',
                method: 'post',
                data: {
                    article_id: '<?=$publication['id'];?>',
                    CSRF_token: '<?=$CSRF_token;?>'
                },
                success: function(response, status, xhr) {
                    if (response.success) {
                        utils.alert('<?=utils::safeJsEcho(CMS::t('del_suc'), 1);?>', function() {
                            location.href = location.href;
                        });
                    } else {
                        utils.alert('<?=utils::safeJsEcho(CMS::t('del_err'), 1);?>');
                    }
                },
                error: function(xhr, err, descr) {
                    utils.alert(err+' '+descr);
                }
            });

            return false;
        });
    });
    // ]]>
</script>

<form action="?controller=publications&amp;action=delete_image" method="post" id="formDeleteItem">
    <input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
    <input type="hidden" name="image_id" value="0" />
    <input type="hidden" name="delete" value="0" />
</form>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=CMS::t('menu_item_publication_edit');?>
    </h1>
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
    <nav>
        <a href="<?=utils::safeEcho($link_back, 1);?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?=CMS::t('back');?></a>
    </nav>
</section>


<!-- Main content -->
<section class="content">
    <?php
    if (!empty($op)) {
        if ($op['success']) {
            print view::notice($op['message'], 'success');
        } else {
            print view::notice(empty($op['errors'])? $op['message']: $op['errors']);
        }
    }
    ?>
    <div class="box" style="border-top: none;">
        <form action="" method="post" enctype="multipart/form-data" class="form-std" role="form">
            <input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

            <div class="box-body" style="padding: 0;">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#common-tab" data-toggle="tab"><?=CMS::t('common_data');?></a></li>
                        <?php
                        if (!empty($langs) && is_array($langs)) foreach ($langs as $lng) {
                            ?><li><a href="#lang-<?=$lng['language_dir'];?>-tab" data-toggle="tab"><?=($only_lang? CMS::t('content'): $lng['language_name']);?></a></li><?php
                        }
                        ?>
                    </ul>

                    <div class="tab-content">
                        <!-- Common Informational TAB -->
                        <div class="tab-pane active" id="common-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?=CMS::t('image');?> (<?=CMS::t('multi_image_select_warn')?>)</label>
                                        <?=view::browse([
                                            'name' => 'img[]',
                                            'accept' => 'image/*',
                                            'multiple' => true,
                                        ]);?>
                                        <p class="form-info-tip"><?=CMS::t('article_image_descr', [
                                                '{types}' => implode(', ', $allowed_thumb_ext)
                                            ]);?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="selectType" class="form-label"><?=CMS::t('filter_publication_type');?> *</label>
                                        <select name="type" id="selectType" class="form-control">
                                            <?php
                                            if (!empty($publicationTypes) && is_array($publicationTypes)) {
                                                foreach ($publicationTypes as $type) {
                                                    ?><option <?= $publication['type']==$type['type'] ? "selected='selected'" : '' ?> value="<?=$type['type'];?>"><?=CMS::t($type['translate_key'])?></option><?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $is_hidden = $publication['is_hidden'];
                                        ?>
                                        <input type="checkbox" name="visibility" value="1"<?=(!$is_hidden? ' checked="checked"': '');?> id="triggerArticleStatus" /><label for="triggerArticleStatus" style="display: inline; font-weight: normal;"> <?=CMS::t('publication_is_hidden');?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel owl-theme">
                                        <?php
                                        if (!empty($images)) {
                                            foreach ($images as $image) {
                                                $uploadUrl = SITE . utils::dirCanonicalPath(CMS_DIR . UPLOADS_DIR);
                                                $previewUrl = $uploadUrl . 'publications/' . $image['image']; ?>
                                                <div class="item">
                                                    <div class="mod_buttons">
<!--                                                        --><?php //if (CMS::hasAccessTo('publications/edit', 'write')) { ?>
<!--                                                            <a href="?controller=publications&amp;action=edit&amp;id=--><?//=$image['id']?><!--&amp;publication_id=--><?//=$publication['id']?><!--&amp;return=--><?//=""?><!--&amp;--><?//=time();?><!--" title="--><?//=CMS::t('edit');?><!--">-->
<!--                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>-->
<!--                                                            </a>-->
<!--                                                        --><?php //} else if (CMS::hasAccessTo('publications/edit', 'read')) { ?>
<!--                                                            <a href="?controller=publications&amp;action=edit&amp;id=--><?//=$image['id'];?><!--&amp;return=--><?//=$link_back;?><!--&amp;--><?//=time();?><!--" title="--><?//=CMS::t('view');?><!--">-->
<!--                                                                <i class="fa fa-eye" aria-hidden="true"></i>-->
<!--                                                            </a>-->
<!--                                                        --><?php //} ?>
                                                        <?php if (CMS::hasAccessTo('publications/delete', 'write')) { ?>
                                                            <a href="#" title="<?=CMS::t('delete');?>" class="text-red"  id="imageDeleteItem_<?=$image['id'];?>" data-item-id="<?=$image['id'];?>">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                            <script type="text/javascript">
                                                                $('#imageDeleteItem_<?=$image['id'];?>').on('click', function() {
                                                                    bootbox.confirm({
                                                                        message: '<?=CMS::t('delete_confirmation');?>',
                                                                        callback: function(ok) {
                                                                            if (ok) {
                                                                                var $form = $('#formDeleteItem');
                                                                                $('[name="delete"]', $form).val('<?=$image['id'];?>');
                                                                                $('[name="image_id"]', $form).val('<?=$image['id'];?>');
                                                                                $form.submit();
                                                                            }
                                                                        }
                                                                    });
                                                                    return false;
                                                                });
                                                            </script>
                                                        <?php } ?>
                                                    </div>
                                                    <a target="_blank" class="fancybox" rel="group"
                                                       data-target="fancy-box"
                                                       href="<?= $previewUrl; ?>">
                                                        <img src="<?= $previewUrl ?>" alt="image">
                                                    </a>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (!empty($langs) && is_array($langs)) foreach ($langs as $lng) {
                            ?>
                            <div id="lang-<?=$lng['language_dir'];?>-tab" class="tab-pane">
                                <!-- <?=$lng['language_name'];?> tab -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= CMS::t('article_title'); ?></label>
                                            <input type="text" name="title[<?= $lng['language_dir']; ?>]"
                                                   value="<?= utils::safeEcho((isset($_POST['title'][$lng['language_dir']]) ? $_POST['title'][$lng['language_dir']] : @$publication['translates'][$lng['language_dir']]['title']), 1); ?>"
                                                   class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?=CMS::t('article_full');?></label>
                                            <textarea name="full[<?=$lng['language_dir'];?>]" rows="4" cols="32" class="form-input-std" id="wysiwyg_full_<?=$lng['language_dir'];?>"><?=utils::safeEcho((isset($_POST['full'][$lng['language_dir']])? $_POST['full'][$lng['language_dir']]: @$publication['translates'][$lng['language_dir']]['full']), 1);?></textarea>
                                            <script type="text/javascript">
                                                // <![CDATA[
                                                CKEDITOR.replace('wysiwyg_full_<?=$lng['language_dir'];?>', {
                                                    language: '<?=$_SESSION[CMS::$sess_hash]['ses_adm_lang'];?>',
                                                    baseHref: '<?=SITE;?>',
                                                    contentsCss: '<?=SITE;?>web/assets/base/css/content.css',
                                                    uploadUrl: '<?=UPLOADS_DIR;?>',
                                                    contentsLanguage: '<?=$lng['language_dir'];?>'
                                                });
                                                // ]]>
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <?php if ($canWrite) { ?>
                <div class="box-footer">
                    <button type="submit" name="save" value="1" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> <?=CMS::t('save');?></button>
                    <button type="submit" name="apply" value="1" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> <?=CMS::t('apply');?></button>
                    <button type="reset" name="reset" value="1" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
                </div>
            <?php } ?>
        </form>
    </div>
</section>
<!-- /.content -->

<script>
    $(document).ready(function () {
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
    });
</script>