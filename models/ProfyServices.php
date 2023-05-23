<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profy_services".
 *
 * @property int $id
 * @property int $profy_id
 * @property int $service_id
 *
 * @property Users $profy
 * @property Services $service
 */
class ProfyServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profy_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profy_id', 'service_id'], 'required'],
            [['profy_id', 'service_id'], 'integer'],
            [['profy_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['profy_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profy_id' => 'Profy ID',
            'service_id' => 'Service ID',
        ];
    }

    /**
     * Gets query for [[Profy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getProfy()
    {
        return $this->hasOne(User::class, ['id' => 'profy_id']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::class, ['id' => 'service_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfyServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfyServicesQuery(get_called_class());
    }
}
