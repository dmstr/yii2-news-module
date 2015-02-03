<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use \dmstr\news\widgets\TextBlockWidget;
use \dmstr\news\widgets\ImageGalleryWidget;
use \dmstr\news\widgets\VideoGalleryWidget;



/**
 * Class ActiveRecord
 * @package dmstr\news\models
 * @author Christopher Stebe <c.stebe@herzogkommunikation.de>
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * Returns four content module widgets for models
     */
    public function getContentModules()
    {
        echo TextBlockWidget::widget(['model' => $this]);

        echo ImageGalleryWidget::widget(['model' => $this]);

        echo VideoGalleryWidget::widget(['model' => $this]);
    }
} 