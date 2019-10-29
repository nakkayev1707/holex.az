<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

?>


<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	$('#divNavTree').jstree({
		'core': {
			'check_callback': function(operation, node, parent, position, more) {
				if (/*operation==="copy_node" ||*/ operation==="move_node") {
					if (parent.id==="#") {
						return false; // prevent moving a child above or below the root
					}
				}
				return true; // allow everything else
			}
		},
		'plugins': ['dnd']
	});
	$('#divNavTree').on('activate_node.jstree', function(node, event) {
		location.href = event.node.a_attr.href;
	});
	$('#divNavTree').on('move_node.jstree', function(node, event) {
		// console.log(event);
		var $self = $('a#'+event.node.id+'_anchor');
		var self = $self.attr('data-item_id');
		if (event.old_parent!=event.parent) {
			// change parent nest
			var $from = $('a#'+event.old_parent+'_anchor');
			var from = $from.attr('data-item_id');
			if (from==undefined) {from = '0';}
			var $to = $('a#'+event.parent+'_anchor');
			var to = $to.attr('data-item_id');
			if (to==undefined) {to = '0';}
			//console.log('Change parent of '+self+' from '+from+' to '+to);
			var url = '?controller=nav&action=ajax_set_parent';
			var data = {
				CSRF_token: '<?=$CSRF_token;?>',
				id: self,
				parent: to,
				pos: event.position
			};
		} else {
			// set new position
			//console.log('Change position from '+event.old_position+' to '+event.position);
			var url = '?controller=nav&action=ajax_set_position';
			var data = {
				CSRF_token: '<?=$CSRF_token;?>',
				id: self,
				pos: event.position
			};
		}

		$.ajax({
			url: url,
			async: false,
			cache: false,
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function(response, status, xhr) {
				if (response.success) {
					// no action
				} else {
					// cancel
				}
			},
			error: function(xhr, err, descr) {
				// cancel
			}
		});
	});
});
// ]]>
</script>


<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?=CMS::t('nav_menu_structure');?></h3>
	</div>
	<!-- /.box-header -->

	<div class="box-body">
		<div class="nav-tree" id="divNavTree">
			<ul>
				<li data-jstree="<?=utils::safeEcho(json_encode([
						'opened' => true,
						'selected' => empty($_GET['item']),
						'icon' => 'fa fa-bars',
					]), 1);?>">
					<a href="?controller=<?=$_GET['controller'];?>&amp;action=list"><?=CMS::t('nav_menu');?></a>
					<?=$tree;?>
				</li>
			</ul>
		</div>
	</div>
	<!-- /.box-body -->

</div>
<!-- /.box -->
