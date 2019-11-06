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
<form action="?controller=news&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
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
                        <th><?=CMS::t('news_is_hidden');?></th>
                        <th><?=CMS::t('news_date');?></th>
                        <th><?=CMS::t('image');?></th>
                        <th><?=CMS::t('controls');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($news as $n) {
                        ?>
                        <tr data-id="<?=$n['id'];?>">
                            <td>
                                <?=($n['title']);?>
                            </td>
                            <td>
                                <a href="?controller=news&amp;action=ajax_set_status" title="" class="ajax-set-status btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
                                    'CSRF_token' => $CSRF_token,
                                    'id' => $n['id'],
                                    'turn' => ($n['is_hidden']? 'on': 'off')
                                ]), 1);?>">
                                    <i class="fa fa-toggle-<?=($n['is_hidden']? 'off': 'on');?> btn-toggle-<?=($n['is_hidden']? 'off': 'on');?>"  aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                               <?=utils::formatMySQLDate('d.m.Y H:i:s', $n['created_at']);?>
                            </td>
                            <td>
                                <a href="?controller=news&action=images&id=<?=$n['id']?>"><i class="fa fa-image"></i></a>
                            </td>
                            <td style="white-space: nowrap;">
                                <?php if (CMS::hasAccessTo('news/edit', 'write')) { ?>
                                    <a href="?controller=news&amp;action=edit&amp;id=<?=$a['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('edit');?>">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                <?php } else if (CMS::hasAccessTo('news/edit', 'read')) { ?>
                                    <a href="?controller=news&amp;action=edit&amp;id=<?=$a['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>

                                <?php if (CMS::hasAccessTo('news/delete', 'write')) { ?>
                                    <a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="aDeleteItem_<?=$n['id'];?>" data-item-id="<?=$n['id'];?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    <script type="text/javascript">
                                        $('#aDeleteItem_<?=$n['id'];?>').on('click', function() {
                                            bootbox.confirm({
                                                message: '<?=CMS::t('delete_confirmation');?>',
                                                callback: function(ok) {
                                                    if (ok) {
                                                        var $form = $('#formDeleteItem');
                                                        $('[name="delete"]', $form).val('<?=$n['id'];?>');
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
