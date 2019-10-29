<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

$only_lang = (count($langs)==1);


// load JsTree plugin
view::appendCSS(JS_DIR.'jstree/themes/custom/style.css');
view::appendJS(JS_DIR.'jstree/jstree.min.js');

view::appendCSS(CSS_DIR.'nav.css');

// load Select2 plugin
view::appendJs(SITE.CMS_DIR.JS_DIR.'select2/js/select2.min.js');
view::appendJs(SITE.CMS_DIR.JS_DIR.'select2/js/i18n/'.$_SESSION[CMS::$sess_hash]['ses_adm_lang'].'.js');

?>


<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	var switchType = function(type) {
		if ($.inArray(type, ['category', 'spec', 'article'])!=-1) {
			$('[name="sef"]').parent().show();
		} else {
			$('[name="sef"]').parent().hide();
		}
		if (type=='article') {
			$('[name="ref_id"]').parent().show();
		} else {
			$('[name="ref_id"]').parent().hide();
		}
		if (type=='url') {
			$('[name="url"]').parent().show();
		} else {
			$('[name="url"]').parent().hide();
		}
		if ($.inArray(type, ['category', 'spec'])!=-1) {
			$('[name="is_section"]').parent().show();
		} else {
			$('[name="is_section"]').parent().hide();
		}
	};

	$('[name="type"]').change(function() {
		switchType(this.value);
	});
	switchType($('[name="type"]').val());
});
// ]]>
</script>


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?=CMS::t('menu_block_nav');?></h1>
</section>


<!-- Deleting hidden form -->
<form action="?controller=nav&amp;action=delete&amp;return=<?=$link_return;?>" method="post" id="formDeleteItem">
	<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />
	<input type="hidden" name="delete" value="0" />
