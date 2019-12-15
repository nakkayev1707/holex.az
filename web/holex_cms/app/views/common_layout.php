<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?><!DOCTYPE html>
<html lang="<?=$_SESSION[CMS::$sess_hash]['ses_adm_lang'];?>">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta name="csrf-token" content="<?=utils::safeEcho($CSRF_token, 1);?>" />

		<title><?=utils::safeEcho(CMS::$site_settings['cms_name'], 1);?> - <?=utils::safeEcho(self::$title, 1);?></title>

<?php

view::prependCss(SITE.CMS_DIR.CSS_DIR.'custom-skin.css');
view::prependCss(SITE.CMS_DIR.CSS_DIR.'admin-lte-2.3.7/skins/skin-green.css');
view::prependCss(SITE.CMS_DIR.CSS_DIR.'admin-lte-2.3.7/AdminLTE.css');
view::prependCss(SITE.CMS_DIR.JS_DIR.'select2/css/select2.css');
view::prependCss(SITE.CMS_DIR.CSS_DIR.'font-awesome-4.7.0/font-awesome.css');
view::prependCss(SITE.CMS_DIR.CSS_DIR.'bootstrap-3.3.7/bootstrap.min.css');

view::appendCss(JS_DIR.'fancybox/jquery.fancybox.css');

print view::outputCssList();

?>

		<script type="text/javascript">
// <![CDATA[
var t = <?=json_encode(CMS::$lang);?>;
// ]]>
		</script>

<?php

view::prependJs(SITE.CMS_DIR.JS_DIR.'admin-lte-2.3.7/app.min.js');
view::prependJs(SITE.CMS_DIR.JS_DIR.'jquery.slimscroll.min.js');
view::prependJs(SITE.CMS_DIR.JS_DIR.'fastclick.min.js');
view::prependJs(SITE.CMS_DIR.JS_DIR.'bootstrap-3.3.7/bootstrap.min.js');
view::prependJs(SITE.CMS_DIR.JS_DIR.'jquery-2.2.3.min.js');

