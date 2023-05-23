<?php

namespace unit\models;
use Codeception\Util\HttpCode;
use Yii;

class ApiTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testUserRegistration()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 1000; $i++) {
            $userData = [
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->password,
            ];

            Yii::$app->request->headers->set('Authorization', 'Bearer <access_token>');
            $this->tester->sendPOST('/user-api/create', $userData);

            $this->tester->seeResponseCodeIs(HttpCode::OK);
            $this->tester->seeResponseContainsJson(['status' => 'success']);
        }
    }

    public function testProfyRegistration()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 1000; $i++) {
            $profyData = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
            ];

            Yii::$app->request->headers->set('Authorization', 'Bearer <access_token>');
            $this->tester->sendPOST('/profy-api/create', $profyData);

            $this->tester->seeResponseCodeIs(HttpCode::OK);
            $this->tester->seeResponseContainsJson(['status' => 'success']);
        }
    }

    public function testBookingCreation()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 1000; $i++) {
            $bookingData = [
                'profy_id' => $faker->numberBetween(1, 1000),
                'user_id' => $faker->numberBetween(1, 1000),
            ];

            Yii::$app->request->headers->set('Authorization', 'Bearer <access_token>');
            $this->tester->sendPOST('/booking-api/create', $bookingData);

            $this->tester->seeResponseCodeIs(HttpCode::OK);
            $this->tester->seeResponseContainsJson(['status' => 'success']);
        }
    }
}
