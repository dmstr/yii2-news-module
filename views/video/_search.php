<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dmstr\news\models\search\VideoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="video-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'video_gallery_id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'youtube_url') ?>

		<?= $form->field($model, 'published_at') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
