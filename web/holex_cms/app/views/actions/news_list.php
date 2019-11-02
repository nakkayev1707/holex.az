<?php
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}
?>

<?php
view::appendCss(SITE.CMS_DIR.JS_DIR.'jquery-ui-1.12.1/jquery-ui.css');
view::appendJs(SITE.CMS_DIR.JS_DIR.'jquery-ui-1.12.1/jquery-ui.min.js');
?>

<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
        var sortable_is_out = false;
        $('.tablesorter tbody').sortable({
            cursor: 'move',
            //containment: 'parent',
            out: function() {
                //console.log('out');
                sortable_is_out = true;
            },
            over: function() {
                //console.log('over');
                sortable_is_out = false;
            },
            start: function(e, ui) {
                ui.item.attr('data-sort-start-pos', ui.item.index());
            },
            beforeStop: function() {
                //console.log('beforeStop');
                if (sortable_is_out) {
                    $('.tablesorter tbody').sortable('cancel');
                }
            },
            stop: function(e, ui) {
                var from = ui.item.attr('data-sort-start-pos');
                var to = ui.item.index();
                if (from==to) {return;}
                var direction = ((to>from)? 'down': 'up');
                console.log('Dragged '+direction+' from position '+from+' to '+to);
                var start_id = ui.item.attr('data-id');
                var end_pos = (to+((direction=='up')? +1: -1));
                var end_id = $('.tablesorter tbody tr').eq(end_pos).attr('data-id');
                $.ajax({
                    url: '?controller=news&action=ajax_sort',
                    async: false,
                    cache: false,
                    method: 'POST',
                    data: {
                        CSRF_token: '<?=$CSRF_token;?>',
                        start_id: start_id,
                        end_id: end_id
                    },
                    dataType: 'json',
                    success: function(response, status, xhr) {
                        if (response.success) {
                            // reserved
                        } else {
                            $('.tablesorter tbody').sortable('cancel');
                        }
                    },
                    error: function(xhr, err, descr) {
                        $('.tablesorter tbody').sortable('cancel');
                    }
                });
            },
            items: "tr",
            placeholder: '.place-holder',
            scroll: true
        }).disableSelection();

        $('.pagination a.number').droppable({
            tolerance: 'pointer',
            hoverClass: 'page-drop-hover',
            drop: function(event, ui) {
                //console.log(ui.draggable.prop('tagName')+'#'+ui.draggable.attr('data-id'));
                var item_id = ui.draggable.attr('data-id');
                var target_page = $(this).text();
                $.ajax({
                    url: '?<?=utils::safeJsEcho(utils::array2url([
                        'controller' => 'news',
                        'action' => 'ajax_paged_sort',
                        'q' => @$_GET['q'],
                        'filter' => @$_GET['filter']
                    ]), 1);?>',
                    async: false,
                    cache: false,
                    method: 'POST',
                    data: {
                        CSRF_token: '<?=$CSRF_token;?>',
                        item_id: item_id,
                        target_page: target_page
                    },
                    dataType: 'json',
                    success: function(response, status, xhr) {
                        if (response.success) {
                            location.href = location.href;
                        } else {
                            // no action
                        }
                    },
                    error: function(xhr, err, descr) {}
                });
            }
        });
    });
    // ]]>
</script>


<!-- Deleting hidden form -->
<form action="?controller=articles&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
    <input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
    <input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=CMS::t('menu_item_news_list');?>
    </h1>

    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol> -->
</section>


<!-- Content Header (Page header) -->
<section class="contextual-navigation">
    <nav>
        <?php if (CMS::hasAccessTo('news/add', 'write')) { ?>
            <a href="?controller=news&amp;action=add&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('news_add');?></a>
        <?php } ?>
    </nav>
</section>


<!-- Main content -->
<section class="content">

    <!-- Info boxes -->

    <!-- <pre><?php /*var_export($articles);*/ ?></pre> -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?=CMS::t('news_list_details', [
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
            if (!empty($news) && is_array($news)) {
                ?>
                <table class="table table-bordered table-striped tablesorter">
                    <thead>
                    <tr>
                        <th><?=CMS::t('news_title');?></th>
                        <th><?=CMS::t('news_content');?></th>
                        <th><?=CMS::t('news_date');?></th>
                        <th><?=CMS::t('controls');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($news as $n) {
                        ?>
                        <tr data-id="<?=$n['id'];?>" data-ordering="<?=$n['ordering'];?>">
                            <td>
                                <?php if (!empty($n['img'])) {
                                    $uploadUrl = SITE.utils::dirCanonicalPath(CMS_DIR.UPLOADS_DIR);
                                    $previewUrl = $uploadUrl.'articles/square/'.$n['img'];
                                    ?>
                                    <img src="<?=$previewUrl;?>" alt="" class="article-thumb img-circle img-bordered-sm" />
                                <?php } ?>

                                <?=(empty($n['title'])? $n['sef']: $n['title']);?>
                            </td>
                            <td>
                                <?php
                                if (CMS::hasAccessTo('cms_users/edit')) {
                                ?><a href="?controller=cms_users&amp;action=edit&amp;id=<?=$a['add_by'];?>"><i class="fa fa-user" aria-hidden="true"></i> <?php
                                    }

                                    utils::safeEcho($a['author_name']);

                                    if (CMS::hasAccessTo('cms_users/edit')) {
                                    ?></a><?php
                            } ?>, <?=utils::formatMySQLDate('d.m.Y H:i:s', $n['add_datetime']);?>
                            </td>

                            <td style="white-space: nowrap;">
                                <?php if (CMS::hasAccessTo('articles/edit', 'write')) { ?>
                                    <a href="?controller=articles&amp;action=edit&amp;id=<?=$a['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('edit');?>">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                <?php } else if (CMS::hasAccessTo('articles/edit', 'read')) { ?>
                                    <a href="?controller=articles&amp;action=edit&amp;id=<?=$a['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>

                                <?php if ($a['comments_num'] && CMS::hasAccessTo('comments/list')) { ?>
                                    <a href="?controller=comments&amp;action=list&amp;filter[ref_table]=articles&amp;filter[ref_id]=<?=$a['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('menu_item_comments_list');?> (<?=$a['comments_num'];?>)">
                                        <i class="fa fa-comments" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>

                                <?php if (CMS::hasAccessTo('articles/delete', 'write')) { ?>
                                    <a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="aDeleteItem_<?=$a['id'];?>" data-item-id="<?=$a['id'];?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    <script type="text/javascript">
                                        $('#aDeleteItem_<?=$a['id'];?>').on('click', function() {
                                            bootbox.confirm({
                                                message: '<?=CMS::t('delete_confirmation');?>',
                                                callback: function(ok) {
                                                    if (ok) {
                                                        var $form = $('#formDeleteItem');
                                                        $('[name="delete"]', $form).val('<?=$a['id'];?>');
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
