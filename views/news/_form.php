<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var dmstr\modules\news\models\News $model
* @var yii\widgets\ActiveForm $form
*/

// Cut off returnUrl from request url for only save record option
$actionUrl = Yii::$app->request->url;
if (strpos($actionUrl, 'returnUrl') !== false) {
    $actionUrl = urldecode(substr($actionUrl, 0, strpos($actionUrl, 'returnUrl') - 1));
}
?>

<div class="news-form">

    <?php $form = ActiveForm::begin([
                        'id'     => 'News',
                        'layout' => 'horizontal',
                        'enableClientValidation' => false,
                    ]
                );
    ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'text_html')->widget(
    \dosamigos\tinymce\TinyMce::className(), [
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
]); ?>
			<?= $form->field($model, 'published_at')->widget(\zhuravljov\widgets\DateTimePicker::className(), [
    'options' => ['class' => 'form-control','style' => 'width:145px;'],
    'clientOptions' => [
        'autoclose'      => true,
        'todayHighlight' => true,
        'format'         => 'yyyy-mm-dd hh:ii'
    ],
]); ?>
			<?= $form->field($model, 'image')->widget('hrzg\moxiecode\moxiemanager\widgets\FilePicker', [
    "model"     => $model,
    // The data model that this widget is associated with
    "attribute" => "image",
    // The model attribute that this widget is associated with
    "options"   => [
        "class"          => "form-control",
        // CSS classes for Bootstrap Input group
        "placeholder"    => \Yii::t("app", "Click Select to insert a file..."),
        // Placeholder text in file InputField
        "readonly"       => true,
        // Boolean value enabled / disable file InputField
        "edit"           => true,
        // Boolean value show / hide EditButton
        "preview"        => true,
        // Boolean value show / hide PreviewButton
        //"insertCallback" => "callbackFunc",
        // Insert file callback will be executed when files are selected and inserted by the user
        //"directory"      => "/files/Test"
        // Default directory to open. Defaults to /files but can also be configured to /file/thumbs
    ]
]) ?>
			<?= $form->field($model, 'image_source')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'News',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?= Html::submitButton(
                '<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord
                            ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                [
                    'id'    => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
            );
        ?>
        <?= (!$model->isNewRecord && \Yii::$app->request->getQueryParam('returnUrl') !== null) ? Html::submitButton(
                '<span class="glyphicon glyphicon-fast-backward"></span> ' .
                    Yii::t('app', 'Save and go back') . '',
                    ['class' => 'btn btn-primary']
                ) : null;
        ?>


        <?php ActiveForm::end(); ?>

    </div>

</div>

<?php
$js = <<<JS
// get the form id and set the action url
$('#save-{$model->formName()}').on('click', function(e) {
    $('form#{$model->formName()}').attr("action","{$actionUrl}");
});
JS;
$this->registerJs($js);