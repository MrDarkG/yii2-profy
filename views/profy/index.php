<?php

use app\models\ProfyServices;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProfyServicesQuery $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Profy Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profy-services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profy Services', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'profy_id',
            'service_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProfyServices $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
