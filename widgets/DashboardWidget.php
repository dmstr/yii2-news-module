<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\news\widgets;

use yii\helpers\Url;
use yii\base\Widget;

/**
 * Class DashboardWidget
 * @package backend\components
 * @author Christopher Stebe <c.stebe@herzogkommunikation.de>
 *
 * Public property values see admin-lte core.less
 *
 * ```php
 * <?= \backend\components\DashboardWidget::widget(
 *         [
 *         'box_info'  => \common\models\Magazine::find()->count(),
 *         'box_title' => 'Magazin',
 *         'box_style' => 'aqua-gradient',
 *         'bg_icon'   => 'ion-ios7-albums',
 *         'link_text' => 'Verwalten',
 *         'rel_url'   => '/crud/magazine',
 *         'col_xs'   => '4',
 *         'col_md'   => '4',
 *         'col_lg'   => '4',
 *         ]
 *         );
 * ?>
 * ```
 *
 */
class DashboardWidget extends Widget
{
    /**
     * Bootstrap column classes
     * @var string
     */
    public $col_xs = "3";
    public $col_md = "3";
    public $col_lg = "3";

    /**
     * Admin-LTE box classes
     *
     * @var string
     */
    public $box_size = "small";
    public $box_style = "aqua";

    /**
     * @var string
     */
    public $box_title = "Title";
    public $box_info = "&nbsp;";

    /**
     * Admin-LTE icon classes
     * @var string
     */
    public $bg_icon = "ion-person";

    /**
     * Link text in footer
     * @var string
     */
    public $link_text = "Verwalten";
    public $rel_url = "/";

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
        echo $this->renderWidget() . "\n";
    }


    public function renderWidget()
    {
        $link = Url::to([$this->rel_url]);

        $output = <<<EOS
    <div class="col-xs-{$this->col_xs} col-md-{$this->col_md} col-lg-{$this->col_lg}">
        <!-- small box -->
        <a href="{$link}">
            <div class="{$this->box_size}-box bg-{$this->box_style}">
                <div class="inner">
                    <h3>{$this->box_info}</h3>
                    <p>{$this->box_title}</p>
                </div>
                <div class="icon">
                    <i class="ion {$this->bg_icon}"></i>
                </div>
                <div class="{$this->box_size}-box-footer">
                    {$this->link_text} <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </a>
    </div>
EOS;
        return $output;
    }

} 