</form>


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

	<div class="row">
		<div class="col-md-3">
			<?=view::widget('nav_menu_tree', [
				'structure' => $menu
			]);?>
		</div>
		<!-- /.col -->

		<div class="col-md-9">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">
						<?=((@$_GET['action']=='add')? CMS::t('nav_menu_add_item'): CMS::t('nav_menu_edit_item'));?> &mdash; <?=(empty($item['id'])? CMS::t('nav_menu'): utils::safeEcho($item['translates'][CMS::$default_site_lang]['name'], 1));?>
					</h3>
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<div class="contextual-action-controls">
						<!-- Action Buttons -->

						<?php
							if (CMS::hasAccessTo('nav/add', 'write') && in_array($_GET['action'], ['list', 'edit'])) {
						?>
						<a href="?controller=nav&amp;action=add&amp;<?=(empty($_GET['item'])? '': ('item='.utils::safeEcho($_GET['item'], 1).'&amp;'));?>return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('nav_menu_add_item');?></a>
						<?php
							}
						?>

						<?php
							if (CMS::hasAccessTo('nav/delete', 'write') && ($_GET['action']=='edit') && !empty($_GET['item'])) {
						?>
						<a href="?controller=nav&amp;action=delete&amp;return=<?=$link_return;?>&amp;<?=time();?>" class="btn btn-danger" id="aDeleteItem_<?=$item['id'];?>" data-item-id="<?=$item['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i> <?=CMS::t('nav_menu_del_item');?></a>
						<script type="text/javascript">
							$('#aDeleteItem_<?=$item['id'];?>').on('click', function() {
								bootbox.confirm({
									message: '<?=CMS::t('delete_confirmation');?>',
									callback: function(ok) {
										if (ok) {
											var $form = $('#formDeleteItem');
											$('[name="delete"]', $form).val('<?=$item['id'];?>');
											$form.submit();
										}
									}
								});
								return false;
							});
						</script>
						<?php
							}
						?>

						<?php
							if (CMS::hasAccessTo('nav/edit') && ($_GET['action']=='add')) {
						?>
						<a href="<?=utils::safeEcho($link_back, 1);?>" class="btn btn-default"><i class="fa fa-arrow-up" aria-hidden="true"></i> <?=CMS::t('nav_menu_level_up');?></a>
						<?php
							}
						?>
					</div>

					<div class="nav-item">
						<!-- Info Box -->

						<?php
						if (!empty($item['id']) && (@$_GET['action']!='add')) {
							$url = '';
							switch ($item['type']) {
								case 'category':
								case 'spec':
									$url.=SITE.CMS::$default_site_lang.'/'.$item['sef'].'/';
								break;
								case 'article':
									//$article = articles::getArticle($item['ref_id']);
									//$url.=SITE.CMS::$default_site_lang.'/'.$item['ref_id'].','.$article['sef'].'/';
									$url.=SITE.CMS::$default_site_lang.'/'.$item['sef'].'/';
								break;
								case 'url':
									$url = strtr($item['url'], [
										'{lang}' => CMS::$default_site_lang
									]);
									if ($url[0]=='/') {
										$url = SITE.substr($url, 1);
									} else if ($item['url'][0]=='#') {
										if ($url=='#') {
											$url = 'javascript:void(0);';
											//$url = '';
										}
									}
								break;
							}
						?>
						<div class="div-item-infobox">
							<table class="table table-bordered table-striped">
								<tr>
									<th>URL</th>
									<td><a href="<?=utils::safeEcho($url, 1);?>" target="_blank"><?=$url;?> <i class="fa fa-external-link" aria-hidden="true"></i></a></td>
								</tr>
								<tr>
									<th><?=CMS::t('author');?></th>
									<td>
										<?php if (CMS::hasAccessTo('cms_users/edit')) { ?><a href="?controller=cms_users&amp;action=edit&amp;id=<?=$item['add_by'];?>"><?php } ?>
											<i class="fa fa-user-secret" aria-hidden="true"></i> <?=utils::safeEcho($item['author_name'], 1);?>
										<?php if (CMS::hasAccessTo('cms_users/edit')) { ?></a><?php } ?>, 
										<time datetime="<?=utils::formatMySQLDate('c', $item['add_datetime']);?>" title="<?=$item['add_datetime'];?>"><?=utils::formatMySQLDate('d.m.Y H:i', $item['add_datetime']);?></time>
									</td>
								</tr>
								<tr>
									<th><?=CMS::t('editor');?></th>
									<td>
										<?php if (!empty($item['mod_by'])) { ?>
										<?php if (CMS::hasAccessTo('cms_users/edit')) { ?>
										<a href="?page=edit_admin_user&amp;id=<?=$item['mod_by'];?>">
										<?php } ?>
										<i class="fa fa-user-secret" aria-hidden="true"></i> <?=$item['editor_name'];?>
										<?php if (CMS::hasAccessTo('cms_users/edit')) { ?></a><?php } ?>, 
										<time datetime="<?=utils::formatMySQLDate('c', $item['mod_datetime']);?>" title="<?=$item['mod_datetime'];?>"><?=utils::formatMySQLDate('d.m.Y H:i', $item['mod_datetime']);?></time>
										<?php } ?>
									</td>
								</tr>
							</table>
						</div>
						<?php } ?>


						<!-- Add / Edit / View Form -->

						<?php if ((@$_GET['action']=='add') || !empty($item['id'])) { ?>
						<div class="nav-item-info">
							<form action="" method="post" enctype="multipart/form-data" id="formAddEditItem" role="form">
								<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

								<!-- Translates -->
								<?php foreach ($langs as $lng) { ?>
								<div class="form-group" style="margin-bottom: 6px;">
									<label><?=CMS::t('nav_menu_item_name');?><?php if (!$only_lang) { ?> (<?=$lng['language_name'];?>)<?php } ?></label>

									<?php
									$name_value = '';
									if (!empty($_POST['CSRF_token'])) {
										$name_value = @$_POST['name'][$lng['language_dir']];
									} else if (!empty($item['id']) && (@$_GET['action']!='add')) {
										$name_value = @$item['translates'][$lng['language_dir']]['name'];
									}
									?>
									<input type="text" name="name[<?=$lng['language_dir'];?>]" value="<?=utils::safeEcho($name_value, 1);?>" class="form-control" />
								</div>

								<?php if ($only_lang) { ?>
								<input type="hidden" name="is_published_lang[<?=$lng['language_dir'];?>]" value="1" />
								<?php } else { ?>
								<div class="form-group">
									<?php
									$lng_published = false;
									if (!empty($_POST['CSRF_token'])) {
										$lng_published = !empty($_POST['is_published_lang'][$lng['language_dir']]);
									} else if (!empty($item['id']) && (@$_GET['action']!='add')) {
										$lng_published = !empty($item['translates'][$lng['language_dir']]['is_published_lang']);
									}
									?>
									<input type="checkbox" name="is_published_lang[<?=$lng['language_dir'];?>]" value="1"<?=($lng_published? ' checked="checked"': '');?> id="triggerLangStatus_<?=$lng['language_dir'];?>" /><label for="triggerLangStatus_<?=$lng['language_dir'];?>" style="display: inline; font-weight: normal;"> <?=CMS::t('publish_lang');?></label>
								</div>
								<?php } ?>
								<?php } ?>
								<!-- / Translates -->

								<div class="form-group">
									<label><?=CMS::t('nav_menu_item_type');?></label>

									<select name="type" class="form-control">
										<option value=""></option>
										<?php
											$type_selected = '';
											if (!empty($_POST['CSRF_token'])) {
												$type_selected = @$_POST['type'];
											} else if (!empty($item['id']) && (@$_GET['action']!='add')) {
												$type_selected = $item['type'];
											}
											foreach ($nav_types as $navtype) {
												?><option value="<?=$navtype;?>"<?=(($navtype==$type_selected)? ' selected="selected"': '');?>><?=CMS::t('nav_menu_item_type_'.$navtype);?></option><?php
											}
										?>
									</select>
								</div>

								<div class="form-group">
									<label><?=CMS::t('nav_menu_item_sef');?></label>

									<?php
										$sef_default = '';
										if (!empty($item['id']) && (@$_GET['action']!='add')) {
											$sef_default = $item['sef'];
										}
									?>
									<input type="text" name="sef" value="<?=utils::safePostValue('sef', $sef_default, 1);?>" class="form-control" />
								</div>

								<div class="form-group">
									<?php
										$is_section = false;
										if (!empty($item['id']) && (@$_GET['action']!='add')) {
											$is_section = $item['is_section'];
										}
										$is_section = (isset($_POST['CSRF_token'])? @$_POST['is_section']: $is_section);
									?>
									<input type="checkbox" name="is_section" value="1"<?=($is_section? ' checked="checked"': '');?> id="triggerIsSection" /><label for="triggerIsSection" style="display: inline; font-weight: normal;"> <?=CMS::t('nav_menu_item_is_section');?></label>
								</div>

								<div class="form-group">
									<label><?=CMS::t('nav_menu_item_ref_article');?></label>

									<select name="ref_id" class="form-control select2" id="selectArticlePicker" style="width: 100%">
										<?php if (!empty($article['id'])) { ?>
										<option value="<?=$article['id'];?>" selected="selected"><?=utils::safeEcho(@$article['translates'][CMS::$default_site_lang]['title'], 1);?></option>
										<?php } ?>
									</select>

									<script type="text/javascript">
// <![CDATA[
$('#selectArticlePicker').select2({
	language: '<?=$_SESSION[CMS::$sess_hash]['ses_adm_lang'];?>',
	ajax: {
		url: '?controller=articles&action=ajax_get_autocomplete',
		dataType: 'json',
		delay: 250,
		data: function(params) {
			return {
				q: params.term, // search term
				page: params.page
			};
		},
		processResults: function(response, params) {
			// parse the results into the format expected by Select2
			// since we are using custom formatting functions we do not need to
			// alter the remote JSON data, except to indicate that infinite
			// scrolling can be used
			params.page = params.page || 1;

			return {
				results: response.data.articles,
				pagination: {
					more: (params.page * 30) < response.data.total_count
				}
			};
		},
		cache: true
	},
	escapeMarkup: function(markup) {
		return markup;
	}, // let our custom formatter work
	minimumInputLength: 2,
	templateResult: function(article) {
		if (article.loading) {return article.text;}

		var html = '<div class="select2-result-article clearfix">'+
			//'<div class="select2-result-article__avatar"><img src="'+article.preview_url+'" alt="" /></div>'+
			'<div class="select2-result-article__meta">'+
				'<div class="select2-result-article__title">'+article.label+'</div>'+
			'</div>'+
		'</div>';

		return html;
	},
	templateSelection: function(article) {
		return (article.label || article.text);
	}
});
// ]]>
									</script>
								</div>

								<div class="form-group">
									<label><?=CMS::t('nav_menu_item_url');?></label>

									<?php
										$url_default = '#';
										if (!empty($item['id']) && (@$_GET['action']!='add')) {
											$url_default = $item['url'];
										}
									?>
									<input type="text" name="url" value="<?=utils::safePostValue('url', $url_default, 1);?>" class="form-control" />

									<div class="callout callout-info" style="margin-top: 10px;">
										<h4><?=CMS::t('alert_info');?></h4>
										<p><?=CMS::t('nav_menu_item_url_descr');?></p>
									</div>
								</div>

								<?php if (empty($_GET['item']) || (!empty($_GET['item']) && (@$_GET['action']!='add') && empty($item['parent_id']))) { ?>
								<div class="form-group">
									<label><?=CMS::t('nav_menu_item_position');?></label>

									<div class="form-div-multicheckbox">
										<?php
											if (!empty($positions) && count($positions)) foreach ($positions as $pos) {
												$is_pos_selected = (empty($_POST['CSRF_token'])? in_array($pos['position'], ['main', 'sitemap']): !empty($_POST['position'][$pos['position']]));
												if (!empty($item['id']) && (@$_GET['action']!='add')) {
													$is_pos_selected = in_array($pos['position'], $item['positions']);
												}
										?><input type="checkbox" name="position[<?=$pos['position'];?>]" value="1"<?=($is_pos_selected? ' checked="checked"': '');?> id="multiCheckboxPosition_<?=$pos['position'];?>" /><label for="multiCheckboxPosition_<?=$pos['position'];?>"> <?=$pos['name'];?></label><br /><?php
											}
										?>
									</div>
								</div>
								<?php } ?>

								<div class="form-group">
									<?php
										$is_published = true;
										if (!empty($item['id']) && (@$_GET['action']!='add')) {
											$is_published = $item['is_published'];
										}
										$is_published = (isset($_POST['CSRF_token'])? @$_POST['is_published']: $is_published);
									?>
									<input type="checkbox" name="is_published" value="1"<?=($is_published? ' checked="checked"': '');?> id="triggerStatus" /><label for="triggerStatus" style="display: inline; font-weight: normal;"> <?=CMS::t('publish');?></label>
								</div>
							</form>
						</div>
						<?php } ?>

					</div>
					<!-- /.nav-item -->

				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<?php if ($_GET['action']=='add') { ?>
					<button type="submit" name="add" value="1" class="btn btn-primary" form="formAddEditItem"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('add');?></button>
					<button type="reset" name="reset" value="1" class="btn btn-default" form="formAddEditItem"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
					<button type="reset" name="cancel" value="1" class="btn btn-default" onclick="location.href='<?=utils::safeEcho(utils::safeJsEcho($link_back, 1), 1);?>';" form="formAddEditItem"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?=CMS::t('cancel');?></button>
					<?php } else if (($_GET['action']=='edit') && !empty($item['id'])) { ?>
					<button type="submit" name="save" value="1" class="btn btn-primary" form="formAddEditItem"><i class="fa fa-save" aria-hidden="true"></i> <?=CMS::t('save');?></button>
					<button type="submit" name="apply" value="1" class="btn btn-success" form="formAddEditItem"><i class="fa fa-check" aria-hidden="true"></i> <?=CMS::t('apply');?></button>
					<button type="reset" name="reset" value="1" class="btn btn-default" form="formAddEditItem"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button>
					<?php } ?>
				</div>
			</div>
			<!-- /.box (Menu Item) -->

		</div>
		<!-- /.col -->

	</div>
	<!-- /.row -->

</section>
<!-- /.content -->