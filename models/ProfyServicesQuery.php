<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProfyServices]].
 *
 * @see ProfyServices
 */
class ProfyServicesQuery extends \yii\db\ActiveQuery
{
    public $modelClass = ProfyServices::class;
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProfyServices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProfyServices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byProfyId($profyId)
    {
        return $this->andWhere(['profy_id' => $profyId]);
    }

}
