<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ccategory */

$this->title = 'إضافة قسم جديد لأصناف الكافي';

?>
<div class="ccategory-create well">

    <h1 class="text-center space"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
