<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChallanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="challan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'challan_id') ?>

    <?= $form->field($model, 'sales_id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'transport_id') ?>

    <?php // echo $form->field($model, 'transport_invoice_number') ?>

    <?php // echo $form->field($model, 'condition_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
