<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>


	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?=CMS::t('menu_item_cms_users_add');?>
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

		<div class="box">
			<!-- <div class="box-header with-border">
				<h3 class="box-title"><?=CMS::t('menu_item_cms_users_add');?></h3>
			</div> -->
			<!-- /.box-header -->

			<form action="" method="post" enctype="multipart/form-data" class="form-std" role="form" id="formUserInfo">
				<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><?=CMS::t('cms_user_login');?> *</label>

								<input type="text" name="login" value="<?=utils::safeEcho(@$_POST['login'], 1);?>" class="form-control" autocomplete="off" />
							</div>

							<div class="form-group">
								<label><?=CMS::t('cms_user_role');?> *</label>

								<select name="role" class="form-control">
									<option value=""><?=CMS::t('cms_user_role_placeholder');?></option>
									<?php
										if (!empty(CMS::$roles) && is_array(CMS::$roles)) foreach (CMS::$roles as $role=>$allowed_pages) {
									?><option value="<?=$role;?>"<?=(($role==@$_POST['role'])? ' selected="selected"': '');?>><?=CMS::t('cms_users_role_'.$role);?></option><?php
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<label><?=CMS::t('cms_user_pwd');?> *</label>

								<div class="input-group">
									<div class="input-group-btn">
										<a class="btn btn-danger" id="btnShowPassword"><i class="fa fa-eye" aria-hidden="true"></i></a>
									</div>

									<input type="password" name="pwd" class="form-control" autocomplete="off" id="inpSetPassword" />

									<div class="input-group-btn">
										<a class="btn btn-success" id="btnGeneratePassword"><i class="fa fa-asterisk" aria-hidden="true"></i> <?=CMS::t('cms_user_pwd_generate');?></a>
									</div>
								</div>

								<script type="text/javascript">
// <![CDATA[
$('#btnGeneratePassword').on('click', function() {
	var pwd = utils.generatePassword();
	bootbox.dialog({
		title: '<?=CMS::t('password_generator');?>',
		message: '<p class="text-center" id="pPwdGenVal" style="font-size: 28px;">'+pwd+'</p><p><label style="font-weight: normal;"><input type="checkbox" name="pwd_gen_approve" value="1" /> <?=CMS::t('password_generator_approve');?></label></p>',
		backdrop: true,
		buttons: {
			cancel: {
				label: '<i class="fa fa-times"></i> <?=CMS::t('password_generator_btn_cancel');?>'
			},
			regenerate: {
				label: '<i class="fa fa-refresh"></i> <?=CMS::t('password_generator_btn_regenerate');?>',
				callback: function () {
					pwd = utils.generatePassword();
					$('#pPwdGenVal').text(pwd);
					return false;
				}
			},
			confirm: {
				className: 'btn-disabled',
				label: '<i class="fa fa-check"></i> <?=CMS::t('password_generator_btn_use');?>',
				callback: function () {
					if ($('[data-bb-handler="confirm"]').hasClass('btn-disabled')) {
						return false;
					} else {
						$('#inpSetPassword').val($('#pPwdGenVal').text());
					}
				}
			}
		},
	});
});

$(document).on('click', '[name="pwd_gen_approve"]', function() {
	if (this.checked) {
		$('[data-bb-handler="confirm"]').attr('class', 'btn btn-primary');
	} else {
		$('[data-bb-handler="confirm"]').attr('class', 'btn btn-disabled');
	}
});

$('#btnShowPassword').on('click', function() {
	var el = $('#inpSetPassword').get(0);
	if (el.type=='password') {
		el.type = 'text';
		$('i', this).removeClass('fa-eye');
		$('i', this).addClass('fa-eye-slash');
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
	} else {
		el.type = 'password';
		$('i', this).removeClass('fa-eye-slash');
		$('i', this).addClass('fa-eye');
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
	}
});
// ]]>
								</script>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label><?=CMS::t('cms_user_name');?> *</label>

								<input type="text" name="name" value="<?=utils::safeEcho(@$_POST['name'], 1);?>" class="form-control" autocomplete="off" />
							</div>

							<div class="form-group">
								<label><?=CMS::t('cms_user_lang');?> *</label>

								<select name="lang" class="form-control">
									<option value=""><?=CMS::t('cms_user_lang_placeholder');?></option>
									<?php
										if (!empty($langs) && is_array($langs)) foreach ($langs as $lng) {
									?><option value="<?=$lng['language_dir'];?>"<?=(($lng['language_dir']==@$_POST['lang'])? ' selected="selected"': '');?>><?=CMS::t($lng['language_dir']);?> (<?=utils::safeEcho($lng['language_name'], 1);?>)</option><?php
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<label><?=CMS::t('cms_user_avatar');?></label>

								<?=view::browse([
									'name' => 'avatar',
									'accept' => 'image/*'
								]);?>
							</div>
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