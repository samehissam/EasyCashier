<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Citem */

$this->title = 'تعديل بيانات: ' . ' ' . $model->item_name;

?>
<div class="citem-update">

    <p style="font-size: 40px; font-weight: bold;" class="text-center"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
