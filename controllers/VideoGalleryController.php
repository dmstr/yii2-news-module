<?php

namespace dmstr\news\controllers;

use dmstr\news\models\VideoGallery;
use dmstr\news\models\search\VideoGallerySearch;
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
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
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
		$searchModel = new VideoGallerySearch;
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
        Tabs::setParentRelationRoute(\Yii::$app->request->url, $this->id);

        if ($returnUrl !== null) {
            Url::remember($returnUrl);
        } else {
            Url::remember(\Yii::$app->urlManager->createUrl([\Yii::$app->request->pathInfo, 'id' => $id]));
        }
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
        return $this->render('create', ['model' => $model,]);
	}

	/**
	 * Updates an existing VideoGallery model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

        if (\Yii::$app->request->get('returnUrl') === null)
        {
            $returnUrl = ($this->module->id)
                ? $this->module->id . '/' . $this->id . '/view'
                : $this->id . '/view';
            Url::remember(\Yii::$app->urlManager->createUrl([$returnUrl, 'id' => $id]));
        }
		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
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
	 * @return mixed
	 */
	public function actionDelete($id)
	{
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->setFlash('error', $msg);

            $returnUrl = ($this->module->id)
                ? $this->module->id . '/' . $this->id . '/view'
                : $this->id . '/view';
            return $this->redirect(
               \Yii::$app->urlManager->createUrl([$returnUrl, 'id' => $id])
            );
        }
        if (\Yii::$app->request->get('returnUrl') === null)
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
