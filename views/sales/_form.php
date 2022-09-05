<?php

use app\components\CommonUtility;
use app\components\CustomerUtility;
use app\components\OutletUtility;
use app\components\Utility;
use app\models\PaymentType;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Sales */
/* @var $form yii\widgets\ActiveForm */

$var = "var defaultType='" . PaymentType::TYPE_DEPOSIT . "';  var type = {";

foreach (CommonUtility::getPaymentType(false, 'active') as $type) {
    $var = $var . " " . $type->payment_type_id . ": '" . $type->type . "', ";
}
$var = rtrim($var, ', ');
$var = $var . ' };';

$this->registerJs($var, View::POS_HEAD, 'salesPayment');

?>


<div class="sales-form">
    <?php $form = ActiveForm::begin([
        'id' => 'formAjaxSellCreate'
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?php
            echo $form->field($model, 'outletId')->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'data' => OutletUtility::getUserOutlet(),
                'pluginOptions' => [
                    'disabled' => true
                ],
                'options' => [
                    'placeholder' => 'Outlet '
                ]
            ]);
            ?>
        </div>

        <div class="col-md-12">
            <?php
            echo $form->field($model, 'client_id')->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'data' => CustomerUtility::getCustomerWithAddressList(null, 'client_name asc', true, $model->outletId),
                'options' => [
                    'placeholder' => 'Select a customer '
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= Html::activeHiddenInput($model, 'client_type'); ?>
            <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'paid_amount')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'due_amount')->textInput(['readOnly' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'discount_amount')->textInput() ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'total_amount')->textInput(['readOnly' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'memo_id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?php
            echo $form->field($model, 'payment_type')->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'data' => ArrayHelper::map(CommonUtility::getPaymentType(false, 'active'), 'payment_type_id', 'payment_type_name'),
                'value' => CommonUtility::getPaymentTypeId(PaymentType::TYPE_CASH),
                'options' => [
                    'placeholder' => 'Select payment type',

                ],
            ])->label('Type');
            ?>
        </div>
    </div>


    <div class="row" id="payment">
        <div class="col-md-6">
            <?php
            echo $form->field($model, 'bank')->widget(Select2::classname(), [
                'theme' => Select2::THEME_DEFAULT,
                'data' => ArrayHelper::map(CommonUtility::getBank(), 'bank_id', 'bank_name'),
                'options' => [
                    'id' => 'bank_id',
                    'placeholder' => 'Select a bank',
                    'disabled' => true
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>

        <div class="col-md-6">
            <?php
            echo $form->field($model, 'branch')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true], 'theme' => Select2::THEME_DEFAULT],
                'options' => ['id' => 'branch_id'],
                'pluginOptions' => [
                    'depends' => ['bank_id'],
                    'placeholder' => 'Select a branch',
                    'url' => Url::to(['/bank/get-branch'])
                ]
            ]);
            ?>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
        </div>

    </div>


    <div class="row">
        <div class="col-md-6">
            <?= Html::a('Cancel', ['sales/cancel-sales-invoice'],
                [
                    'class' => 'btn btn-default btn-block btn-flat',
                    'onclick' => "
                             if (confirm('Are you sure you want to cancel this?')) {
                                return true;
                            }
                            return false;"
                ]) ?>
        </div>
        <div class="col-md-6">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['id' => 'salesCreateButton', 'class' => $model->isNewRecord ? 'btn btn-success btn-block btn-flat' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>




