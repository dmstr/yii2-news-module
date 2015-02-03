<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace dmstr\modules\news\widgets;

use dmstr\news\models\Video;
use dmstr\news\models\VideoGallery;
use yii\base\Widget;

/**
 * Class VideoGalleryWidget
 * @package frontend\widgets
 * @author Danny Letz <d.letz@herzogkommunikation.de>
 * @author Christopher Stebe <c.stebe@herzogkommunikation.de>
 *
 * ```php
 * <?= \frontend\widgets\VideoGalleryWidget::widget(['headline' => 'Meine Videostrecke', 'model' => $model, ['special' => 'latest']]);?>
 * ```
 *
 */
class VideoGalleryWidget extends Widget
{
    /**
     * model with galleries
     * @var integer
     */
    public $model;

    /**
     * Gallery headline
     * @var string
     */
    public $headline;

    /**
     * How many latest items should be displayed
     * @var int
     */
    private static $count_latest = 9;

    /**
     * Special galleries
     * @var null
     */
    public $special = null;

    private static $specials = [
        'Aktuelle Videos',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->model !== null && isset($this->model->videoGalleries)) {

            $galleries = $this->model->videoGalleries;
            if ($galleries !== null) {
                foreach ($galleries as $gallery) {
                    if (sizeof($gallery->videos) > 0) {
                        echo $this->renderWidget($gallery) . "\n";
                    }
                }
            }
        } elseif (isset($this->special) && in_array($this->special, self::$specials)) {

            switch ($this->special) {
                case 'Aktuelle Videos':
                    $latestVideos = Video::find()->orderBy('published_at DESC')->limit(self::$count_latest)->all();
                    if (sizeof($latestVideos) > 0) {
                        echo $this->renderWidget(null, $latestVideos) . "\n";
                    }
                    break;
                default:
                    $gallery = VideoGallery::find()
                        ->where(['name' => $this->special])
                        ->one();
                    if ($gallery !== null) {
                        echo $this->renderWidget($gallery) . "\n";
                    }
                    break;
            }
        }
    }

    /**
     * Render video gallery widget
     *
     * @param null $videoGallery
     * @param null $latestVideos
     *
     * @return string
     */
    public function renderWidget($videoGallery = null, $latestVideos = null)
    {
        if ($this->headline === null) {
            $this->headline = $videoGallery->name;
        } else {
            $this->headline = $this->special;
        }

        if ($this->headline !== null) {
            $widgetContent = <<<EOS
<div class="row hidden-xs">
    <div class="col-md-12 col-xs-12"><h2>{$this->headline}</h2></div>
</div>
EOS;
        } else {
            $widgetContent = "";
        }

        if ($latestVideos !== null) {
            $videos = $latestVideos;
        } else {
            $videos = $videoGallery->videos;
        }

        // if only one video in gallery
        $widgetContent .= <<<EOS
<div class="row hidden-xs" id="video-gallery-{$this->id}">
EOS;

        if (count($videos) == 1) {
            $widgetContent .= <<<EOS
                 <div class="col-md-12 col-xs12">
                    <div class="large-video-wrapper">
EOS;
            foreach ($videos as $video) {
                $widgetContent .= \Yii::$app->controller->renderFile(
                    \Yii::getAlias('@frontend/views/video-gallery') . '/xl-template.php',
                    ['video' => $video]
                );
            }
            $widgetContent .= <<<EOS
                </div>
            </div>
EOS;
        } // get all videos from video gallery
        else {
            $i = 0;
            foreach ($videos as $video) {
                ++$i;
                if ($i == 1) {
                    $widgetContent .= <<<EOS
        <div class="col-md-9 col-xs-9 ">
            <div class="main-video-wrapper" id="wrapper-large-{$this->id}">
EOS;
                    $widgetContent .= \Yii::$app->controller->renderFile(
                        \Yii::getAlias('@frontend/views/video-gallery') . '/large-template.php',
                        ['video' => $video]
                    );
                    $widgetContent .= <<<EOS
            </div>
        </div>
        <div class="col-md-3 col-xs-3">
            <div class="side-video-wrapper" id="wrapper-small-{$this->id}">
EOS;
                } else {
                    $widgetContent .= \Yii::$app->controller->renderFile(
                        \Yii::getAlias('@frontend/views/video-gallery') . '/small-template.php',
                        ['video' => $video]
                    );
                }
            }
            $widgetContent .= <<<EOS
            </div>
        </div>
EOS;
        }
        $widgetContent .= <<<EOS
</div>
EOS;
        return $widgetContent;
    }
}