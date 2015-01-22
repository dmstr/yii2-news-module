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

class OptsProvider extends \schmunk42\giiant\base\Provider
{
    public function activeField(ColumnSchema $attribute)
    {
        $column = $this->generator->getTableSchema()->columns[$attribute->name];

        switch (true) {

            case (in_array($column->name, $this->columnNames)):

                // Render a dropdown list if the model has a method optsColumn().
                $modelClass = $this->generator->modelClass;
                $func       = 'opts' . str_replace("_", "", $column->name);

                if (method_exists($modelClass::className(), $func)) {
                    return <<<EOS
\$form->field(\$model, '{$column->name}')->dropDownList(
    {$modelClass}::{$func}(),
    ['prompt'=>'Bitte wählen...']
);
EOS;
                } else {
                    return null;
                }

            default:
                return null;
        }
    }
}
