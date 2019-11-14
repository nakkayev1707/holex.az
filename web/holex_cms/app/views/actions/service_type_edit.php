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
        <?=CMS::t('menu_item_service_type_edit');?>
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