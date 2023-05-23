<?php

namespace app\controllers;

use app\models\Booking;
use app\models\User;
use Yii;
use yii\db\Transaction;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BookinController extends Controller
{
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

    public function actionCreate()
    {
        $authToken = Yii::$app->request->headers->get('Authorization');
        $authtokenWithoutBearer = str_replace('Bearer ', '', $authToken);
        $user = User::findIdentityByAccessToken($authtokenWithoutBearer);
        if (!$user) {
            return ['error' => 'User not found'];
        }
        if (!$this->checkIfProfyIsAvailable()) {
            return ['error' => 'Profy is not available'];
        }
        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->service_id = Yii::$app->request->post('service_id');
        $booking->profy_id = Yii::$app->request->post('profy_id');
        $booking->date = Yii::$app->request->post('date');
        $booking->time = Yii::$app->request->post('time');
        $booking->till = Yii::$app->request->post('till');
        $booking->status = 1;
        $transaction = Booking::getDb()->beginTransaction(Transaction::SERIALIZABLE);
        try {
            if ($this->checkIfProfyIsAvailable()) {
                if ($booking->save()) {
                    $transaction->commit();
                    return ['status' => 'success', 'message' => 'Booking created successfully.'];
                } else {
                    throw new \Exception('Failed to save booking.');
                }
            } else {
                throw new \Exception('Profy is not available for booking.');
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function actionDelete()
    {
        $authToken = Yii::$app->request->headers->get('Authorization');
        $authtokenWithoutBearer = str_replace('Bearer ', '', $authToken);
        $user = User::findIdentityByAccessToken($authtokenWithoutBearer);
        if (!$user) {
            return ['error' => 'User not found'];
        }
        $booking = Booking::find()->where(['user_id' => $user->id, 'id' => Yii::$app->request->post('id')])->one();

        if(!$booking){
            return ['error' => 'Booking not found'];
        }
        $booking->status = 2;
        if(!$booking->save()){
            return ['error' => $booking->getErrors()];
        }
        //update booking
        return $booking;
    }

    public function checkIfProfyIsAvailable()
    {
        $profyId = Yii::$app->request->post('profy_id');
        $date = Yii::$app->request->post('date');
        $time = Yii::$app->request->post('time');
        $till = Yii::$app->request->post('till');
        $booking = Booking::find()->where(['profy_id' => $profyId, 'date' => $date])
            ->andWhere(['between', 'time', $time, $till])
            ->orWhere(['profy_id' => $profyId, 'date' => $date])
            ->andWhere(['between', 'till', $time, $till])
            ->one();
        if($booking){
            return false;
        }
        return true;
    }
}