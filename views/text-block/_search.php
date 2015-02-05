<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dmstr\modules\news\models\search\TextBlock $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="text-block-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'news_id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'text_html') ?>

		<?= $form->field($model, 'source') ?>

		<?php // echo $form->field($model, 'image') ?>

		<?php // echo $form->field($model, 'published_at') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
