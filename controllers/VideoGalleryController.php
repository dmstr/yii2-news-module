<?php

namespace dmstr\modules\news\controllers;

use dmstr\modules\news\models\VideoGallery;
use dmstr\modules\news\models\search\VideoGallery as VideoGallerySearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use dmstr\bootstrap\Tabs;

/**
 * VideoGalleryController implements the CRUD actions for VideoGallery model.
 */
class VideoGalleryController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' 	=> true,
						'actions'   => ['index', 'view', 'create', 'update', 'delete'],
						'roles'     => ['@']
					]
				]
			]
		];
	}

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Tabs::registerAssets();
            return true;
        } else {
            return false;
        }
    }

	/**
	 * Lists all VideoGallery models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new VideoGallerySearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();

        // clear all parent route information in cookies
        Tabs::clearParentRelationRoute($this->id);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single VideoGallery model.
	 * @param integer $id
     * @param null $returnUrl
     *
	 * @return mixed
	 */
	public function actionView($id, $returnUrl = null)
	{
        Tabs::rememberActiveTab(\Yii::$app->request->url, $this->id);

        if ($returnUrl === null) {
			$returnUrl = ($this->module->id)
				? $this->module->id . '/' . $this->id . '/' . $this->action->id
				: $this->id . '/' . $this->action->id;
            $returnUrl = \Yii::$app->urlManager->createUrl([$returnUrl, 'id' => $id]);
        }
        Url::remember($returnUrl);

        return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new VideoGallery model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new VideoGallery;

		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
		}
        return $this->render('create', ['model' => $model]);
	}

	/**
	 * Updates an existing VideoGallery model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @param null $returnUrl
	 * @return mixed
	 */
	public function actionUpdate($id, $returnUrl = null)
	{
		$model = $this->findModel($id);

        if ($returnUrl === null)
        {
            $returnUrl = ($this->module->id)
                ? $this->module->id . '/' . $this->id . '/view'
                : $this->id . '/view';
			$returnUrl = \Yii::$app->urlManager->createUrl([$returnUrl, 'id' => $id]);
        }

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect($returnUrl);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing VideoGallery model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
     * @param null $returnUrl
	 * @return mixed
	 */
	public function actionDelete($id, $returnUrl = null)
	{
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->setFlash('error', $msg);
            return $this->redirect(Url::previous());
        }
        if ($returnUrl === null)
        {
            $returnUrl = ($this->module->id) ? $this->module->id . '/' . $this->id : $this->id;
            return $this->redirect(\Yii::$app->urlManager->createUrl($returnUrl));
        }
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the VideoGallery model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return VideoGallery the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = VideoGallery::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
