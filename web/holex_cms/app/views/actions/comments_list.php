<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>


<?php

// load resourses

// load datepicker
view::appendCss(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/css/bootstrap-datepicker3.css');
view::appendJs(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/js/bootstrap-datepicker.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'bootstrap-datepicker/locales/bootstrap-datepicker.'.$_SESSION[CMS::$sess_hash]['ses_adm_lang'].'.min.js');

?>


<style>
td {
	vertical-align: middle !important;
}
.provider-link {
	font-size: 14px;
}
.provider-link .fa {
	font-size: 14px;
}
.provider {
	vertical-align: baseline; height: 13px;
}
.addon-datepicker-input {
	position: relative; z-index: 100000 !important;
}
</style>


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
<form action="?controller=comments&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
	<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
	<input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_comments_list');?>
		<small>
			<?=(empty($content['id'])? '': (utils::safeEcho(utils::limitStringLength($content['title'], 36), 1)));?>
			<?=(empty($user['id'])? '': (utils::safeEcho($user['first_name'].' '.$user['last_name'], 1)));?>
		</small>
	</h1>

	<!-- <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol> -->
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
	<nav>
		<?php if (!empty($user['id']) && CMS::hasAccessTo('site_users/view_info')) { ?>
		<a href="?controller=site_users&amp;action=view_info&amp;id=<?=$user['id'];?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-address-card" aria-hidden="true"></i> <?=CMS::t('menu_item_site_users_view_info');?></a>
		<?php } ?>

		<?php if (!empty($content['id']) && CMS::hasAccessTo($content['item_page'])) { ?>
		<a href="<?=utils::safeEcho($content['item_link'], 1);?>" class="btn btn-default"><i class="fa fa-info-circle" aria-hidden="true"></i> &ldquo;<?=utils::safeEcho(utils::limitStringLength($content['title'], 24), 1);?>&rdquo;</a>
		<?php } ?>
	</nav>
</section>

<!-- Main content -->
<section class="content">

	<!-- Info boxes -->

	<!-- <pre><?php /*var_export($users);*/ ?></pre> -->

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=CMS::t('comments_list_details', [
				'{count}' => $count,
				'{ru:u1}' => utils::getRussianWordEndingByNumber($count, '', 'ы', 'о'),
				'{ru:u2}' => utils::getRussianWordEndingByNumber($count, 'й', 'я', 'ев')
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
				if (!empty($comments) && is_array($comments)) {
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="width: 18px;"></th>
						<th><?=CMS::t('comments_preambula');?></th>
						<th><?=CMS::t('comments_user');?></th>
						<th><?=CMS::t('comments_posted_datetime');?></th>
						<th><?=CMS::t('comments_is_published');?></th>
						<th><?=CMS::t('controls');?></th>
					</tr>
				</thead>
				<tbody>
					<?php
							foreach ($comments as $c) {
					?>
						<tr>
							<td>
								<?php if (CMS::hasAccessTo('comments/edit')) { ?>
								<a href="?controller=comments&amp;action=edit&amp;id=<?=$c['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>">
								<?php } ?>
								<i class="fa fa-envelope<?=($c['is_inspected']? '-open': '');?>" aria-hidden="true"></i>
								<?php if (CMS::hasAccessTo('comments/edit')) { ?>
								</a>
								<?php } ?>
							</td>
							<td>
								<?php if (!$c['is_inspected']) { ?>
								<strong>
								<?php } ?>
								<?php if (CMS::hasAccessTo('comments/edit')) { ?>
								<a href="?controller=comments&amp;action=edit&amp;id=<?=$c['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>">
								<?php } ?>
								<?=nl2br(utils::safeEcho($c['text'], 1));?>
								<?php if (CMS::hasAccessTo('comments/edit')) { ?>
								</a>
								<?php } ?>
								<?php if (!$c['is_inspected']) { ?>
								</strong>
								<?php } ?>
							</td>
							<td>
								<a href="?controller=site_users&amp;action=view_info&amp;id=<?=$c['user_id'];?>">
									<i class="fa fa-address-card" aria-hidden="true"></i>
									<?=utils::safeEcho($c['first_name'].' '.$c['last_name'], 1);?>
								</a>
							</td>
							<td>
								<?=utils::formatMySQLDate('d.m.Y H:i:s', $c['add_datetime']);?>
							</td>
							<td>
								<?php if (CMS::hasAccessTo('comments/ajax_set_status', 'write')) { ?>
									<a href="?controller=comments&amp;action=ajax_set_status" title="" class="aAjax btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
										'CSRF_token' => $CSRF_token,
										'comment_id' => $c['id'],
										'turn' => ($c['is_published']? 'off': 'on')
									]), 1);?>"><i class="fa fa-toggle-<?=($c['is_published']? 'on': 'off');?> btn-toggle-<?=($c['is_published']? 'on': 'off');?>" aria-hidden="true"></i></a>
								<?php } else { ?>
									<i class="fa fa-toggle-<?=($c['is_published']? 'on': 'off');?> btn-toggle-disabled" aria-hidden="true"></i>
								<?php } ?>
							</td>
							<td>
								<?php if (CMS::hasAccessTo('comments/edit', 'write')) { ?>
								<a href="?controller=comments&amp;action=edit&amp;id=<?=$c['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('edit');?>">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<?php } else if (CMS::hasAccessTo('comments/edit', 'read')) { ?>
								<a href="?controller=comments&amp;action=edit&amp;id=<?=$c['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<?php } ?>

								<?php if (CMS::hasAccessTo('comments/delete', 'write')) { ?>
								<a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="aDeleteItem_<?=$c['id'];?>" data-item-id="<?=$c['id'];?>">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
								<script type="text/javascript">
									utils.setConfirmation('click', '#aDeleteItem_<?=$c['id'];?>', '<?=CMS::t('delete_confirmation');?>', function($el) {
										var id = $el.attr('data-item-id');
										var $form = $('#formDeleteItem');
										$('[name="delete"]', $form).val(id);
										$form.submit();
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
				<label for="selectStatus" class="form-label"><?=CMS::t('comments_is_published');?></label>

				<select name="filter[is_published]" id="selectStatus" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<option value="1"<?=((@$_GET['filter']['is_published']=='1')? ' selected="selected"': '');?>><?=CMS::t('publish_on');?></option>
					<option value="0"<?=((@$_GET['filter']['is_published']==='0')? ' selected="selected"': '');?>><?=CMS::t('publish_off');?></option>
				</select>
			</div>

			<div class="popupFormInputsBlock">
				<label for="selectIsInspected" class="form-label"><?=CMS::t('comments_is_inspected');?></label>

				<select name="filter[is_inspected]" id="selectIsInspected" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<option value="1"<?=((@$_GET['filter']['is_inspected']=='1')? ' selected="selected"': '');?>><?=CMS::t('comment_inspected');?></option>
					<option value="0"<?=((@$_GET['filter']['is_inspected']==='0')? ' selected="selected"': '');?>><?=CMS::t('comment_not_inspected');?></option>
				</select>
			</div>

			<div class="popupFormInputsBlock" style="height: 60px;">
				<label class="form-label"><?=CMS::t('comments_posted_datetime');?></label>

				<div class="clear"></div>

				<div class="input-group" style="width: 192px; float: left;">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input type="text" name="filter[add_since]" value="<?=utils::safeEcho(@$_GET['filter']['add_since'], 1);?>" placeholder="<?=CMS::t('comments_posted_datetime_since');?>" class="form-control pull-right addon-datepicker-input" style="width: 152px;" id="inputAddSince" form="formSearchAndFilter" />
                </div>

				<img src="<?=IMAGE_DIR;?>interval_grey.png" alt="&mdash;" style="width: 31px; float: left; margin: 12px 3px 0 2px;" />

				<div class="input-group" style="width: 192px; float: left;">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input type="text" name="filter[add_till]" value="<?=utils::safeEcho(@$_GET['filter']['add_till'], 1);?>" placeholder="<?=CMS::t('comments_posted_datetime_till');?>" class="form-control pull-right addon-datepicker-input" style="width: 152px;" id="inputAddTill" form="formSearchAndFilter" />
                </div>

				<div class="clear"></div>

				<script type="text/javascript">
// <![CDATA[
$('.addon-datepicker-input').each(function() {
    $(this).datepicker({
		format: 'dd.mm.yyyy',
		clearBtn: true,
		language: '<?=utils::safeJsEcho($_SESSION[CMS::$sess_hash]['ses_adm_lang'], 1);?>'
	});
});
// ]]>
				</script>
			</div>
		</div>

		<div class="popupControls">
			<button type="submit" name="go" value="1" form="formSearchAndFilter" class="btn btn-primary center-block"><i class="fa fa-filter" aria-hidden="true"></i> <?=CMS::t('filter');?></button>
		</div>
	</div>
</div>