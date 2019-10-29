<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

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

	$('.aAjax').on('click', function() {
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
						var old_status = ((new_status=='on')? 'off': 'on');
						$('i', $el).removeClass('fa-toggle-'+old_status+' btn-toggle-'+old_status).addClass('fa-toggle-'+new_status+' btn-toggle-'+new_status);
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
<form action="?controller=gallery&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
	<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
	<input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_gallery_list');?>
		<!-- <small>Subtitile</small> -->
	</h1>

	<?=view::widget('breadcrumb', [
		'links' => [
			[
				'title' => CMS::t('main_page'),
				'icon' => 'dashboard',
				'href' => '?controller=statistics&action=dashboard'
			],
			[
				'title' => CMS::t('menu_item_gallery_list')
			]
		]
	]);?>
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
	<nav>
		<?php if (CMS::hasAccessTo('gallery/add', 'write')) { ?>
		<a href="?controller=gallery&amp;action=add&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('menu_item_gallery_add');?></a>
		<?php } ?>
	</nav>
</section>

<!-- Main content -->
<section class="content">

	<!-- Info boxes -->

	<!-- <pre><?php /*var_export($users);*/ ?></pre> -->

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=CMS::t('gallery_list_details', [
				'{count}' => $count,
				'{ru:u1}' => utils::getRussianWordEndingByNumber($count, 'я', 'и', 'й'),
				'{ru:u2}' => utils::getRussianWordEndingByNumber($count, 'а', 'ы', 'о')
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
				if (!empty($galleries) && is_array($galleries)) {
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?=CMS::t('gallery_album_name');?></th>
						<th><?=CMS::t('article_author');?></th>
						<th><?=CMS::t('gallery_photos_num');?></th>
						<th><?=CMS::t('status');?></th>
						<th><?=CMS::t('controls');?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($galleries as $gal) {
					?>
					<tr>
						<td>
							<?php if (CMS::hasAccessTo('gallery/edit')) {
							?><a href="?controller=gallery&amp;action=edit&amp;id=<?=$gal['id'];?>&amp;return=<?=$link_return;?>"><?php
							}

							utils::safeEcho($gal['name']);

							if (CMS::hasAccessTo('cms_users/edit')) {
							?></a><?php
							} ?>
						</td>
						<td>
							<?php if (CMS::hasAccessTo('cms_users/edit')) {
							?><a href="?controller=cms_users&amp;action=edit&amp;id=<?=$gal['add_by'];?>"><i class="fa fa-user" aria-hidden="true"></i> <?php
							}

							utils::safeEcho($gal['author_name']);

							if (CMS::hasAccessTo('cms_users/edit')) {
							?></a><?php
							} ?>, <?=utils::formatMySQLDate('d.m.Y H:i:s', $gal['add_datetime']);?>
						</td>
						<td><?=$gal['photos_num'];?></td>
						<td>
							<?php if (CMS::hasAccessTo('gallery/ajax_set_status', 'write')) { ?>
							<a href="?controller=gallery&amp;action=ajax_set_status" title="" class="aAjax btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
								'CSRF_token' => $CSRF_token,
								'id' => $gal['id'],
								'turn' => ($gal['is_published']? 'off': 'on')
							]), 1);?>"><i class="fa fa-toggle-<?=($gal['is_published']? 'on': 'off');?> btn-toggle-<?=($gal['is_published']? 'on': 'off');?>" aria-hidden="true"></i></a>
							<?php } else { ?>
							<i class="fa fa-toggle-<?=($gal['is_published']? 'on': 'off');?> btn-toggle-disabled" aria-hidden="true"></i>
							<?php } ?>
						</td>
						<td style="white-space: nowrap;">
							<?php if (CMS::hasAccessTo('gallery/edit', 'write')) { ?>
							<a href="?controller=gallery&amp;action=edit&amp;id=<?=$gal['id'];?>&amp;return=<?=$link_return;?>" title="<?=CMS::t('edit');?>">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<?php } else if (CMS::hasAccessTo('gallery/edit', 'read')) { ?>
							<a href="?controller=gallery&amp;action=edit&amp;id=<?=$gal['id'];?>&amp;return=<?=$link_return;?>" title="<?=CMS::t('view');?>">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							<?php } ?>

							<?php if (CMS::hasAccessTo('gallery/photos')) { ?>
							<a href="?controller=gallery&amp;action=photos&amp;gallery_id=<?=$gal['id'];?>&amp;return=<?=$link_return;?>" title="<?=CMS::t('gallery_photos_list');?>">
								<i class="fa fa-image" aria-hidden="true"></i>
							</a>
							<?php } ?>

							<?php if (CMS::hasAccessTo('gallery/delete', 'write')) { ?>
							<a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="aDeleteItem_<?=$gal['id'];?>" data-item-id="<?=$gal['id'];?>">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
							<script type="text/javascript">
								$('#aDeleteItem_<?=$gal['id'];?>').on('click', function() {
									bootbox.confirm({
										message: '<?=CMS::t('delete_confirmation');?>',
										callback: function(ok) {
											if (ok) {
												var $form = $('#formDeleteItem');
												$('[name="delete"]', $form).val('<?=$gal['id'];?>');
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
				<label for="selectStatus" class="form-label"><?=CMS::t('status');?></label>

				<select name="filter[status]" id="selectStatus" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<option value="1"<?=((@$_GET['filter']['status']=='1')? ' selected="selected"': '');?>><?=CMS::t('publish_on');?></option>
					<option value="0"<?=((@$_GET['filter']['status']==='0')? ' selected="selected"': '');?>><?=CMS::t('publish_off');?></option>
				</select>
			</div>

			<div class="popupFormInputsBlock">
				<label for="selectAuthor" class="form-label"><?=CMS::t('author');?></label>

				<select name="filter[author]" id="selectAuthor" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<?php
					if (!empty($authors) && is_array($authors)) {
						foreach ($authors as $user) {
					?><option value="<?=$user['id'];?>"<?=((@$_GET['filter']['author']==$user['id'])? ' selected="selected"': '');?>><?=$user['name'];?> (<?=CMS::t($user['role']);?>)</option><?php
						}
					}
					?>
				</select>
			</div>

			<!-- <div class="popupFormInputsBlock">
				<label for="selectStatus" class="form-label"><?=CMS::t('access');?></label>

				<select name="filter[is_blocked]" id="selectStatus" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<option value="1"<?=((@$_GET['filter']['is_blocked']=='1')? ' selected="selected"': '');?>><?=CMS::t('access_prohibited');?></option>
					<option value="0"<?=((@$_GET['filter']['is_blocked']==='0')? ' selected="selected"': '');?>><?=CMS::t('access_granted');?></option>
				</select>
			</div>

			<div class="popupFormInputsBlock">
				<label for="selectProvider" class="form-label"><?=CMS::t('site_users_provider');?></label>

				<select name="filter[provider]" id="selectProvider" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<option value="none"<?=((@$_GET['filter']['provider']=='none')? ' selected="selected"': '');?>><?=CMS::t('site_users_provider_none');?></option>
					<?php
						if (!empty($providers) && is_array($providers)) foreach ($providers as $p) {
					?><option value="<?=$p;?>"<?=((@$_GET['filter']['provider']==$p)? ' selected="selected"': '');?>><?=$p;?></option><?php
						}
					?>
				</select>
			</div>

			<div class="popupFormInputsBlock" style="height: 60px;">
				<label class="form-label"><?=CMS::t('site_user_reg_date');?></label>

				<div class="clear"></div>

				<div class="input-group" style="width: 192px; float: left;">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input type="text" name="filter[reg_since]" value="<?=utils::safeEcho(@$_GET['filter']['reg_since'], 1);?>" placeholder="<?=CMS::t('site_user_reg_date_since');?>" class="form-control pull-right addon-datepicker-input" style="width: 152px;" id="inputRegSince" form="formSearchAndFilter" />
                </div>

				<img src="<?=IMAGE_DIR;?>interval_grey.png" alt="&mdash;" style="width: 31px; float: left; margin: 12px 3px 0 2px;" />

				<div class="input-group" style="width: 192px; float: left;">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input type="text" name="filter[reg_till]" value="<?=utils::safeEcho(@$_GET['filter']['reg_till'], 1);?>" placeholder="<?=CMS::t('site_user_reg_date_till');?>" class="form-control pull-right addon-datepicker-input" style="width: 152px;" id="inputRegTill" form="formSearchAndFilter" />
                </div>

				<div class="clear"></div>

				<script type="text/javascript">
// <![CDATA[
$('.addon-datepicker-input').each(function() {
    $(this).datepicker({
		format: 'dd.mm.yyyy',
		clearBtn: true
	});
});
// ]]>
				</script>
			</div> -->
		</div>

		<div class="popupControls">
			<button type="submit" name="go" value="1" form="formSearchAndFilter" class="btn btn-primary center-block"><i class="fa fa-filter" aria-hidden="true"></i> <?=CMS::t('filter');?></button>
		</div>
	</div>
</div>