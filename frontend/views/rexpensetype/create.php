<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExpenseType */

$this->title = 'إضافة وصف جديد لمصروفات المطعم';

?>
<div class="expense-type-create">

    <h1 class="text-center space"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
