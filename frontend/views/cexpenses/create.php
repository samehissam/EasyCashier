<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expenses */

$this->title = 'إضافة مصروفات الكافي';

?>
<div class="expenses-create">

    <h1 class="text-center space"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
