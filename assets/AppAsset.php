<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/swiper.css',
        'css/sumoselect.css',
        'css/font-awesome.min.css',
        'css/flaticon.css',
        'css/style.css'
    ];
    public $js = [
        'js/jquery.min.js',
        'js/swiper.jquery.min.js',
        'js/SmoothScroll.js',
        'js/jquery.sumoselect.min.js',
        'js/simple-lightbox.min.js',
        'js/global.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
