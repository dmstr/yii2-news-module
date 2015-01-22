<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\news\providers;

use yii\db\ColumnSchema;
use dmstr\news\models;

class DateTimeProvider extends \schmunk42\giiant\base\Provider
{
    public function activeField($attribute)
    {
        $column = $this->generator->getTableSchema()->columns[$attribute->name];

        switch (true) {
            case (in_array($column->name, $this->columnNames)):
                $this->generator->requires[] = 'zhuravljov\yii2-datetime-widgets';
                return <<<EOS
\$form->field(\$model, '{$column->name}')->widget(\zhuravljov\widgets\DateTimePicker::className(), [
    'options' => ['class' => 'form-control','style' => 'width:145px;'],
    'clientOptions' => [
        'autoclose'      => true,
        'todayHighlight' => true,
        'format'         => 'yyyy-mm-dd hh:ii'
    ],
]);
EOS;
                break;
            default:
                return null;
        }
    }
}
