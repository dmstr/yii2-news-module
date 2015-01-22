<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\news\providers;

use dmstr\news\models;
use yii\db\ColumnSchema;

class FieldProvider extends \schmunk42\giiant\base\Provider
{
    public function activeField(ColumnSchema $attribute)
    {
        $column = $this->generator->getTableSchema()->columns[$attribute->name];

        switch (true) {
            case $column->name == 'created_at':
            case $column->name == 'updated_at':
                return false;

            case $column->name == 'edition_year':
                return <<<EOS
			\$form->field(\$model, '{$column->name}')->textInput(['maxlength' => 20]);
EOS;
            default:
                return null;
        }
    }

    public function attributeFormat(ColumnSchema $attribute)
    {
        $column = $this->generator->getTableSchema()->columns[$attribute->name];

        switch (true) {
            default:
                return null;
        }
    }

    public function columnFormat($column, $model)
    {
        if ($column->name == 'text_html') {
            return false;
        } else {
            return null;
        }
    }
}
