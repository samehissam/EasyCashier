<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = 'إضافة منتج جديد';

?>
<div class="item-create">

    <h1 class="text-center space"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
