<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>

	<body class="hold-transition password_recovery">
		<div class="password_recovery-wrapper">
			<div class="password_recovery-logo">
				<?=CMS::$site_settings['cms_name_formatted'];?>
			</div>

			<?php if (isset($_POST['recover']) && !empty($response['errors'])) foreach ($response['errors'] as $e) { ?>
			<div class="callout callout-danger">
				<!-- <h4></h4> -->
				<p><?=CMS::t($e);?></p>
			</div>
			<?php } ?>

			<?php if (isset($_POST['recover']) && $response['success']) { ?>
			<div class="callout callout-success">
				<!-- <h4></h4> -->
				<p><?=CMS::t('password_recovery_suc_email_sended', [
					'{email}' => utils::safeEcho($_POST['email'], 1)
				]);?></p>
			</div>
			<?php } ?>

			<div class="password_recovery-title"><?=CMS::t('password_recovery_title');?></div>

			<div class="password_recovery-item">
				<div class="password_recovery-image">
					<img src="<?=IMAGE_DIR;?>lost_password.jpg" alt="" />
				</div>

				<form method="post" action="" class="password_recovery-credentials">
					<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

					<div class="input-group">
						<input type="email" name="email" value="<?=utils::safeEcho(@$_POST['email'], 1);?>" placeholder="<?=CMS::t('password_recovery_email_placeholder');?>" class="form-control" />

						<div class="input-group-btn">
							<button type="submit" name="recover" value="1" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
						</div>
					</div>
				</form>
			</div>

			<div class="help-block text-center">
				<?=CMS::t('password_recovery_form_tip');?>
			</div>

			<div class="text-center">
				<a href="<?=SITE.CMS_DIR;?>">
					<?=CMS::t('password_recovery_login');?>
				</a>
			</div>
		</div>
	</body>
