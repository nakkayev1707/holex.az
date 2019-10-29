<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>


<style>
td {
	vertical-align: middle !important;
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
<form action="?controller=cms_users&amp;action=delete" method="post" id="formDeleteItem">
	<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
	<input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_cms_users_list');?>
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
		<?php if (CMS::hasAccessTo('cms_users/add', 'write')) { ?>
		<a href="?controller=cms_users&amp;action=add&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('menu_item_cms_users_add');?></a>
		<?php } ?>
	</nav>
</section>

<!-- Main content -->
<section class="content">

	<!-- Info boxes -->

	<!-- <pre><?php /*var_export($users);*/ ?></pre> -->

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=CMS::t('cms_users_list_details', [
				'{count}' => $count,
				'{ru:u1}' => utils::getRussianWordEndingByNumber($count, '', 'ы', 'о'),
				'{ru:u2}' => utils::getRussianWordEndingByNumber($count, 'ь', 'я', 'ей')
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
						<input type="text" name="q" value="<?=utils::safeEcho(@$_GET['q'], 1);?>" placeholder="<?=CMS::t('cms_users_search');?>" class="form-control input-md" onfocus="this.value='';" />
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
				if (!empty($users) && is_array($users)) {
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?=CMS::t('cms_user_login');?></th>
						<th><?=CMS::t('cms_user_name');?></th>
						<th><?=CMS::t('cms_user_role');?></th>
						<th><?=CMS::t('cms_user_reg_date');?></th>
						<th><?=CMS::t('access');?></th>
						<th><?=CMS::t('controls');?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($users as $user) {
					?>
					<tr>
						<td>
							<?php if (empty($user['avatar'])) { ?>
							<?=view::gravatar($user['login'], 40, ['class' => 'userpic img-circle img-bordered-sm']);?>
							<?php } else { ?>
							<img src="<?=utils::safeEcho($avatarDirUrl.$user['avatar'], 1);?>" alt="" class="userpic img-circle img-bordered-sm" />
							<?php } ?>
							<?=(($user['id']==$_SESSION[CMS::$sess_hash]['ses_adm_id'])? ('<strong>'.utils::safeEcho($user['login'], 1).'</strong>'): utils::safeEcho($user['login'], 1));?>
						</td>
						<td>
							<a href="?controller=cms_users&amp;action=edit&amp;id=<?=$user['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="">
								<?=(($user['id']==$_SESSION[CMS::$sess_hash]['ses_adm_id'])? ('<strong>'.utils::safeEcho($user['name'], 1).'</strong>'): utils::safeEcho($user['name'], 1));?>
							</a>
						</td>
						<td>
							<?=CMS::t('cms_users_role_'.$user['role']);?>
						</td>
						<td>
							<time datetime="<?=utils::formatMySQLDate('c', $user['reg_date']);?>" title="<?=$user['reg_date'];?>"><?=utils::formatMySQLDate('d.m.Y H:i', $user['reg_date']);?></time>
						</td>
						<td>
							<?php if (CMS::hasAccessTo('cms_users/ajax_set_ban', 'write') && ($user['id']!='1')) { ?>
								<a href="?controller=cms_users&amp;action=ajax_set_ban" title="" class="aAjax btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
									'CSRF_token' => $CSRF_token,
									'user_id' => $user['id'],
									'turn' => ($user['is_blocked']? 'on': 'off')
								]), 1);?>"><i class="fa fa-toggle-<?=($user['is_blocked']? 'off': 'on');?> btn-toggle-<?=($user['is_blocked']? 'off': 'on');?>" aria-hidden="true"></i></a>
							<?php } else { ?>
								<i class="fa fa-toggle-<?=($user['is_blocked']? 'off': 'on');?> btn-toggle-disabled" aria-hidden="true"></i>
							<?php } ?>
						</td>
						<td>
							<?php if (CMS::hasAccessTo('cms_users/edit', 'write')) { ?>
							<a href="?controller=cms_users&amp;action=edit&amp;id=<?=$user['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('edit');?>">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<?php } else if (CMS::hasAccessTo('cms_users/edit', 'read')) { ?>
							<a href="?controller=cms_users&amp;action=edit&amp;id=<?=$user['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							<?php } ?>

							<!-- <?php if ($user['role']=='editor') { ?>
							<a href="?controller=cms_users&amp;action=manage_categories&amp;id=<?=$user['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('menu_item_edit_admin_user_cats');?>">
								<i class="fa fa-folder-o" aria-hidden="true"></i>
							</a>
							<?php } ?> -->

							<!-- <?php if (($user['id']!=1) && CMS::hasAccessTo('cms_users/manage_privilegies')) { ?>
							<a href="?controller=cms_users&amp;action=manage_privilegies&amp;id=<?=$user['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('menu_item_edit_admin_user_privilegies');?>">
								<i class="fa fa-key" aria-hidden="true"></i>
							</a>
							<?php } ?> -->

							<?php if (CMS::hasAccessTo('cms_users/delete', 'write') && ($user['id']!=1)) { ?>
							<a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="aDeleteItem_<?=$user['id'];?>" data-item-id="<?=$user['id'];?>">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
							<script type="text/javascript">
								$('#aDeleteItem_<?=$user['id'];?>').on('click', function() {
									bootbox.confirm({
										message: '<?=CMS::t('delete_confirmation_user');?>',
										callback: function(ok) {
											if (ok) {
												var $form = $('#formDeleteItem');
												$('[name="delete"]', $form).val('<?=$user['id'];?>');
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
				<label for="selectRole" class="form-label"><?=CMS::t('cms_user_role');?></label>
				<select name="filter[role]" id="selectRole" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<?php
					foreach (CMS::$roles as $role=>$allowed_pages) {
					?><option value="<?=$role;?>"<?=(($role==@$_GET['filter']['role'])? ' selected="selected"': '');?>><?=CMS::t($role);?></option><?php
					}
					?>
				</select>
			</div>

			<div class="popupFormInputsBlock">
				<label for="selectStatus" class="form-label"><?=CMS::t('access');?></label>
				<select name="filter[is_blocked]" id="selectStatus" class="form-control" form="formSearchAndFilter">
					<option value=""><?=CMS::t('filter_no_matter');?></option>
					<option value="1"<?=((@$_GET['filter']['is_blocked']=='1')? ' selected="selected"': '');?>><?=CMS::t('access_prohibited');?></option>
					<option value="0"<?=((@$_GET['filter']['is_blocked']==='0')? ' selected="selected"': '');?>><?=CMS::t('access_granted');?></option>
				</select>
			</div>
		</div>

		<div class="popupControls">
			<button type="submit" name="go" value="1" form="formSearchAndFilter" class="btn btn-primary center-block"><i class="fa fa-filter" aria-hidden="true"></i> <?=CMS::t('filter');?></button>
		</div>
	</div>
</div>