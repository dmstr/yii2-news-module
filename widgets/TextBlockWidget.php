<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\news\widgets;

use yii\helpers\Html;
use yii\jui\Widget;
use dmstr\news\models\TextBlock;

/**
 * Class TextBlockWidget
 * @package frontend\widgets
 * @author Danny Letz <d.letz@herzogkommunikation.de>
 *
 * Public property values see admin-lte core.less
 *
 * ```php
 * <?= \frontend\widgets\TextBlockWidget::widget(['model'  => $model ,'special' => '']); ?>
 * ```
 *
 */
class TextBlockWidget extends Widget
{
    /**
     * model with text blocks
     * @var integer
     */
    public $model;
    public $special = null;

    private static $specials = [
        ''
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
        if ($this->model !== null && isset($this->model->textBlocks)) {

            $textBlocks = $this->model->textBlocks;

            if ($textBlocks !== null) {
                foreach ($textBlocks as $textBlock) {
                    echo $this->renderWidget($textBlock) . "\n";
                }
            }
        } elseif (isset($this->special) && in_array($this->special, self::$specials)) {

            $gallery = TextBlock::find()
                ->orderBy(['published_at DESC'])
                ->one();

            if ($gallery !== null) {
                echo $this->renderWidget($gallery) . "\n";
            }
        }
    }

    /**
     * Render text block widget markup
     *
     * @param $textBlock
     *
     * @return string
     */
    public function renderWidget($textBlock)
    {
        $image  = Html::img($textBlock->image, ['class' => 'small-logo']);
        $text   = $textBlock->text_html;
        $source = 'Quelle/Bild:' . $textBlock->source;

        return <<<EOS
                    <div class="row">
                    <div class="col-md-12 col-xs-12">
                    <div class="col-md-3">{$image}
                    <span style="color: #404040; font-size: 13px; font-family: Arial, Verdana;"> {$source}</span>
                    </div>
                    <div class="col-md-9">
                    {$text}
                    </div>
                     </div>
                     </div>
                    <div class="vertical-grid-space"></div>
EOS;
    }
} 