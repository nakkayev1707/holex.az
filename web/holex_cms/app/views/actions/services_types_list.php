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
    });
</script>


<!-- Deleting hidden form -->
<form action="?controller=services_types&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
    <input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
    <input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=CMS::t('menu_item_services_types_list');?>
    </h1>
</section>


<!-- Content Header (Page header) -->
<section class="contextual-navigation">
    <nav>
        <?php if (CMS::hasAccessTo('services_types/add', 'write')) { ?>
            <a href="?controller=services_types&amp;action=add&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('service_type_add');?></a>
        <?php } ?>
    </nav>
</section>


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?=CMS::t('services_types_list_details', [
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
            if (!empty($servicesTypes) && is_array($servicesTypes)) {
                ?>
                <table class="table table-bordered table-striped tablesorter">
                    <thead>
                    <tr>
                        <th><?=CMS::t('service_type_title');?></th>
                        <th><?=CMS::t('controls');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($servicesTypes as $type) {
                        ?>
                        <tr data-id="<?=$type['id'];?>">
                            <td>
                                <?=($type['title']);?>
                            </td>
                            <td style="white-space: nowrap;">
                                <?php if (CMS::hasAccessTo('services_types/edit', 'write')) { ?>
                                    <a href="?controller=services_types&amp;action=edit&amp;id=<?=$type['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('edit');?>">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                <?php } else if (CMS::hasAccessTo('services_types/edit', 'read')) { ?>
                                    <a href="?controller=services_types&amp;action=edit&amp;id=<?=$type['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>

                                <?php if (CMS::hasAccessTo('services_types/delete', 'write')) { ?>
                                    <a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="stDeleteItem_<?=$type['id'];?>" data-item-id="<?=$type['id'];?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    <script type="text/javascript">
                                        $('#stDeleteItem_<?=$type['id'];?>').on('click', function() {
                                            bootbox.confirm({
                                                message: '<?=CMS::t('delete_confirmation');?>',
                                                callback: function(ok) {
                                                    if (ok) {
                                                        var $form = $('#formDeleteItem');
                                                        $('[name="delete"]', $form).val('<?=$type['id'];?>');
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
