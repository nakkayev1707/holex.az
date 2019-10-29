<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}


view::appendCss(SITE.CMS_DIR.JS_DIR.'jquery-ui-1.12.1/jquery-ui.css');
view::appendCss(SITE.CMS_DIR.CSS_DIR.'gallery_photos_list.css');

view::appendJs(SITE.CMS_DIR.JS_DIR.'jquery-ui-1.12.1/jquery-ui.min.js');

?>


<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	$('.gallery-photos-list').sortable({
		start: function(e, ui) {
		},
		stop: function(e, ui) {
			var $ul = ui.item.parent();
			var list = $('.gallery-photos-list').sortable('serialize');
			$.ajax({
				url: '?controller=gallery&action=ajax_photos_sort&gallery_id=<?=$gallery['id'];?>',
				async: false,
				cache: false,
				method: 'POST',
				data: list+'&CSRF_token=<?=$CSRF_token;?>',
				dataType: 'json',
				success: function(response, status, xhr) {
					if (response.success) {
						// reserved
					} else {
						$('.gallery-photos-list').sortable('cancel');
					}
				},
				error: function(xhr, err, descr) {
					$('.gallery-photos-list').sortable('cancel');
				}
			});
        },
        items: "li:not(.item.new)",
        placeholder: 'place-holder',
        scroll: true
	}).disableSelection();
});
// ]]>
</script>


<!-- Deleting hidden form -->
<form action="?controller=gallery&amp;action=delete_photo&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
	<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
	<input type="hidden" name="delete" value="0" />
</form>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?=CMS::t('menu_item_gallery_photos');?>
		<small><?=utils::limitStringLength(@$gallery['translates'][CMS::$default_site_lang]['name'], 52);?></small>
	</h1>

	<!-- <?=view::widget('breadcrumb', [
		'links' => [
			[
				'title' => CMS::t('main_page'),
				'icon' => 'dashboard',
				'href' => '?controller=statistics&action=dashboard'
			],
			[
				'title' => CMS::t('menu_item_gallery_list')
			]
		]
	]);?> -->
</section>

<!-- Content Header (Page header) -->
<section class="contextual-navigation">
	<nav>
		<a href="<?=utils::safeEcho($link_back, 1);?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?=CMS::t('back');?></a>

		<?php if (CMS::hasAccessTo('gallery/edit', 'write')) { ?>
		<a href="?controller=gallery&amp;action=edit&amp;id=<?=$gallery['id'];?>" class="btn btn-default"><i class="fa fa-folder-open" aria-hidden="true"></i> <?=CMS::t('gallery_album_edit');?></a>
		<?php } ?>

		<?php if (CMS::hasAccessTo('gallery/add_photo', 'write')) { ?>
		<a href="?controller=gallery&amp;action=add_photo&amp;gallery_id=<?=$gallery['id'];?>&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('menu_item_gallery_add_photo');?></a>
		<?php } ?>
	</nav>
</section>

<!-- Main content -->
<section class="content">

	<!-- Info boxes -->

	<!-- <pre><?php /*var_export($users);*/ ?></pre> -->

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><?=CMS::t('gallery_photos_list_details', [
				'{count}' => $count,
				'{ru:u1}' => utils::getRussianWordEndingByNumber($count, 'е', 'я', 'й'),
				'{ru:u2}' => utils::getRussianWordEndingByNumber($count, 'о', 'о', 'о')
			]);?></h3>
		</div>
		<!-- /.box-header -->

        <div class="box-body">
			<div class="row">
				<?php
					if (is_array($photos) && count($photos)) {
				?>
				<ul class="gallery-photos-list ui-sortable">
				<?php foreach ($photos as $f) { ?>
					<li class="item" id="photo_<?=$f['id']?>" data-id="<?=$f['id']?>">
						<div>
							<a href="?controller=gallery&amp;action=edit_photo&amp;id=<?=$f['id'];?>&amp;return=<?=$link_return;?>" title="<?=CMS::t('edit');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
							<a href="?controller=gallery&amp;action=delete_photo&amp;gallery_id=<?=$gallery['id'];?>&amp;delete_id=<?=$f['id'];?>&amp;return=<?=$link_return;?>" title="<?=CMS::t('delete');?>" class="text-red pull-right" id="aDeletePicture_<?=$f['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
							<script type="text/javascript">
								utils.setConfirmation('click', '#aDeletePicture_<?=$f['id'];?>', '<?=CMS::t('delete_confirmation');?>');
							</script>
						</div>
						<a href="<?=$gallery_dir;?>gallery_<?=$gallery['id'];?>/big/<?=$f['image'];?>" title="<?=@$f['name'];?>" class="fancybox">
							<img src="<?=$gallery_dir;?>gallery_<?=$gallery['id'];?>/thumb/<?=$f['image'];?>" alt="<?=$f['image'];?>" style="border: 1px solid #888;" />
						</a>
						<p style="text-align: center;">
							<strong><?=(trim(@$f['name'])? utils::limitWords($f['name'], 5): $f['image']);?></strong><br />
							<?=utils::formatMySQLDate('d.m.Y H:i:s', $f['add_datetime']);?>
						</p>
					</li>
				<?php } ?>
				</ul>
			</div>
			
			<div class="clearfix"></div>

			<div class="pagination"><?php
				if (empty($_GET['no_pagination'])) {
					if ($total>1) {
						print view::pg([
							'total' => $total,
							'current' => $current,
							'page_url' => $link_sc.'&amp;page=%d'
						]);
						?><a href="<?=$link_sc;?>&amp;no_pagination=1"> <?=CMS::t('pg_all');?> </a><?php
					}
				} else {
					?><a href="<?=$link_sc;?>" title=""> <?=CMS::t('pg');?> </a><?php
				}
			?></div>
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