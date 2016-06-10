<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Crtransaction */

$this->title = 'Create Crtransaction';

?>
<div class="crtransaction-create">

    

    <?= $this->render('_form', [
        'model' => $model,
        'invoic_table' => $invoic_table,
        'order_table' => $order_table,
        'modelsTransaction'=>$modelsTransaction,
    ]) ?>
</div>
