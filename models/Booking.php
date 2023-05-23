<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property int $profy_id
 * @property int $service_id
 * @property string $date
 * @property string $time
 * @property int $status
 * @property string $till
 * @property User $user
 * @property User $profy
 * @property Services $service
 */
class Booking extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%bookings}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'profy_id', 'service_id', 'date', 'time', 'status', 'till'], 'required'],
            [['user_id', 'profy_id', 'service_id'], 'integer'],
            [['date', 'time', 'status'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['profy_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['profy_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['service_id' => 'id']],
            ['date', 'date', 'format' => 'php:Y-m-d'],
            ['time', 'date', 'format' => 'php:H:i:s'],
            ['status', 'in', 'range' => [0, 1, 2]],
            ['till', 'date', 'format' => 'php:H:i:s'],
        ];
    }
}