<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\news\providers;

use yii\db\ColumnSchema;

class EditorProvider extends \schmunk42\giiant\base\Provider
{
    public $columnNames = ['text_html'];

    public function activeField(ColumnSchema $attribute)
    {
        $column = $this->generator->getTableSchema()->columns[$attribute->name];

        switch (true) {
            case (in_array($column->name, $this->columnNames)):
                $this->generator->requires[] = '2amigos/yii2-tinymce-widget';
                return <<<EOS
\$form->field(\$model, '$attribute->name')->widget(
    \\dosamigos\\tinymce\\TinyMce::className(), [
    'options' => [
        'rows' => 15,
        'paste_remove_styles' => true
    ],
    'language' => 'de',
    'clientOptions' => [
        'forced_root_block' => 'div',
        'plugins'           => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks fullscreen",
            "insertdatetime media table contextmenu paste",
            "image media preview code"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | pastetext",
        'menubar' => false
    ]
]);
EOS;
            default:
                return null;
        }
    }
}
