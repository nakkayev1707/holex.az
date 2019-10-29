<?php

namespace app\controllers;

use app\helpers\app;
use profit_az\profit_cms\base\widget;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class menu_widget_controller extends widget {
	/* See profit_az\profit_cms\helpers\view class for function widget($widget_name, $options=[]) information */

	private static $menu = [
		[
			'name' => 'menu_block_dashboard',
			'icon' => 'dashboard',
			'selected' => ['statistics/dashboard'],
			'url' => '?controller=statistics&action=dashboard'
		],
//		[
//			'name' => 'menu_block_nav',
//			'icon' => 'sitemap',
//			'selected' => ['nav/list', 'nav/add', 'nav/edit', 'nav/delete'],
//			'url' => '?controller=nav&action=list'
//		],
		[
			'name' => 'menu_block_content',
			'icon' => 'files-o',
			'selected' => ['articles/list', 'articles/add', 'articles/edit', 'articles/delete', 'gallery/list', 'gallery/add', 'gallery/edit', 'gallery/delete', 'gallery/photos'],
			'subs' => [
//				'articles/list' => [
//					'selected' => ['articles/list', 'articles/add', 'articles/edit', 'articles/delete']
//				],
//				'gallery/list' => [
//					'selected' => ['gallery/list', 'gallery/add', 'gallery/edit', 'gallery/delete', 'gallery/photos']
//				]
			]
		],
//		[
//			'name' => 'menu_block_site_users',
//			'icon' => 'users',
//			'selected' => ['site_users/list', 'site_users/delete', 'site_users/view_info', 'comments/list', 'comments/edit', 'comments/delete'],
//			'subs' => [
////				'site_users/list' => [
////					'selected' => ['site_users/list', 'site_users/delete', 'site_users/view_info']
////				],
////				'comments/list' => [
////					'selected' => ['comments/list', 'comments/edit', 'comments/delete'],
////					'callback' => 'comments.countUnreadComments'
////				],
//				/*'complaints' => [
//					'selected' => ['complaints/list_chats', 'complaints/chat'],
//					'callback' => 'complaints.countNewComplaints'
//				]*/
//			]
//		],
		[
			'name' => 'menu_block_cms_users',
			'icon' => 'user-secret',
			'selected' => ['cms_users/list', 'cms_users/add', 'cms_users/delete', 'cms_users/edit'],
			/*'subs' => [
				'cms_users/list' => [
					'selected' => ['cms_users/list', 'cms_users/add', 'cms_users/delete', 'cms_users/edit']
				]
			],*/
			'url' => '?controller=cms_users&action=list'
		]
	];

	private static function menu() { // 2017-04-06
		$privilegies = CMS::getPrivilegies();

		$html = '';
		$cur_page = @$_GET['controller'].'/'.@$_GET['action'];

		foreach (self::$menu as $i=>$block) {
			if (!empty($privilegies)) { // check privilegies
				$pages = $block['selected'];
				$allowed_pages = array_intersect($pages, array_keys($privilegies));
				if (empty($allowed_pages)) {continue;}
			}

			if (empty($block['selected'])) {$block['selected'] = array_keys(@$block['subs']);}
			if (empty($block['icon'])) {$block['icon'] = 'circle-o';}
			$html.='<li class="treeview'.(in_array($cur_page, $block['selected'])? ' active': '').'">
				<a href="'.(empty($block['url'])? '#': $block['url']).'">
					<i class="fa fa-'.$block['icon'].'"></i>
					<span>'.CMS::t($block['name']).'</span>
					'.(empty($block['subs'])? '': '
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
					').'
				</a>

				';
			if (!empty($block['subs'])) {
				$html.='<ul class="treeview-menu">';
				foreach ($block['subs'] as $page=>$item) {
					if (!CMS::hasAccessTo($page)) {continue;}

					if (empty($item['name'])) {$item['name'] = 'menu_item_'.str_replace('/', '_', $page);}
					if (empty($item['selected'])) {$item['selected'] = [$page];}
					if (empty($item['icon'])) {$item['icon'] = 'circle-o';}
					if (empty($item['url'])) {
						list($controller, $action) = explode('/', $page);
						$item['url'] = '?controller='.$controller.'&action='.$action;
					}
					$counter = '';
					if (!empty($item['callback'])) {
						list($counter_model, $counter_method) = explode('.', $item['callback']);
						$counter = call_user_func('app\\models\\'.$counter_model.'::'.$counter_method);
					}
					$html.='<li'.(in_array($cur_page, $item['selected'])? ' class="active"': '').'>
						<a href="'.utils::safeEcho($item['url'], 1).'">
							<!-- <i class="fa fa-'.$item['icon'].'"></i> -->
							'.CMS::t($item['name']).(empty($counter)? '': ('
							<span class="pull-right-container">
								<span class="label pull-right bg-red">'.$counter.'</span>
							</span>')).'
						</a>
					</li>';
				}
				$html.='</ul>';
			}
			$html.='</li>';
		}

		return $html;
	}

	public static function run() {
		return self::menu();
	}
}

?>