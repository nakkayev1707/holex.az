<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>

	<body class="hold-transition password_change">
		<div class="password_change-wrapper">
			<div class="password_change-logo">
				<?=CMS::$site_settings['cms_name_formatted'];?>
			</div>

			<?php if (isset($_POST['change']) && !empty($response['errors'])) foreach ($response['errors'] as $e) { ?>
			<div class="callout callout-danger">
				<!-- <h4></h4> -->
				<p><?=CMS::t($e);?></p>
			</div>
			<?php } ?>

			<?php if (isset($_POST['change']) && $response['success']) { ?>
			<div class="callout callout-success">
				<!-- <h4></h4> -->
				<p><?=CMS::t($response['message']);?></p>
			</div>
			<?php utils::delayedRedirect(SITE.CMS_DIR); ?>
			<?php } ?>

			<div class="password_change-title"><?=CMS::t('password_change_title');?></div>

			<div class="password_change-item">
				<div class="password_change-image">
					<img src="<?=IMAGE_DIR;?>lost_password.jpg" alt="" />
				</div>

				<form method="post" action="" class="password_change-credentials">
					<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

					<div class="input-group">
						<input type="password" name="password" value="" placeholder="<?=CMS::t('password_change_placeholder');?>" class="form-control" />

						<div class="input-group-btn">
							<button type="submit" name="change" value="1" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
