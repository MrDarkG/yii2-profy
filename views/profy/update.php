<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProfyServices $model */

$this->title = 'Update Profy Services: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profy Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profy-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