view::appendJs(SITE.CMS_DIR.JS_DIR.'bootbox.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'fancybox/jquery.fancybox.pack.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'utils.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'custom-skin.js');

print view::outputJsList();

?>
		<script type="text/javascript">
			bootbox.addLocale('<?=utils::safeJsEcho($_SESSION[CMS::$sess_hash]['ses_adm_lang'], 1);?>', {
				OK: '<?=utils::safeJsEcho(CMS::t('js_ok'), 1);?>',
				CANCEL: '<?=utils::safeJsEcho(CMS::t('js_cancel'), 1);?>',
				CONFIRM: '<?=utils::safeJsEcho(CMS::t('js_confirm'), 1);?>',
			});
			bootbox.setLocale('<?=utils::safeJsEcho($_SESSION[CMS::$sess_hash]['ses_adm_lang'], 1);?>');
			$(document).ready(function() {
				$('.fancybox').fancybox();
			});
		</script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body class="hold-transition sidebar-mini skin-green<?=($_SESSION[CMS::$sess_hash]['ses_adm_is_menu_collapsed']? ' sidebar-collapse': '');?>">
		<div class="wrapper">
			<header class="main-header">

				<!-- Logo -->
				<a href="<?=SITE ?>" target="_blank" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><img src="<?=IMAGE_DIR;?>logo.png" style="height: 24px;" /></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><img src="<?=IMAGE_DIR;?>logo.png" style="height: 20px;" /> <?=CMS::$site_settings['cms_name_formatted'];?></span>
				</a>

				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only"><?=CMS::t('toggle_navigation');?></span>
					</a>

					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<?php /* ?>
							<!-- Messages: style can be found in dropdown.less -->
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-envelope-o"></i>
									<span class="label label-success">4</span>
								</a>

								<ul class="dropdown-menu">
									<li class="header">You have 4 messages</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li><!-- start message -->
												<a href="#">
													<div class="pull-left">
														<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
													</div>

													<h4>
														Support Team
														<small><i class="fa fa-clock-o"></i> 5 mins</small>
													</h4>

													<p>Why not buy a new awesome theme?</p>
												</a>
											</li><!-- end message -->

											<li>
												<a href="#">
													<div class="pull-left">
														<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image" />
													</div>

													<h4>
														AdminLTE Design Team
														<small><i class="fa fa-clock-o"></i> 2 hours</small>
													</h4>

													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>

											<li>
												<a href="#">
													<div class="pull-left">
														<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image" />
													</div>

													<h4>
														Developers
														<small><i class="fa fa-clock-o"></i> Today</small>
													</h4>

													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>

											<li>
												<a href="#">
													<div class="pull-left">
														<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image" />
													</div>

													<h4>
														Sales Department
														<small><i class="fa fa-clock-o"></i> Yesterday</small>
													</h4>

													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>

											<li>
												<a href="#">
													<div class="pull-left">
														<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image" />
													</div>

													<h4>
														Reviewers
														<small><i class="fa fa-clock-o"></i> 2 days</small>
													</h4>

													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>
										</ul>
									</li>

									<li class="footer"><a href="#">See All Messages</a></li>
								</ul>
							</li>
							<?php */ ?>

							<?php /* ?>
							<!-- Notifications: style can be found in dropdown.less -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-bell-o"></i>
									<span class="label label-warning">10</span>
								</a>

								<ul class="dropdown-menu">
									<li class="header">You have 10 notifications</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li>
												<a href="#">
													<i class="fa fa-users text-aqua"></i> 5 new members joined today
												</a>
											</li>

											<li>
												<a href="#">
													<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
												</a>
											</li>

											<li>
												<a href="#">
													<i class="fa fa-users text-red"></i> 5 new members joined
												</a>
											</li>

											<li>
												<a href="#">
													<i class="fa fa-shopping-cart text-green"></i> 25 sales made
												</a>
											</li>

											<li>
												<a href="#">
													<i class="fa fa-user text-red"></i> You changed your username
												</a>
											</li>
										</ul>
									</li>

									<li class="footer"><a href="#">View all</a></li>
								</ul>
							</li>
							<?php */ ?>

							<?php /* ?>
							<!-- Tasks: style can be found in dropdown.less -->
							<li class="dropdown tasks-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-flag-o"></i>
									<span class="label label-danger">9</span>
								</a>

								<ul class="dropdown-menu">
									<li class="header">You have 9 tasks</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li><!-- Task item -->
												<a href="#">
													<h3>
														Design some buttons
														<small class="pull-right">20%</small>
													</h3>

													<div class="progress xs">
														<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">20% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->

											<li><!-- Task item -->
												<a href="#">
													<h3>
														Create a nice theme
														<small class="pull-right">40%</small>
													</h3>

													<div class="progress xs">
														<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">40% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->

											<li><!-- Task item -->
												<a href="#">
													<h3>
														Some task I need to do
														<small class="pull-right">60%</small>
													</h3>

													<div class="progress xs">
														<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->

											<li><!-- Task item -->
												<a href="#">
													<h3>
														Make beautiful transitions
														<small class="pull-right">80%</small>
													</h3>

													<div class="progress xs">
														<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">80% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->
										</ul>
									</li>

									<li class="footer">
										<a href="#">View all tasks</a>
									</li>
								</ul>
							</li>
							<?php */ ?>

							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php if (!empty($_SESSION[CMS::$sess_hash]['avatar'])) { ?>
									<img src="<?=$_SESSION[CMS::$sess_hash]['avatar'];?>" alt="" class="user-image" />
									<?php } else { ?>
									<?=view::gravatar($_SESSION[CMS::$sess_hash]['ses_adm_login'], 160, ['class' => 'user-image']);?>
									<?php } ?>

									<span class="hidden-xs"><?=ADMIN_INFO;?></span>
								</a>

								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<?php if (!empty($_SESSION[CMS::$sess_hash]['avatar'])) { ?>
										<img src="<?=$_SESSION[CMS::$sess_hash]['avatar'];?>" alt="" class="img-circle" />
										<?php } else { ?>
										<?=view::gravatar($_SESSION[CMS::$sess_hash]['ses_adm_login'], 160, ['class' => 'img-circle']);?>
										<?php } ?>

										<p>
											<?=ADMIN_INFO;?> - <?=CMS::t('cms_users_role_'.$_SESSION[CMS::$sess_hash]['ses_adm_type']);?>
											<small><?=CMS::t('cms_user_reg_date');?> <?=utils::formatMySQLDate('d.m.Y', $_SESSION[CMS::$sess_hash]['ses_adm_reg_date']);?></small>
										</p>
									</li>

									<!-- Menu Body -->
									<!-- <li class="user-body">
										<div class="row">
											<div class="col-xs-4 text-center">
												<a href="#">Followers</a>
											</div>

											<div class="col-xs-4 text-center">
												<a href="#">Sales</a>
											</div>

											<div class="col-xs-4 text-center">
												<a href="#">Friends</a>
											</div>
										</div>
									</li> -->

									<!-- Menu Footer-->
									<li class="user-footer">
										<?php if (CMS::hasAccessTo('cms_users/edit')) { ?>
										<div class="pull-left">
											<a href="?controller=cms_users&amp;action=edit&amp;id=<?=$_SESSION[CMS::$sess_hash]['ses_adm_id'];?>" class="btn btn-default btn-flat"><?=CMS::t('edit_cms_user_self');?></a>
										</div>
										<?php } ?>

										<div class="pull-right">
											<a href="?controller=base&amp;action=sign_out" class="btn btn-default btn-flat"><?=CMS::t('logout');?></a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>

			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<!-- <div class="user-panel">
						<div class="pull-left image">
							<?=view::gravatar($_SESSION[CMS::$sess_hash]['ses_adm_login'], 160, ['class' => 'img-circle']);?>
						</div>

						<div class="pull-left info">
							<p><?=ADMIN_INFO;?></p>
							<a><i class="fa fa-circle text-success"></i> <?=CMS::t('cms_user_is_online');?></a>
						</div>
					</div> -->

					<!-- search form -->
					<!-- <form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Search..." />
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form> -->
					<!-- /.search form -->

					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="header"><?=CMS::t('menu_title');?></li>

						<?=view::widget('menu');?>

						<!-- <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>


			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<?=$content;?>
			</div>
			<!-- /.content-wrapper -->


			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> <?=CMS::$version;?>
				</div>

				<strong>Copyright &copy; 2009-<?=date('Y');?> <a href="http://profit.az" target="_blank">PROFESSIONAL IT <i class="fa fa-external-link" aria-hidden="true"></i>
</a>.</strong> All rights reserved.
			</footer>
		</div>
		<!-- ./wrapper -->
	</body>
</html>