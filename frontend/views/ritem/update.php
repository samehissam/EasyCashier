<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ritem */

$this->title = 'تعديل سعر: ' . ' ' . $model->item_name	;


?>
<div class="ritem-update">

    <p style="font-size: 35px; font-weight: bold;" class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
