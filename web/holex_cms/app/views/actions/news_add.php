<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}



// load resourses

// load Bootstrap Datepicker
view::appendCss(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/css/bootstrap-datepicker3.css');
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
    // ]]>
</script>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=CMS::t('menu_item_articles_add');?>
        <!-- <small>Subtitile</small> -->
    </h1>

    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol> -->
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

    <!-- Info boxes -->

    <div class="box" style="border-top: none; ">
        <!-- <div class="box-header with-border">
			<h3 class="box-title"><?=CMS::t('menu_item_articles_add');?></h3>
		</div> -->
        <!-- /.box-header -->

        <form action="" method="post" enctype="multipart/form-data" class="form-std" role="form">
            <input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

            <div class="box-body" style="padding: 0;">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#common-tab" data-toggle="tab"><?=CMS::t('common_data');?></a></li>
                        <?php
                        if (!empty($langs) && is_array($langs)) foreach ($langs as $lng) {
                            ?><li><a href="#lang-<?=$lng['language_dir'];?>-tab" data-toggle="tab"><?=$lng['language_name'];?></a></li><?php
                        }
                        ?>
                    </ul>

                    <div class="tab-content">
                        <!-- Common Informational TAB -->
                        <div class="tab-pane active" id="common-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><a href="https://google.com/?q=SEF+friendly+urls" title="" target="_blank"><?=CMS::t('article_sef');?> <i class="fa fa-external-link" aria-hidden="true" style="font-size: inherit;"></i></a></label>

                                        <input type="text" name="sef" value="<?=utils::safeEcho(@$_POST['sef'], 1);?>" class="form-control" />
                                        <!-- <p class="form-input-tip"><?=CMS::t('article_sef_descr');?></p> -->
                                    </div>

                                    <div class="form-group">
                                        <label><?=CMS::t('image');?></label>

                                        <?=view::browse([
                                            'name' => 'img',
                                            'accept' => 'image/*'
                                        ]);?>

                                        <p class="form-info-tip"><?=CMS::t('article_image_descr', [
                                                '{types}' => implode(', ', $allowed_thumb_ext)
                                            ]);?></p>
                                    </div>

                                    <div class="form-group">
                                        <label><?=CMS::t('article_source');?></label>

                                        <input type="text" name="source_url" value="<?=utils::safeEcho(@$_POST['source_url'], 1);?>" placeholder="<?=CMS::t('article_source_url');?>" class="form-control" style="margin-bottom: 5px;" />
                                        <input type="text" name="source_name" value="<?=utils::safeEcho(@$_POST['source_name'], 1);?>" placeholder="<?=CMS::t('article_source_name');?>" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label><?=CMS::t('article_publish_datetime');?></label>

                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" name="publish_date" value="<?=utils::safePostValue('publish_date', date('d.m.Y'));?>" placeholder="<?=CMS::t('article_publish_date_placeholder');?>" class="form-control datepicker" />
                                                </div>

                                                <script type="text/javascript">
                                                    // <![CDATA[
                                                    $(document).ready(function() {
                                                        $('[name="publish_date"]').datepicker({
                                                            format: 'dd.mm.yyyy',
                                                            clearBtn: true,
                                                            language: '<?=utils::safeJsEcho($_SESSION[CMS::$sess_hash]['ses_adm_lang'], 1);?>'
                                                        });
                                                    });
                                                    // ]]>
                                                </script>
                                            </div>

                                            <div class="col-xs-6">
                                                <select name="publish_hour" class="form-control" style="display: inline-block; width: 45%;">
                                                    <option value=""><?=CMS::t('article_publish_hour_placeholder');?></option>
                                                    <?php
                                                    $publish_hour_selected = (empty($_POST['publish_hour'])? date('G'): $_POST['publish_hour']);
                                                    for ($i=0; $i<24; $i++) {
                                                        ?><option value="<?=$i;?>"<?=(($i==$publish_hour_selected)? ' selected="selected"': '');?>><?=str_pad($i, 2, '0', STR_PAD_LEFT);?></option><?php
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select name="publish_minutes" class="form-control" style="display: inline-block; width: 45%;">
                                                    <option value=""><?=CMS::t('article_publish_minutes_placeholder');?></option>
                                                    <?php
                                                    $publish_minutes_selected = (empty($_POST['publish_minutes'])? (floor(date('i')/5)*5): $_POST['publish_minutes']);
                                                    if ($publish_minutes_selected>=60) {
                                                        $publish_minutes_selected = 0;
                                                    }
                                                    for ($i=0; $i<60; $i=($i+5)) {
                                                        ?><option value="<?=$i;?>"<?=(($i==$publish_minutes_selected)? ' selected="selected"': '');?>><?=str_pad($i, 2, '0', STR_PAD_LEFT);?></option><?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" name="is_published" value="1"<?=((isset($_POST['is_published']) && empty($_POST['is_published']))? '': ' checked="checked"');?> id="triggerArticleStatus" /><label for="triggerArticleStatus" style="display: inline; font-weight: normal;"> <?=CMS::t('publish');?></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <?php if (!empty($cats) && count($cats)) { ?>
                                        <div class="form-group">
                                            <label><?=CMS::t('article_category');?></label>

                                            <div class="form-div-multicheckbox" style="width: 100%; height: auto; max-height: 214px;">
                                                <?php
                                                foreach ($cats as $c) {
                                                    if (!empty($allowed_cats) && !in_array($c['id'], $allowed_cats)) {continue;}
                                                    $is_pos_selected = false;
                                                    if (!empty($_POST['cats'])) {
                                                        $is_pos_selected = in_array($c['id'], $_POST['cats']);
                                                    }
                                                    ?><input type="checkbox" name="cats[]" value="<?=$c['id'];?>"<?=($is_pos_selected? ' checked="checked"': '');?> id="multiCheckboxCat_<?=$c['id'];?>" /><label for="multiCheckboxCat_<?=$c['id'];?>"> <?=$c['name'];?><?php if (!empty($c['parent']['id'])) { ?> <span style="color: #aaa;">&crarr; <?=$c['parent']['name'];?></span><?php } ?></label><br /><?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <input type="checkbox" name="show_on_main_page" value="1"<?=(empty($_POST['show_on_main_page'])? '': ' checked="checked"');?> id="triggerArticleShowOnMainPage" /><label for="triggerArticleShowOnMainPage" style="display: inline; font-weight: normal;"> <?=CMS::t('article_show_on_main_page');?></label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" name="is_highlighted" value="1"<?=(empty($_POST['is_highlighted'])? '': ' checked="checked"');?> id="triggerArticleIsHighLighted" /><label for="triggerArticleIsHighLighted" style="display: inline; font-weight: normal;"> <?=CMS::t('article_is_highlighted');?></label>
                                    </div>

                                    <div class="form-group">
                                        <label><?=CMS::t('article_gallery');?></label>

                                        <select name="gallery_id" class="form-control select2" id="selectGalleryPicker">
                                            <?php if (!empty($gallery['id'])) { ?>
                                                <option value="<?=$gallery['id'];?>" selected="selected"><?=utils::safeEcho(@$gallery['translates'][CMS::$default_site_lang]['name'], 1);?></option>
                                            <?php } ?>
                                        </select>

                                        <script type="text/javascript">
                                            // <![CDATA[
                                            $('#selectGalleryPicker').select2({
                                                language: '<?=$_SESSION[CMS::$sess_hash]['ses_adm_lang'];?>',
                                                ajax: {
                                                    url: '?controller=gallery&action=ajax_get_autocomplete',
                                                    dataType: 'json',
                                                    delay: 250,
                                                    data: function(params) {
                                                        return {
                                                            q: params.term, // search term
                                                            page: params.page
                                                        };
                                                    },
                                                    processResults: function(response, params) {
                                                        // parse the results into the format expected by Select2
                                                        // since we are using custom formatting functions we do not need to
                                                        // alter the remote JSON data, except to indicate that infinite
                                                        // scrolling can be used
                                                        params.page = params.page || 1;

                                                        return {
                                                            results: response.data.galleries,
                                                            pagination: {
                                                                more: (params.page * 30) < response.data.total_count
                                                            }
                                                        };
                                                    },
                                                    cache: true
                                                },
                                                escapeMarkup: function(markup) {
                                                    return markup;
                                                }, // let our custom formatter work
                                                minimumInputLength: 1,
                                                templateResult: function(gallery) {
                                                    if (gallery.loading) {return gallery.text;}

                                                    var html = '<div class="select2-result-gallery clearfix">'+
                                                        //'<div class="select2-result-gallery__avatar"><img src="'+gallery.preview_url+'" alt="" /></div>'+
                                                        '<div class="select2-result-gallery__meta">'+
                                                        '<div class="select2-result-gallery__title">'+gallery.label+'</div>'+
                                                        //'<div class="select2-result-gallery__statistics">'+
                                                        //'<div class="select2-result-gallery__forks"><i class="fa fa-photo"></i> '+gallery.photos_count+' photos</div>'+
                                                        //'</div>'+
                                                        '</div>'+
                                                        '</div>';

                                                    return html;
                                                },
                                                templateSelection: function(gallery) {
                                                    return (gallery.label || gallery.text);
                                                }
                                            });
                                            // ]]>
                                        </script>
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
                                            <label><?=CMS::t('article_title');?></label>

                                            <input type="text" name="title[<?=$lng['language_dir'];?>]" value="<?php utils::safeEcho(@$_POST['title'][$lng['language_dir']]); ?>" class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <label><?=CMS::t('article_full');?></label>

                                            <textarea name="full[<?=$lng['language_dir'];?>]" rows="4" cols="32" class="form-input-std" id="wysiwyg_full_<?=$lng['language_dir'];?>"><?php utils::safeEcho(@$_POST['full'][$lng['language_dir']]); ?></textarea>
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

                                        <div class="form-group">
                                            <input type="checkbox" name="is_published_lang[<?=$lng['language_dir'];?>]" value="1"<?=((isset($_POST['is_published_lang'][$lng['language_dir']])? $_POST['is_published_lang'][$lng['language_dir']]: 0)? ' checked="checked"': '');?> id="triggerLangStatus_<?=$lng['language_dir'];?>" /><label for="triggerLangStatus_<?=$lng['language_dir'];?>" style="display: inline; font-weight: normal;"> <?=CMS::t('publish_lang');?></label>
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

            <div class="box-footer">
                <button type="submit" name="add" value="1" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('add');?></button>
                <button type="reset" name="reset" value="1" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
            </div>
        </form>
    </div>
    <!-- /.box -->

    <!-- /.info boxes -->
</section>
<!-- /.content -->