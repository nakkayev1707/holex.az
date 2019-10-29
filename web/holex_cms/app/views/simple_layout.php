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
			$(document).ready(function() {
				$('.fancybox').fancybox();
			});
			//alert(utils.toQueryParams({key1: 'val1', key2: /*'val2'*/ {subkey1: 'subval1', subkey2: 'subval2'}}));
			//alert(utils.isLinkGlobal('https://mycareerhub.mmu.ac.uk/help/api/guide/security#client-credentials-grant'));
			//alert(utils.genHtmlTagAttrs({name: 'Valentin', surname: 'Belousov'}, 'data-'));
			//alert(utils.truncateStr('forever', 3));
		</script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<?=$content;?>
</html>