<?php
namespace dmstr\modules\news\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * Behaviors, eg. access control
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'       => ['index'],
                        'allow'         => true,
                        'roles'         => ['@']
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
