<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined('_VALID_PHP')) {die('Direct access to this location is not allowed.');}

?>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_gallery_edit');?>
		<small><?=utils::safeEcho(utils::limitStringLength(@$gallery['translates'][CMS::$default_site_lang]['name'], 52), 1);?></small>
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
		<?php if (CMS::hasAccessTo('gallery/photos')) { ?>
		<a href="?controller=gallery&amp;action=photos&amp;gallery_id=<?=$gallery['id'];?>" class="btn btn-default"><i class="fa fa-image" aria-hidden="true"></i> <?=CMS::t('gallery_photos_list');?> (<?=$gallery['photos_num'];?>)</a>
		<?php } ?>
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
			<h3 class="box-title"><?=CMS::t('menu_item_gallery_edit');?></h3>
		</div> -->
		<!-- /.box-header -->

		<form action="" method="post" class="form-std" autocomplete="off" role="form">
			<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<?php foreach ($langs as $lng) { ?>
						<div class="form-group">
							<label><?=CMS::t('gallery_album_name');?> (<?=$lng['language_name'];?>)</label>

							<input type="text" name="name[<?=$lng['language_dir'];?>]" value="<?=utils::safeEcho((isset($_POST['name'][$lng['language_dir']])? $_POST['name'][$lng['language_dir']]: @$gallery['translates'][$lng['language_dir']]['name']), 1);?>" class="form-control" />
						</div>
		
							<?php if ($lng['language_dir']!=CMS::$default_site_lang) { ?>
							<div class="form-group">
								<input type="checkbox" name="is_published_lang[<?=$lng['language_dir'];?>]" value="1"<?=((isset($_POST['is_published_lang'][$lng['language_dir']])? $_POST['is_published_lang'][$lng['language_dir']]: @$gallery['translates'][$lng['language_dir']]['is_published_lang'])? ' checked="checked"': '');?> id="triggerLangStatus_<?=$lng['language_dir'];?>" /><label for="triggerLangStatus_<?=$lng['language_dir'];?>" style="display: inline; font-weight: normal;"> <?=CMS::t('publish_lang');?></label>
							</div>
							<?php } ?>
						<?php } ?>

						<div class="form-group">
							<?php
								$is_published = (isset($_POST['CSRF_token'])? @$_POST['is_published']: $gallery['is_published']);
							?>
							<input type="checkbox" name="is_published" value="1"<?=($is_published? ' checked="checked"': '');?> id="triggerGalleryStatus" /><label for="triggerGalleryStatus" style="display: inline; font-weight: normal;"> <?=CMS::t('publish');?></label>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" name="save" value="1" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> <?=CMS::t('save');?></button>
				<button type="submit" name="apply" value="1" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> <?=CMS::t('apply');?></button>
				<button type="reset" name="reset" value="1" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
			</div>
		</form>
	</div>
	<!-- /.box -->

	<!-- /.info boxes -->
</section>
<!-- /.content -->