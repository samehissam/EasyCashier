<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = 'المخزن';
?>
<div class="inventory-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
