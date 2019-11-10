<?php
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}
?>

<?php
view::appendCss(SITE.CMS_DIR.JS_DIR.'jquery-ui-1.12.1/jquery-ui.css');
view::appendCss(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/css/bootstrap-datepicker3.css');
view::appendJs(SITE.CMS_DIR.JS_DIR.'jquery-ui-1.12.1/jquery-ui.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/js/bootstrap-datepicker.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/locales/bootstrap-datepicker.'.$_SESSION[CMS::$sess_hash]['ses_adm_lang'].'.min.js');
?>

<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {

        $('#filter-button').on('click', function() {
            $.fancybox.open({
                href: '#popupFilter'
            });
        });

        $('#popupFilterClose').on('click', function() {
            $.fancybox.close();
            return false;
        });

        $('.ajax-set-status').on('click', function(e) {
            var $el = $(this);
            var data = JSON.parse($(this).attr('data-ajax_post'));
            $.ajax({
                url: this.href,
                data: data,
                async: true,
                cache: false,
                type: 'post',
                dataType: 'json',
                success: function(response, status, xhr) {
                    if (response.success) {
                        if (response.data && response.data.action) {
                            var new_status = response.data.action;
                            var old_status = ((new_status==='on')? 'off': 'on');
                            $('i', $el).removeClass('fa-toggle-'+old_status+' btn-toggle-'+old_status).addClass('fa-toggle-'+new_status+' btn-toggle-'+new_status);
                            var title = new_status === 'on' ? 'Click to hide' : 'Click to show';
                            $('i', $el).attr('title', title);
                            data.turn = old_status;
                            $el.attr('data-ajax_post', JSON.stringify(data));
                        }
                    }
                },
                error: function(xhr, err, descr) {}
            });
            return false;
        });
    });
    // ]]>
</script>


<!-- Deleting hidden form -->
<form action="?controller=publications&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
    <input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
    <input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=CMS::t('menu_item_publications_list');?>
    </h1>

    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol> -->
</section>


<!-- Content Header (Page header) -->
<section class="contextual-navigation">
    <nav>
        <?php if (CMS::hasAccessTo('publications/add', 'write')) { ?>
            <a href="?controller=publications&amp;action=add&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('publication_add');?></a>
        <?php } ?>
    </nav>
</section>


