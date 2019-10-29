<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?=CMS::t('menu_item_statistics_dashboard');?>
			<!-- <small>Subtitile</small> -->
		</h1>

		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol> -->
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Info boxes -->

		<div class="row">
			<!-- <div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>150</h3>

						<p>New Orders</p>
					</div>

					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>

					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div> -->

			<!-- <div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>53<sup style="font-size: 20px">%</sup></h3>

						<p>Bounce Rate</p>
					</div>

					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>

					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div> -->

			<!--<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?=$total_members;?></h3>

						<p><?=CMS::t('site_users_has_registered', [
							'{ru:u1}' => utils::getRussianWordEndingByNumber($total_members, 'ь', 'я', 'ей'),
							'{ru:u2}' => utils::getRussianWordEndingByNumber($total_members, 'ся', 'ось', 'ись')
						]);?></p>
					</div>

					<div class="icon">
						<i class="fa fa-user-plus"></i>
					</div>

					<a href="?controller=site_users&amp;action=list" class="small-box-footer"><?=CMS::t('more_info');?> <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div> -->

			<!--<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-orange">
					<div class="inner">
						<h3><?=$total_comments;?></h3>

						<p><?=CMS::t('comments_are_left', [
							'{ru:u1}' => utils::getRussianWordEndingByNumber($total_comments, 'й', 'я', 'ев'),
							'{ru:u2}' => utils::getRussianWordEndingByNumber($total_comments, '', 'о', 'ы')
						]);?></p>
					</div>

					<div class="icon">
						<i class="fa fa-comments"></i>
					</div>

					<a href="?controller=comments&amp;action=list" class="small-box-footer"><?=CMS::t('more_info');?> <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>-->

			<!--<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-blue">
					<div class="inner">
						<h3><?=$total_articles;?></h3>

						<p><?=CMS::t('dashboard_articles_posted', [
							'{ru:u1}' => utils::getRussianWordEndingByNumber($total_articles, 'я', 'и', 'й'),
							'{ru:u2}' => utils::getRussianWordEndingByNumber($total_articles, 'а', 'ы', 'о')
						]);?></p>
					</div>

					<div class="icon">
						<i class="fa fa-files-o"></i>
					</div>

					<a href="?controller=articles&amp;action=list" class="small-box-footer"><?=CMS::t('more_info');?> <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>-->

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?=$total_cms_users;?></h3>

						<p><?=CMS::t('dashboard_cms_users_count', [
							'{ru:u1}' => utils::getRussianWordEndingByNumber($total_articles, 'ь', 'я', 'ей')
						]);?></p>
					</div>

					<div class="icon">
						<i class="fa fa-user-secret"></i>
					</div>

					<a href="?controller=cms_users&amp;action=list" class="small-box-footer"><?=CMS::t('more_info');?> <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>

		<div class="row">
			<?php
				if (!empty($latest_registered_users) && is_array($latest_registered_users)) {
			?>
			<div class="col-md-6">
				<!-- USERS LIST -->
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><?=CMS::t('dashboard_latest_members');?></h3>

						<div class="box-tools pull-right">
							<span class="label label-danger"><?=CMS::t('dashboard_new_members', [
								'{n}' => $new_members,
								'{ru:u1}' => utils::getRussianWordEndingByNumber($new_members, 'й', 'х', 'х'),
								'{ru:u2}' => utils::getRussianWordEndingByNumber($new_members, 'ь', 'я', 'ей')
							]);?></span>

							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>

					<div class="box-body no-padding">
						<ul class="users-list clearfix">
							<?php
								foreach ($latest_registered_users as $u) {
									?><li>
										<?=view::gravatar($u['email'], 128);?>
										<a class="users-list-name" href="?controller=site_users&amp;action=view_info&amp;id=<?=$u['id'];?>"><?=utils::safeEcho($u['first_name'].' '.$u['last_name'], 1);?></a>
										<span class="users-list-date"><?=utils::formatMySQLDate('d.m.Y', $u['registration_datetime']);?></span>
									</li><?php
								}
							?>
						</ul>
					</div>

					<div class="box-footer text-center">
						<a href="?controller=site_users&amp;action=list" class="uppercase"><?=CMS::t('dashboard_view_all_users');?></a>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>

		<!-- /.info boxes -->
	</section>
	<!-- /.content -->