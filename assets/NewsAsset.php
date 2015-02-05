<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace dmstr\news;

use yii\web\AssetBundle;

/**
 * Configuration for `backend` client script files
 * @since 4.0
 */
class NewsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-news/assets';

    public $css = [
        'news.css',
    ];
    public $js = [
        'js/image-gallery.js',
        'js/video-gallery.js',
    ];
    public $depends = [
        // we recompile the less files from 'yii\bootstrap\BootstrapAsset' and include the css in app.css,
        // set bundle to false in assetManager config
        'yii\web\YiiAsset',
    ];
}
