<?php

namespace app\controllers;

use app\models\ProfyServices;
use app\models\ProfyServicesQuery;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfyController implements the CRUD actions for ProfyServices model.
 */
class ProfyController extends Controller
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
     * Lists all ProfyServices models.
     *
     * @return ProfyServices[]
     */
    public function actionIndex(): array
    {
        $users = User::find()
            ->with('services')
            ->where(['role' => User::ROLE_PROFY])
            ->all();

        $responseData = [];
        foreach ($users as $user) {
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'services' => [],
            ];

            foreach ($user->services as $service) {
                $userData['services'][] = [
                    'id' => $service->id,
                    'name' => $service->name,
                ];
            }

            $responseData[] = $userData;
        }
        return $responseData;
    }

    public function actionCreate()
    {
        $authToken = \Yii::$app->request->headers->get('Authorization');
        $authtokenWithoutBearer = str_replace('Bearer ', '', $authToken);
        $user = User::findIdentityByAccessToken($authtokenWithoutBearer);
        if (!$user) {
            return ['error' => 'User not found'];
        }
        $model = new ProfyServices();
        $model->profy_id = $user->id;
        $model->service_id = \Yii::$app->request->post('service_id');
        if ($model->save()) {
            return $model;
        }
        return $model->errors;
    }

    public function actionDelete()
    {
        $authToken = \Yii::$app->request->headers->get('Authorization');
        $authtokenWithoutBearer = str_replace('Bearer ', '', $authToken);
        $user = User::findIdentityByAccessToken($authtokenWithoutBearer);
        if (!$user) {
            return ['error' => 'User not found'];
        }
        $model = ProfyServices::findOne(['profy_id' => $user->id, 'service_id' => \Yii::$app->request->post('service_id')]);
        if ($model->delete()) {
            return $model;
        }
        return $model->errors;
    }
}
