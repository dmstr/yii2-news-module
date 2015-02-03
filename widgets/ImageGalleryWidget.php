<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace dmstr\modules\news\widgets;

use dmstr\news\models\Image;
use dmstr\news\models\ImageGallery;
use yii\base\Widget;

/**
 * Class ImageGalleryWidget
 * @package frontend\widgets
 * @author Danny Letz <d.letz@herzogkommunikation.de>
 * @author Christopher Stebe <c.stebe@herzogkommunikation.de>
 *
 * ```php
 * <?= \frontend\widgets\ImageGalleryWidget::widget(['headline' => 'Meine Fotostrecke', 'model' => $model, ['special' => 'Interschutz']]);?>
 * ```
 *
 */
class ImageGalleryWidget extends Widget
{
    /**
     * model with galleries
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
        'Interschutz',
        'Aktuelle Bilder',
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
        if ($this->model !== null && isset($this->model->imageGalleries)) {
            $galleries = $this->model->imageGalleries;

            if ($galleries !== null) {
                foreach ($galleries as $gallery) {

                    if (sizeof($gallery->images) > 0) {
                        echo $this->renderWidget($gallery) . "\n";
                    }
                }
            }
        } elseif (isset($this->special) && in_array($this->special, self::$specials)) {

            switch ($this->special) {
                case 'Aktuelle Bilder' :
                    $latestImages = Image::find()->orderBy('published_at DESC')->limit(self::$count_latest)->all();

                    if (sizeof($latestImages) > 0) {
                        echo $this->renderWidget(null, $latestImages) . "\n";
                    }
                    break;
                default:
                    $gallery = ImageGallery::find()
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
     * Render gallery widget
     *
     * @param null $imageGallery
     * @param null $latestImages
     *
     * @return string
     */
    public function renderWidget($imageGallery = null, $latestImages = null)
    {
        if ($this->headline === null) {
            $this->headline = $imageGallery->name;
        } else {
            $this->headline = $this->special;
        }

            $widgetContent = <<<EOS
<div class="row hidden-xs image-gallery-header">
    <div class="col-md-12 col-xs-12"><h2>{$this->headline}</h2></div>
</div>
EOS;

        if ($latestImages !== null) {
            $images = $latestImages;
        } else {
            $images = $imageGallery->images;
        }


        $widgetContent .= <<<EOS
<div class="row hidden-xs image-gallery" id="image-gallery-{$this->id}">
EOS;
        // Wenn nur ein image in gallerie
        if (count($images) == 1) {
            $widgetContent .= <<<EOS
                     <div class="col-md-12">
                        <div class="large-image-wrapper">
EOS;
            foreach ($images as $image) {
                $widgetContent .= \Yii::$app->controller->renderFile(
                    \Yii::getAlias('@frontend/views/image-gallery') . '/xl-template.php',
                    ['image' => $image]
                );
            }
            $widgetContent .= <<<EOS
        </div>
    </div>
EOS;
        } // get all images
        else {
            $i = 0;
            foreach ($images as $image) {
                ++$i;
                if ($i == 1) {
                    $widgetContent .= <<<EOS
        <div class="col-md-9 col-xs-9">
            <div class="main-image-wrapper" id="wrapper-large-{$this->id}">
EOS;
                    $widgetContent .= \Yii::$app->controller->renderFile(
                        \Yii::getAlias('@frontend/views/image-gallery') . '/large-template.php',
                        ['image' => $image]
                    );
                    $widgetContent .= <<<EOS
            </div>
        </div>
        <div class="col-md-3 col-xs-3">
            <div class="side-image-wrapper" id="wrapper-small-{$this->id}">
EOS;
                } else {
                    $widgetContent .= \Yii::$app->controller->renderFile(
                        \Yii::getAlias('@frontend/views/image-gallery') . '/small-template.php',
                        ['image' => $image]
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