<!-- Main content -->
<section class="content">

    <!-- Info boxes -->


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?=CMS::t('publications_list_details', [
                    '{count}' => $count,
                    '{ru:u1}' => utils::getRussianWordEndingByNumber($count, 'а', 'ы', 'о'),
                    '{ru:u2}' => utils::getRussianWordEndingByNumber($count, 'я', 'и', 'ий')
                ]);?></h3>

            <div class="box-tools pull-right col-sm-5 col-lg-6">
                <form action="" method="get" id="formSearchAndFilter">
                    <input type="hidden" name="controller" value="<?=utils::safeEcho(@$_GET['controller'], 1);?>" />
                    <input type="hidden" name="action" value="<?=utils::safeEcho(@$_GET['action'], 1);?>" />
                    <input type="hidden" name="<?=time();?>" value="" />

                    <div class="input-group has-feedback">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-<?=(utils::isEmptyArrayRecursive(@$_GET['filter'])? 'success': 'warning');?>" id="filter-button"><i class="fa fa-filter" aria-hidden="true"></i> <?=CMS::t('filter');?></button>
                        </div>
                        <input type="text" name="q" value="<?=utils::safeEcho(@$_GET['q'], 1);?>" placeholder="<?=CMS::t('search_query');?>" class="form-control input-md" onfocus="this.value='';" />
                        <span class="input-group-btn">
							<button type="submit" name="go" value="1" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> <?=CMS::t('search');?></button>
						</span>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <?php
            if (!empty($publications) && is_array($publications)) {
                ?>
                <table class="table table-bordered table-striped tablesorter">
                    <thead>
                    <tr>
                        <th><?=CMS::t('publication_title');?></th>
                        <th><?=CMS::t('publication_type');?></th>
                        <th><?=CMS::t('publication_is_hidden');?></th>
                        <th><?=CMS::t('publication_date');?></th>
                        <th><?=CMS::t('image');?></th>
                        <th><?=CMS::t('controls');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($publications as $publication) {
                        ?>
                        <tr data-id="<?=$publication['id'];?>">
                            <td>
                                <?=($publication['title']);?>
                            </td>
                            <td>
                                <?=(CMS::t($publication['type']))?>
                            </td>
                            <td>
                                <a href="?controller=publications&amp;action=ajax_set_status" title="" class="ajax-set-status btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
                                    'CSRF_token' => $CSRF_token,
                                    'id' => $publication['id'],
                                    'turn' => ($publication['is_hidden']? 'on': 'off')
                                ]), 1);?>">
                                    <i class="fa fa-toggle-<?=($publication['is_hidden']? 'off': 'on');?> btn-toggle-<?=($publication['is_hidden']? 'off': 'on');?>"  aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                               <?=utils::formatMySQLDate('d.m.Y H:i:s', $publication['created_at']);?>
                            </td>
                            <td>
                                <a href="?controller=publications&action=images&id=<?=$publication['id']?>"><i class="fa fa-image"></i></a>
                            </td>
                            <td style="white-space: nowrap;">
                                <?php if (CMS::hasAccessTo('publications/edit', 'write')) { ?>
                                    <a href="?controller=publications&amp;action=edit&amp;id=<?=$publication['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('edit');?>">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                <?php } else if (CMS::hasAccessTo('publications/edit', 'read')) { ?>
                                    <a href="?controller=publications&amp;action=edit&amp;id=<?=$publication['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>

                                <?php if (CMS::hasAccessTo('publications/delete', 'write')) { ?>
                                    <a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="pDeleteItem_<?=$publication['id'];?>" data-item-id="<?=$publication['id'];?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    <script type="text/javascript">
                                        $('#pDeleteItem_<?=$publication['id'];?>').on('click', function() {
                                            bootbox.confirm({
                                                message: '<?=CMS::t('delete_confirmation');?>',
                                                callback: function(ok) {
                                                    if (ok) {
                                                        var $form = $('#formDeleteItem');
                                                        $('[name="delete"]', $form).val('<?=$publication['id'];?>');
                                                        $form.submit();
                                                    }
                                                }
                                            });
                                            return false;
                                        });
                                    </script>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

                <div class="pagination"><?=view::pg([
                        'total' => $total,
                        'current' => $current,
                        'page_url' => $link_sc.'&amp;page=%d'
                    ]);?></div>
                <?php
            } else {
                print view::callout('', 'danger', 'no_data_found');
            }
            ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- /.info boxes -->
</section>
<!-- /.content -->
<div id="popupFilter" style="display: none; width: 420px;">
    <h4 class="popupTitle"><?=CMS::t('filter_popup_title');?></h4>

    <div class="popupForm">
        <div class="popupFormFieldset">
            <div class="popupFormInputsBlock">
                <label for="selectType" class="form-label"><?=CMS::t('filter_publication_type');?></label>

                <select name="filter[type]" id="selectType" class="form-control" form="formSearchAndFilter">
                    <option value=""><?=CMS::t('filter_no_matter');?></option>
                    <?php
                    if (!empty($publicationTypes) && is_array($publicationTypes)) {
                        foreach ($publicationTypes as $type) {
                            ?><option value="<?=$type['type'];?>"><?=CMS::t($type['translate_key'])?></option><?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="popupFormInputsBlock">
                <label for="selectType" class="form-label"><?=CMS::t('filter_publication_visibility');?></label>
                <select name="filter[visibility]" id="selectType" class="form-control" form="formSearchAndFilter">
                    <option value=""><?=CMS::t('filter_no_matter');?></option>
                    <option value="visible"><?=CMS::t('filter_visible')?></option>
                    <option value="hidden"><?=CMS::t('filter_hidden')?></option>
                </select>
            </div>

        </div>

        <div class="popupControls">
            <button type="submit" name="go" value="1" form="formSearchAndFilter" class="btn btn-primary center-block"><i class="fa fa-filter" aria-hidden="true"></i> <?=CMS::t('filter');?></button>
        </div>
    </div>
</div>