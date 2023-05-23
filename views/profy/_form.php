<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProfyServices $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profy-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profy_id')->textInput() ?>

    <?= $form->field($model, 'service_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
