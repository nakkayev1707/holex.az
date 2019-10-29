<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined('_VALID_PHP')) {die('Direct access to this location is not allowed.');}

?>


<style>
.provider-link {
	font-size: 14px;
}
.provider-link .fa {
	font-size: 14px;
}
.provider {
	vertical-align: baseline; height: 13px;
}
</style>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_site_users_view_info');?>
		<small><?=utils::safeEcho($user['first_name'].' '.$user['last_name'], 1);?></small>
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

		<?php if (CMS::hasAccessTo('comments/list') && $comments_num) { ?>
		<a href="?controller=comments&amp;action=list&amp;filter[user_id]=<?=$user['id'];?>" class="btn btn-default"><i class="fa fa-commenting" aria-hidden="true"></i> <?=CMS::t('menu_item_comments_list');?> (<?=$comments_num;?>)</a>
		<?php } ?>
	</nav>
</section>


<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-3">

			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<?php if (empty($user['avatar'])) { ?>
					<?=view::gravatar($user['email'], 120, ['class' => 'profile-user-img img-responsive img-circle']);?>
					<?php } else { ?>
					<img src="<?=UPLOADS_DIR;?>avatars/site_users/<?=$user['avatar'];?>" alt="" class="profile-user-img img-responsive img-circle" />
					<?php } ?>

					<h3 class="profile-username text-center"><?=utils::safeEcho($user['first_name'].' '.$user['last_name'], 1);?></h3>

					<!-- <p class="text-muted text-center">Software Engineer</p> -->

					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b><?=CMS::t('site_user_comments_count');?></b>
							<?php if (CMS::hasAccessTo('comments/list') && $comments_num) { ?>
							<a href="?controller=comments&amp;action=list&amp;filter[user_id]=<?=$user['id'];?>" class="pull-right"><?=$comments_num;?></a>
							<?php } else { ?>
							<a class="pull-right"><?=$comments_num;?></a>
							<?php } ?>
						</li>
					</ul>

					<!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box (Profile Image) -->


			<?php if (0) { ?>
			<!-- About Me Box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">About Me</h3>
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<strong><i class="fa fa-book margin-r-5"></i> Education</strong>
					
					<p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>

					<hr />

					<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

					<p class="text-muted">Malibu, California</p>

					<hr />

					<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

					<p>
						<span class="label label-danger">UI Design</span>
						<span class="label label-success">Coding</span>
						<span class="label label-info">Javascript</span>
						<span class="label label-warning">PHP</span>
						<span class="label label-primary">Node.js</span>
					</p>

					<hr />

					<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
			<?php } ?>

		</div>
		<!-- /.col -->


		<div class="col-md-9">

			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#info" data-toggle="tab"><?=CMS::t('site_user_profile_info');?></a></li>
					<!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
					<li><a href="#activity" data-toggle="tab">Activity</a></li> -->
				</ul>

				<div class="tab-content">

					<!-- Info tab -->
					<div class="active tab-pane" id="activity">
						<table class="table table-bordered table-striped">
							<tr>
								<th><?=CMS::t('site_user_name');?></th>
								<td>
									<?php if (!empty($user['provider'])) { ?>
									<a href="<?=$user['profile'];?>" class="provider-link" target="_blank" title="<?=$user['provider'];?>">
										<img src="<?=IMAGE_DIR;?>providers/<?=$user['provider'];?>.png" alt="<?=$user['provider'];?>" class="provider" /> 
									<?php } ?>
									<?=utils::safeEcho($user['first_name'].' '.$user['last_name'], 1);?>
									<?php if (!empty($user['provider'])) { ?>
										<i class="fa fa-external-link" aria-hidden="true"></i>
									</a>
									<?php } ?>
								</td>
							</tr><tr>
								<th><?=CMS::t('site_user_email');?></th>
								<td><a href="mailto:<?=$user['email'];?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?=$user['email'];?></a></td>
							</tr><tr>
								<th><?=CMS::t('site_user_nickname');?></th>
								<td><?=$user['nickname'];?></td>
							</tr><tr>
								<th><?=CMS::t('site_user_birth_date');?></th>
								<td><?=(empty($user['birth_date'])? '': utils::formatMySQLDate('d.m.Y', $user['birth_date']));?></td>
							</tr><tr>
								<th><?=CMS::t('site_user_gender');?></th>
								<td><?=(empty($user['gender'])? '': CMS::t('site_user_gender_'.$user['gender']));?></td>
							</tr><tr>
								<th><?=CMS::t('site_user_registration_datetime');?></th>
								<td><time datetime="<?=utils::formatMySQLDate('c', $user['registration_datetime']);?>" title="<?=$user['registration_datetime'];?>"><?=utils::formatMySQLDate('d.m.Y H:i', $user['registration_datetime']);?></time></td>
							</tr><tr>
								<th><?=CMS::t('site_user_last_login_datetime');?></th>
								<td><time datetime="<?=utils::formatMySQLDate('c', $user['last_login_datetime']);?>" title="<?=$user['last_login_datetime'];?>"><?=utils::formatMySQLDate('d.m.Y H:i', $user['last_login_datetime']);?></time></td>
							</tr><tr>
								<th><?=CMS::t('site_user_comments_count');?></th>
								<td><?=$comments_num;?></td>
							</tr>
						</table>
					</div>
					<!-- /.tab-pane -->


					<?php if (0) { ?>
					<!-- Timeline tab -->
					<div class="tab-pane" id="timeline">
						<ul class="timeline timeline-inverse">
							<!-- timeline time label -->
							<li class="time-label"><span class="bg-red">10 Feb. 2014</span></li>
							<!-- /.timeline-label -->

							<!-- timeline item -->
							<li>
								<i class="fa fa-envelope bg-blue"></i>

								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

									<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

									<div class="timeline-body">
										Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
										weebly ning heekya handango imeem plugg dopplr jibjab, movity
										jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
										quora plaxo ideeli hulu weebly balihoo...
									</div>

									<div class="timeline-footer">
										<a class="btn btn-primary btn-xs">Read more</a>
										<a class="btn btn-danger btn-xs">Delete</a>
									</div>
								</div>
							</li>
							<!-- END timeline item -->

							<!-- timeline item -->
							<li>
								<i class="fa fa-user bg-aqua"></i>

								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

									<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
								</div>
							</li>
							<!-- END timeline item -->

							<!-- timeline item -->
							<li>
								<i class="fa fa-comments bg-yellow"></i>

								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

									<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

									<div class="timeline-body">
										Take me to your leader!
										Switzerland is small and neutral!
										We are more like Germany, ambitious and misunderstood!
									</div>

									<div class="timeline-footer">
										<a class="btn btn-warning btn-flat btn-xs">View comment</a>
									</div>
								</div>
							</li>
							<!-- END timeline item -->

							<!-- timeline time label -->
							<li class="time-label">
								<span class="bg-green">3 Jan. 2014</span>
							</li>
							<!-- /.timeline-label -->

							<!-- timeline item -->
							<li>
								<i class="fa fa-camera bg-purple"></i>

								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

									<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

									<div class="timeline-body">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
									</div>
								</div>
							</li>
							<!-- END timeline item -->

							<li><i class="fa fa-clock-o bg-gray"></i></li>
						</ul>
					</div>
					<!-- /.tab-pane -->
					<?php } ?>


					<?php if (0) { ?>
					<!-- Aktivity tab -->
					<div class="tab-pane" id="activity">
						<!-- Post -->
						<div class="post">
							<div class="user-block">
								<img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image" />

								<span class="username">
									<a href="#">Jonathan Burke Jr.</a>
									<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
								</span>

								<span class="description">Shared publicly - 7:30 PM today</span>
							</div>
							<!-- /.user-block -->

							<p>
								Lorem ipsum represents a long-held tradition for designers,
								typographers and the like. Some people hate it and argue for
								its demise, but others ignore the hate as they create awesome
								tools to help create filler text for everyone from bacon lovers
								to Charlie Sheen fans.
							</p>

							<ul class="list-inline">
								<li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
								<li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
								<li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
							</ul>

							<input class="form-control input-sm" type="text" placeholder="Type a comment" />
						</div>
						<!-- /.post -->
					</div>
					<!-- /.tab-pane -->
					<?php } ?>

				</div>
				<!-- /.tab-content -->

			</div>
			<!-- /.nav-tabs-custom -->

		</div>
		<!-- /.col -->

	</div>
	<!-- /.row -->

</section>
<!-- /.content -->