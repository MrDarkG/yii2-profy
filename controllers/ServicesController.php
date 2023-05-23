<?php

namespace app\controllers;

use app\Models\Services;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'authenticator' => [
                    'class' => \yii\filters\auth\HttpBearerAuth::className(),
                    'except' => ['options'],
                ],


                'contentNegotiator' => [
                    'class' => \yii\filters\ContentNegotiator::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Services models.
     *
     * @return array
     */
    public function actionIndex()
    {
        return Services::find()->all();
    }

}
