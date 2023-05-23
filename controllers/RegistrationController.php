<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\RegistrationForm;
use yii\rest\Controller;
use yii\web\Response;

class RegistrationController extends Controller
{
    public function actionRegister()
    {
        $model = new RegistrationForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model->validate()) {
            $user = new User();
            $user->name = $model->name;
            $user->email = $model->email;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->role = $model->role; // Set the default role here

            if ($user->save()) {
                Yii::$app->response->statusCode = 201; // Created
                return ['message' => 'Registration successful!'];
            } else {
                Yii::$app->response->statusCode = 400; // Bad Request
                return ['message' => 'Failed to register user.', 'errors' => $user->getErrors()];
            }
        }

        Yii::$app->response->statusCode = 422; // Unprocessable Entity
        return ['message' => 'Validation failed.', 'errors' => $model->getErrors()];
    }
}
