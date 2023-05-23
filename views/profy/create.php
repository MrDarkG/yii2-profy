<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProfyServices $model */

$this->title = 'Create Profy Services';
$this->params['breadcrumbs'][] = ['label' => 'Profy Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profy-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
