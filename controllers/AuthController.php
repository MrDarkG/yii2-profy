<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\models\User;
use Firebase\JWT\JWT;
use yii\web\UnauthorizedHttpException;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * @throws \yii\base\Exception
     * @throws UnauthorizedHttpException
     */
    public function actionLogin()
    {
        $email = Yii::$app->request->post('email');
        $password = Yii::$app->request->post('password');

        // Find the user by username and verify the password
        $user = User::findOne(['email' => $email]);
        if (!$user || !$user->validatePassword($password)) {
            throw new UnauthorizedHttpException('Invalid username or password.');
        }
        Yii::$app->user->login($user);
        $user->generateAccessToken();
        $user->save();
        return $user->access_token;
    }


}
