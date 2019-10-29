<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined('_VALID_PHP')) {die('Direct access to this location is not allowed.');}

?>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_comments_edit');?> &ldquo;<?=utils::safeEcho(utils::limitStringLength($comment['text'], 24), 1);?>&rdquo;
		<small><?=utils::safeEcho(utils::limitStringLength($user['first_name'].' '.$user['last_name'], 24), 1);?></small>
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

		<?php if (CMS::hasAccessTo('site_users/view_info')) { ?>
		<a href="?controller=site_users&amp;action=view_info&amp;id=<?=$user['id'];?>" class="btn btn-default"><i class="fa fa-address-card" aria-hidden="true"></i> <?=utils::safeEcho($user['first_name'].' '.$user['last_name'], 1);?></a>
		<?php } ?>

		<?php if (!empty($content['id']) && CMS::hasAccessTo($content['item_page'])) { ?>
		<a href="<?=utils::safeEcho($content['item_link'], 1);?>" class="btn btn-default"><i class="fa fa-info-circle" aria-hidden="true"></i> &ldquo;<?=utils::safeEcho(utils::limitStringLength($content['title'], 24), 1);?>&rdquo;</a>
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

	<div class="box box-success divContentQuote">
		<div class="box-header with-border">
			<h3 class="box-title"><?=utils::safeEcho($content['title'], 1);?></h3>
		</div>
		<!-- /.box-header -->

		<div class="box-body">
			<p><?=utils::safeEcho($content['text'], 1);?></p>
		</div>
		<!-- /.box-body -->
	</div>

	<div class="box box-primary">
		<form action="" method="post" class="form-std" autocomplete="off" role="form">
			<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?=CMS::t('comment_text');?></label>
							<textarea name="text" rows="4" cols="32" class="form-control"><?=utils::safePostValue('text', $comment['text'], 1);?></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" name="save" value="1" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> <?=CMS::t('save');?></button>
				<button type="submit" name="apply" value="1" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> <?=CMS::t('apply');?></button>
				<button type="reset" name="reset" value="1" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
				<button type="submit" name="is_published" value="<?=($comment['is_published']? '0': '1');?>" class="btn btn-<?=($comment['is_published']? 'danger': 'success');?>"><i class="fa fa-thumbs-<?=($comment['is_published']? 'down': 'up');?>" aria-hidden="true"></i> <?=CMS::t('comments_moderate_'.($comment['is_published']? 'deny': 'allow'));?></button>
			</div>
		</form>
	</div>
	<!-- /.box -->

	<!-- /.info boxes -->
</section>
<!-- /.content -->