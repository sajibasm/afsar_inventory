<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LcPayment */

$this->title = Yii::t('app', 'Add LC Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lc Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lc-payment-create">

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">LC Payment Create</h3>
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body" id="sales_product_details">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
