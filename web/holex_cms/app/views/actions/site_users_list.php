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
	<form action="?controller=users&amp;action=delete" method="post" id="formDeleteItem">
		<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
		<input type="hidden" name="delete" value="0" />
	</form>


	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?=CMS::t('menu_item_site_users_list');?>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?=CMS::t('site_users_list_details', [
					'{count}' => $count,
					'{ru:u1}' => utils::getRussianWordEndingByNumber($count, '', 'ы', 'о'),
					'{ru:u2}' => utils::getRussianWordEndingByNumber($count, 'ь', 'я', 'ей')
				]);?></h3>

				<div class="box-tools pull-right col-sm-5 col-lg-6">
					<form action="" method="get" id="formSearchAndFilter">
						<input type="hidden" name="controller" value="<?=utils::safeEcho(@$_GET['controller'], 1);?>" />
						<input type="hidden" name="action" value="<?=utils::safeEcho(@$_GET['action'], 1);?>" />
						<input type="hidden" name="<?=time();?>" value="" />

<!--						<div class="input-group has-feedback">-->
<!--							<div class="input-group-btn">-->
<!--								<button type="button" class="btn btn---><?//=(utils::isEmptyArrayRecursive(@$_GET['filter'])? 'success': 'warning');?><!--" id="filter-button"><i class="fa fa-filter" aria-hidden="true"></i> --><?//=CMS::t('filter');?><!--</button>-->
<!--							</div>-->
<!--							<input type="text" name="q" value="--><?//=utils::safeEcho(@$_GET['q'], 1);?><!--" placeholder="--><?//=CMS::t('cms_users_search');?><!--" class="form-control input-md" onfocus="this.value='';" />-->
<!--							<span class="input-group-btn">-->
<!--								<button type="submit" name="go" value="1" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> --><?//=CMS::t('search');?><!--</button>-->
<!--							</span>-->
<!--						</div>-->
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
							<th><?=CMS::t('user_fio');?></th>
							<th><?=CMS::t('user_email');?></th>
							<th><?=CMS::t('user_phone');?></th>
                            <th><?=CMS::t('user_request_date');?></th>
                            <th><?=CMS::t('user_ip');?></th>
                            <th><?=CMS::t('access');?></th>
<!--                            <th>--><?//=CMS::t('user_title');?><!--</th>-->
							<th><?=CMS::t('controls');?></th>
						</tr>
					</thead>
					<tbody>
						<?php
								foreach ($users as $user) {
						?>
							<tr>
								<td>
									<?=view::gravatar($user['fio'], 40, ['class' => 'userpic img-circle img-bordered-sm']);?>
									<?=utils::safeEcho($user['fio'], 1);?>
								</td>
								<td>
                                    <?=utils::safeEcho($user['email'], 1);?>
								</td>
                                <td>
                                    <?=utils::safeEcho($user['phone'], 1);?>
                                </td>
								<td>
									<time datetime="<?=utils::formatMySQLDate('c', $user['request_date']);?>" title="<?=$user['request_date'];?>"><?=utils::formatMySQLDate('d.m.Y H:i', $user['request_date']);?></time>
								</td>
                                <td>
                                    <?=utils::safeEcho($user['ip_address'], 1);?>
                                </td>
                                <td>
                                    <?php if (CMS::hasAccessTo('users/ajax_set_ban', 'write')) { ?>
                                        <a href="?controller=users&amp;action=ajax_set_ban" title="" class="aAjax btn-toggle" data-ajax_post="<?=utils::safeEcho(json_encode([
                                            'CSRF_token' => $CSRF_token,
                                            'user_id' => $user['id'],
                                            'turn' => ($user['is_blocked']? 'on': 'off')
                                        ]), 1);?>"><i class="fa fa-toggle-<?=($user['is_blocked']? 'off': 'on');?> btn-toggle-<?=($user['is_blocked']? 'off': 'on');?>" aria-hidden="true"></i></a>
                                    <?php } else { ?>
                                        <i class="fa fa-toggle-<?=($user['is_blocked']? 'off': 'on');?> btn-toggle-disabled" aria-hidden="true"></i>
                                    <?php } ?>
                                </td>
								<td>
									<?php if (CMS::hasAccessTo('users/view_info')) { ?>
									<a href="?controller=users&amp;action=view_info&amp;id=<?=$user['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" title="<?=CMS::t('view');?>">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
									<?php } ?>

									<?php if (CMS::hasAccessTo('users/delete', 'write')) { ?>
									<a href="#" title="<?=CMS::t('delete');?>" class="text-red" style="margin-left: 15px;" id="aDeleteItem_<?=$user['id'];?>" data-item-id="<?=$user['id'];?>">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</a>
									<script type="text/javascript">
										utils.setConfirmation('click', '#aDeleteItem_<?=$user['id'];?>', '<?=CMS::t('delete_confirmation_user');?>', function($el) {
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
			</div>
		</div>

		<div class="popupControls">
			<button type="submit" name="go" value="1" form="formSearchAndFilter" class="btn btn-primary center-block"><i class="fa fa-filter" aria-hidden="true"></i> <?=CMS::t('filter');?></button>
		</div>
	</div>
</div>