<?php

namespace app\controllers;

use app\helpers\app;
use profit_az\profit_cms\base\widget;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class breadcrumb_widget_controller extends widget {
	/* See profit_az\profit_cms\helpers\view class for function widget($widget_name, $options=[]) information */

	public static function run() {
		return self::render('breadcrumbs', [
			'links' => self::$options['links']
		]);
	}
}

?>