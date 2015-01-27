<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var dmstr\news\models\search\NewsSearch $searchModel
*/

    $this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="news-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New') . ' News', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">


                                                                                                            
            <?= 
            \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'       => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> ' . Yii::t('app', 'Relations'),
                    'dropdown' => [
                        'options'      => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items'        => [
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Image Gallery</i>',
        'url' => [
            'crud/image-gallery/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Text Block</i>',
        'url' => [
            'crud/text-block/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Video Gallery</i>',
        'url' => [
            'crud/video-gallery/index',
        ],
    ],
]                    ],
                ]
            );
            ?>        </div>
    </div>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        
			'id',
			'title',
			'location',
			'published_at',
			[
    'format' => 'html',
    'label'=>'Image',
    'attribute' => 'image',
    'value'=> function($model){
        return \yii\helpers\Html::img($model->image, ['class' => 'img-responsive']);
    }

],
			'image_source',
			'created_at',
			/*'updated_at'*/
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                    return Url::toRoute($params);
                },
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
