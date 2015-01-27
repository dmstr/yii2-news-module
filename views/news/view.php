<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var dmstr\news\models\News $model
*/

$this->title = 'News ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
$returnUrl                     = (\Yii::$app->request->get('returnUrl') !== null)
                                    ? \Yii::$app->request->get('returnUrl') : null;
?>
<div class="news-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Edit'), ['update', 'id' => $model->id, 'returnUrl' => $returnUrl],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' News', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List'), ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->title ?>    </h3>


    <?php $this->beginBlock('dmstr\news\models\News'); ?>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'id',
			'title',
			'text_html:ntext',
			'location',
			'published_at',
[
    'format' => 'html',
    'label'=>'Image',
    'attribute' => 'image',
    'value'=> \yii\helpers\Html::img($model->image, ['class' => 'img-responsive']),

],
			'image_source',
			'created_at',
			'updated_at',
    ],
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'returnUrl' => $returnUrl],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('app', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]); ?>
    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('ImageGalleries'); ?>
<p class='pull-right'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Image Galleries',
            ['crud/image-gallery/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Image Gallery',
            ['crud/image-gallery/create', 'ImageGallery' => ['news_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-ImageGalleries','linkSelector'=>'#pjax-ImageGalleries ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getImageGalleries(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
			'name',
			'created_at',
			'updated_at',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'crud/image-gallery' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'crud/image-gallery'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('TextBlocks'); ?>
<p class='pull-right'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Text Blocks',
            ['crud/text-block/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Text Block',
            ['crud/text-block/create', 'TextBlock' => ['news_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-TextBlocks','linkSelector'=>'#pjax-TextBlocks ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getTextBlocks(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
			'title',
			'source',
[
    'format' => 'html',
    'label'=>'Image',
    'attribute' => 'image',
    'value'=> function($model){
        return \yii\helpers\Html::img($model->image, ['class' => 'img-responsive']);
    }

],
			'published_at',
			'created_at',
			'updated_at',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'crud/text-block' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'crud/text-block'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('VideoGalleries'); ?>
<p class='pull-right'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List All') . ' Video Galleries',
            ['crud/video-gallery/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' Video Gallery',
            ['crud/video-gallery/create', 'VideoGallery' => ['news_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-VideoGalleries','linkSelector'=>'#pjax-VideoGalleries ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getVideoGalleries(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
			'name',
			'created_at',
			'updated_at',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'crud/video-gallery' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'crud/video-gallery'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> News',
    'content' => $this->blocks['dmstr\news\models\News'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Image Galleries</small>',
    'content' => $this->blocks['ImageGalleries'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Text Blocks</small>',
    'content' => $this->blocks['TextBlocks'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Video Galleries</small>',
    'content' => $this->blocks['VideoGalleries'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
